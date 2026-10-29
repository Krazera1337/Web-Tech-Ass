<?php
/*
 * Creates a new row in the `user` table. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';
require_once __DIR__ . '/includes/user-form.inc.php';

$values = user_input([]);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors['form'] = 'Your session expired. Please submit the form again.';
    } else {
        $values = user_input($_POST);
        $password = (string) ($_POST['password'] ?? '');
        $confirm = (string) ($_POST['confirm_password'] ?? '');
        $errors = validate_user($conn, $values, $password, $confirm, true);

        if (!$errors) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, 'INSERT INTO `user`
                (first_name, last_name, username, email, street, city, state, postcode, phone, password_hash)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'ssssssssss',
                $values['first_name'], $values['last_name'], $values['username'], $values['email'],
                $values['street'], $values['city'], $values['state'], $values['postcode'], $values['phone'], $hash);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            flash('User “' . $values['username'] . '” was created.');
            header('Location: manage_users.php');
            exit;
        }
    }
}

$pageTitle = 'Add User — Plant Story';
$adminTitle = 'Add user';
$adminBodyClass = 'auth-page register-page';
$adminMainClass = 'auth-main admin-form-main';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <div class="register-box">
    <h1>New user</h1>
    <p class="subtitle">All fields are required.</p>
    <?php if ($errors): ?>
    <p class="form-alert form-alert--error" role="alert"><?= htmlspecialchars($errors['form'] ?? 'Please fix the highlighted fields and try again.') ?></p>
    <?php endif; ?>
    <?php render_user_form($values, $errors, true, 'Create user'); ?>
  </div>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
