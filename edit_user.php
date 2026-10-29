<?php
/*
 * Updates an existing user. Leaving the password blank keeps the current
 * one. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';
require_once __DIR__ . '/includes/user-form.inc.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM `user` WHERE user_id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$existing = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$existing) {
    flash('That user no longer exists.');
    header('Location: manage_users.php');
    exit;
}

$values = user_input($existing);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors['form'] = 'Your session expired. Please submit the form again.';
    } else {
        $values = user_input($_POST);
        $password = (string) ($_POST['password'] ?? '');
        $confirm = (string) ($_POST['confirm_password'] ?? '');
        $errors = validate_user($conn, $values, $password, $confirm, false, $id);

        if (!$errors) {
            $hash = $password !== '' ? password_hash($password, PASSWORD_DEFAULT) : $existing['password_hash'];
            $stmt = mysqli_prepare($conn, 'UPDATE `user` SET
                first_name = ?, last_name = ?, username = ?, email = ?, street = ?, city = ?,
                state = ?, postcode = ?, phone = ?, password_hash = ?
                WHERE user_id = ?');
            mysqli_stmt_bind_param($stmt, 'ssssssssssi',
                $values['first_name'], $values['last_name'], $values['username'], $values['email'],
                $values['street'], $values['city'], $values['state'], $values['postcode'], $values['phone'], $hash, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            flash('User “' . $values['username'] . '” was updated.');
            header('Location: manage_users.php');
            exit;
        }
    }
}

$pageTitle = 'Edit User — Plant Story';
$adminTitle = 'Edit user';
$adminBodyClass = 'auth-page register-page';
$adminMainClass = 'auth-main admin-form-main';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <div class="register-box">
    <h1>Edit account #<?= $id ?></h1>
    <p class="subtitle">Leave the password fields blank to keep the current password.</p>
    <?php if ($errors): ?>
    <p class="form-alert form-alert--error" role="alert"><?= htmlspecialchars($errors['form'] ?? 'Please fix the highlighted fields and try again.') ?></p>
    <?php endif; ?>
    <?php render_user_form($values, $errors, false, 'Save changes'); ?>
  </div>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
