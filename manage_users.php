<?php
/*
 * User management: lists every account in the `user` table with links to
 * view, edit and delete each one. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';

$search = trim((string) ($_GET['q'] ?? ''));

if ($search !== '') {
    $like = '%' . $search . '%';
    $stmt = mysqli_prepare($conn, 'SELECT user_id, first_name, last_name, username, email, state, phone, created_at
        FROM `user`
        WHERE username LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR email LIKE ?
        ORDER BY user_id');
    mysqli_stmt_bind_param($stmt, 'ssss', $like, $like, $like, $like);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, 'SELECT user_id, first_name, last_name, username, email, state, phone, created_at
        FROM `user` ORDER BY user_id');
}
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

$pageTitle = 'Manage Users — Plant Story';
$adminTitle = 'Manage users';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel" aria-labelledby="users-heading">
    <div class="admin-panel__head">
      <h2 id="users-heading">Registered users <span class="admin-count"><?= count($users) ?></span></h2>
      <form class="admin-search" method="get" action="manage_users.php" role="search">
        <label for="q" class="sr-only">Search users</label>
        <input type="search" id="q" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search name, username or email">
        <button type="submit" class="admin-btn">Search</button>
        <?php if ($search !== ''): ?><a href="manage_users.php" class="admin-btn admin-btn--ghost">Clear</a><?php endif; ?>
      </form>
    </div>

    <?php if (!$users): ?>
    <p class="admin-empty">
      <?= $search !== '' ? 'No users match “' . htmlspecialchars($search) . '”.' : 'No users yet.' ?>
      <a href="add_user.php">Add the first user</a>.
    </p>
    <?php else: ?>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <caption class="sr-only">Registered users</caption>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">State</th>
            <th scope="col">Phone</th>
            <th scope="col">Joined</th>
            <th scope="col"><span class="sr-only">Actions</span></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
          <tr>
            <td data-label="ID"><?= (int) $u['user_id'] ?></td>
            <td data-label="Name"><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?></td>
            <td data-label="Username"><?= htmlspecialchars($u['username']) ?></td>
            <td data-label="Email"><?= htmlspecialchars($u['email']) ?></td>
            <td data-label="State"><?= htmlspecialchars($u['state']) ?></td>
            <td data-label="Phone"><?= htmlspecialchars($u['phone']) ?></td>
            <td data-label="Joined"><?= date('j M Y', strtotime($u['created_at'])) ?></td>
            <td class="admin-actions">
              <a href="view_user.php?id=<?= (int) $u['user_id'] ?>" class="admin-btn admin-btn--ghost">View</a>
              <a href="edit_user.php?id=<?= (int) $u['user_id'] ?>" class="admin-btn admin-btn--ghost">Edit</a>
              <a href="delete_user.php?id=<?= (int) $u['user_id'] ?>" class="admin-btn admin-btn--danger">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
