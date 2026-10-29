<?php
/*
 * Asks the admin to confirm, then removes the user on POST. Deleting never
 * happens on a plain GET, so following a link cannot remove anyone.
 * Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';

$id = (int) ($_REQUEST['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT user_id, first_name, last_name, username, email FROM `user` WHERE user_id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$u = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$u) {
    flash('That user no longer exists.');
    header('Location: manage_users.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $error = 'Your session expired. Please confirm again.';
    } else {
        $stmt = mysqli_prepare($conn, 'DELETE FROM `user` WHERE user_id = ?');
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        flash('User “' . $u['username'] . '” was deleted.');
        header('Location: manage_users.php');
        exit;
    }
}

$pageTitle = 'Delete User — Plant Story';
$adminTitle = 'Delete user';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel admin-panel--narrow" aria-labelledby="delete-heading">
    <h2 id="delete-heading">Delete <?= htmlspecialchars($u['username']) ?>?</h2>
    <?php if ($error !== ''): ?>
    <p class="form-alert form-alert--error" role="alert"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <p>You are about to delete the account below. This cannot be undone.</p>
    <dl class="admin-details">
      <div><dt>Name</dt><dd><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?></dd></div>
      <div><dt>Username</dt><dd><?= htmlspecialchars($u['username']) ?></dd></div>
      <div><dt>Email</dt><dd><?= htmlspecialchars($u['email']) ?></dd></div>
    </dl>
    <form method="post" action="delete_user.php" class="admin-panel__actions">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int) $u['user_id'] ?>">
      <button type="submit" class="admin-btn admin-btn--danger">Yes, delete user</button>
      <a href="manage_users.php" class="admin-btn admin-btn--ghost">Cancel</a>
    </form>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
