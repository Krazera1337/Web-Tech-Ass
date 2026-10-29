<?php
/*
 * Shared pieces for add_user.php and edit_user.php: the state list,
 * server-side validation that mirrors the rules on register.php, and the
 * form markup itself.
 */

const USER_STATES = [
    'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan', 'Pahang', 'Penang', 'Perak',
    'Perlis', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya',
];

const USER_FIELDS = ['first_name', 'last_name', 'username', 'email', 'street', 'city', 'state', 'postcode', 'phone'];

// Trims every expected field from $source so missing keys become ''.
function user_input($source)
{
    $values = [];
    foreach (USER_FIELDS as $field) {
        $values[$field] = trim((string) ($source[$field] ?? ''));
    }
    return $values;
}

/*
 * Returns an array of field => error message. $passwordRequired is false
 * when editing, where a blank password keeps the existing one.
 * $excludeId skips that user in the duplicate-username check.
 */
function validate_user($conn, $values, $password, $confirm, $passwordRequired, $excludeId = 0)
{
    $errors = [];

    foreach (['first_name' => 'First name', 'last_name' => 'Last name'] as $field => $label) {
        if ($values[$field] === '') {
            $errors[$field] = "$label is required.";
        } elseif (!preg_match('/^[A-Za-z]{1,25}$/', $values[$field])) {
            $errors[$field] = "$label must be letters only, up to 25 characters.";
        }
    }

    if ($values['username'] === '') {
        $errors['username'] = 'Username is required.';
    } elseif (!preg_match('/^[A-Za-z0-9_]{1,10}$/', $values['username'])) {
        $errors['username'] = 'Username must be letters, numbers or underscores, up to 10 characters.';
    } else {
        $stmt = mysqli_prepare($conn, 'SELECT user_id FROM `user` WHERE username = ? AND user_id <> ?');
        mysqli_stmt_bind_param($stmt, 'si', $values['username'], $excludeId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors['username'] = 'That username is already taken.';
        }
        mysqli_stmt_close($stmt);
    }

    if ($values['email'] === '') {
        $errors['email'] = 'Email address is required.';
    } elseif (strlen($values['email']) > 100 || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }

    if ($values['street'] === '') {
        $errors['street'] = 'Street address is required.';
    } elseif (strlen($values['street']) > 40) {
        $errors['street'] = 'Street address must be 40 characters or fewer.';
    }

    if ($values['city'] === '') {
        $errors['city'] = 'City / town is required.';
    } elseif (strlen($values['city']) > 20) {
        $errors['city'] = 'City / town must be 20 characters or fewer.';
    }

    if (!in_array($values['state'], USER_STATES, true)) {
        $errors['state'] = 'Select a state or territory.';
    }

    if (!preg_match('/^[0-9]{5}$/', $values['postcode'])) {
        $errors['postcode'] = 'Postcode must be exactly 5 digits.';
    }

    if (!preg_match('/^[0-9]{1,10}$/', $values['phone'])) {
        $errors['phone'] = 'Phone number must be digits only, up to 10 digits.';
    }

    if ($password === '' && $passwordRequired) {
        $errors['password'] = 'Password is required.';
    } elseif ($password !== '' && strlen($password) > 25) {
        $errors['password'] = 'Password must be 25 characters or fewer.';
    } elseif ($password !== $confirm) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    return $errors;
}

// Inline error message for a field, if it has one.
function field_error($errors, $field)
{
    return isset($errors[$field])
        ? '<p class="field-error" id="' . $field . '-error">' . htmlspecialchars($errors[$field]) . '</p>'
        : '';
}

// aria attributes linking an invalid field to its error message.
function error_attrs($errors, $field)
{
    return isset($errors[$field]) ? ' aria-invalid="true" aria-describedby="' . $field . '-error"' : '';
}

/*
 * Prints the user form. $values holds the field values, $errors any
 * validation messages, $passwordRequired whether the password must be set.
 */
function render_user_form($values, $errors, $passwordRequired, $submitLabel)
{
    $v = array_map('htmlspecialchars', $values);
    $required = $passwordRequired ? ' required' : '';
    $passwordHint = $passwordRequired ? 'Create a password' : 'Leave blank to keep current password';
    ?>
    <form method="post" novalidate>
      <?= csrf_field() ?>
      <div class="register-grid">
        <div class="register-field"><label for="first-name">First name</label><input type="text" id="first-name" name="first_name" value="<?= $v['first_name'] ?>" maxlength="25" pattern="[A-Za-z]+" required<?= error_attrs($errors, 'first_name') ?>><?= field_error($errors, 'first_name') ?></div>
        <div class="register-field"><label for="last-name">Last name</label><input type="text" id="last-name" name="last_name" value="<?= $v['last_name'] ?>" maxlength="25" pattern="[A-Za-z]+" required<?= error_attrs($errors, 'last_name') ?>><?= field_error($errors, 'last_name') ?></div>
        <div class="register-field register-field-wide"><label for="username">Username</label><input type="text" id="username" name="username" value="<?= $v['username'] ?>" maxlength="10" pattern="[A-Za-z0-9_]+" required<?= error_attrs($errors, 'username') ?>><?= field_error($errors, 'username') ?></div>
        <div class="register-field register-field-wide"><label for="email">Email address</label><input type="email" id="email" name="email" value="<?= $v['email'] ?>" maxlength="100" required<?= error_attrs($errors, 'email') ?>><?= field_error($errors, 'email') ?></div>
        <fieldset class="register-address register-field-wide"><legend>Address</legend>
          <div class="register-grid">
            <div class="register-field register-field-wide"><label for="street">Street address</label><input type="text" id="street" name="street" value="<?= $v['street'] ?>" maxlength="40" required<?= error_attrs($errors, 'street') ?>><?= field_error($errors, 'street') ?></div>
            <div class="register-field"><label for="city">City / town</label><input type="text" id="city" name="city" value="<?= $v['city'] ?>" maxlength="20" required<?= error_attrs($errors, 'city') ?>><?= field_error($errors, 'city') ?></div>
            <div class="register-field"><label for="state">State / federal territory</label><select id="state" name="state" required<?= error_attrs($errors, 'state') ?>>
              <option value=""<?= $values['state'] === '' ? ' selected' : '' ?> disabled>Select a state or territory</option>
              <?php foreach (USER_STATES as $state): ?>
              <option<?= $values['state'] === $state ? ' selected' : '' ?>><?= htmlspecialchars($state) ?></option>
              <?php endforeach; ?>
            </select><?= field_error($errors, 'state') ?></div>
            <div class="register-field"><label for="postcode">Postcode</label><input type="text" id="postcode" name="postcode" value="<?= $v['postcode'] ?>" inputmode="numeric" maxlength="5" pattern="[0-9]{5}" required<?= error_attrs($errors, 'postcode') ?>><?= field_error($errors, 'postcode') ?></div>
          </div>
        </fieldset>
        <div class="register-field register-field-wide"><label for="phone">Phone number</label><input type="tel" id="phone" name="phone" value="<?= $v['phone'] ?>" inputmode="numeric" maxlength="10" pattern="[0-9]{1,10}" required<?= error_attrs($errors, 'phone') ?>><?= field_error($errors, 'phone') ?></div>
        <div class="register-field"><label for="password">Password</label><input type="password" id="password" name="password" placeholder="<?= $passwordHint ?>" maxlength="25" autocomplete="new-password"<?= $required ?><?= error_attrs($errors, 'password') ?>><?= field_error($errors, 'password') ?></div>
        <div class="register-field"><label for="confirm">Confirm password</label><input type="password" id="confirm" name="confirm_password" placeholder="Repeat the password" maxlength="25" autocomplete="new-password"<?= $required ?><?= error_attrs($errors, 'confirm_password') ?>><?= field_error($errors, 'confirm_password') ?></div>
      </div>
      <div class="auth-form-actions"><button type="submit" class="register-btn"><?= htmlspecialchars($submitLabel) ?></button><a href="manage_users.php" class="auth-reset-btn">Cancel</a></div>
    </form>
    <?php
}
