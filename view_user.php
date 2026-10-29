<?php
/*
 * Shows every stored detail for one user. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM `user` WHERE user_id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$u = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$u) {
    flash('That user no longer exists.');
    header('Location: manage_users.php');
    exit;
}

$pageTitle = 'View User — Plant Story';
$adminTitle = 'User details: ' . $u['first_name'] . ' ' . $u['last_name'] . ' (' . $u['username'] . ')';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel admin-panel--narrow" aria-labelledby="details-heading">
    <h2 id="details-heading">Account #<?= (int) $u['user_id'] ?></h2>
    <dl class="admin-details">
      <div><dt>First name</dt><dd><?= htmlspecialchars($u['first_name']) ?></dd></div>
      <div><dt>Last name</dt><dd><?= htmlspecialchars($u['last_name']) ?></dd></div>
      <div><dt>Username</dt><dd><?= htmlspecialchars($u['username']) ?></dd></div>
      <div><dt>Email</dt><dd><?= htmlspecialchars($u['email']) ?></dd></div>
      <div><dt>Street address</dt><dd><?= htmlspecialchars($u['street']) ?></dd></div>
      <div><dt>City / town</dt><dd><?= htmlspecialchars($u['city']) ?></dd></div>
      <div><dt>State</dt><dd><?= htmlspecialchars($u['state']) ?></dd></div>
      <div><dt>Postcode</dt><dd><?= htmlspecialchars($u['postcode']) ?></dd></div>
      <div><dt>Phone</dt><dd><?= htmlspecialchars($u['phone']) ?></dd></div>
      <div><dt>Created</dt><dd><?= date('j M Y, g:i a', strtotime($u['created_at'])) ?></dd></div>
      <div><dt>Last updated</dt><dd><?= date('j M Y, g:i a', strtotime($u['updated_at'])) ?></dd></div>
    </dl>
    <div class="admin-panel__actions">
      <a href="edit_user.php?id=<?= (int) $u['user_id'] ?>" class="admin-btn">Edit user</a>
      <a href="delete_user.php?id=<?= (int) $u['user_id'] ?>" class="admin-btn admin-btn--danger">Delete user</a>
      <a href="manage_users.php" class="admin-btn admin-btn--ghost">Back to all users</a>
    </div>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
