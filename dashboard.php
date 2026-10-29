<?php
/*
 * Admin dashboard: headline figures across users, plants, contributions and
 * enquiries, the items waiting for attention, a breakdown of users by state
 * and the most recent sign-ups. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';

$totals = mysqli_fetch_assoc(mysqli_query($conn, "SELECT
    (SELECT COUNT(*) FROM `user`) AS users,
    (SELECT COUNT(*) FROM `user` WHERE created_at >= NOW() - INTERVAL 30 DAY) AS users_month,
    (SELECT COUNT(*) FROM `plant`) AS plants,
    (SELECT COUNT(*) FROM `contribution` WHERE status = 'pending') AS pending,
    (SELECT COUNT(*) FROM `contribution` WHERE status = 'approved') AS approved,
    (SELECT COUNT(*) FROM `enquiry` WHERE status = 'new') AS new_enquiries,
    (SELECT COUNT(*) FROM `enquiry`) AS enquiries"));

// label, value, note, link, highlight when the value needs attention
$stats = [
    ['Total users', (int) $totals['users'], (int) $totals['users_month'] . ' joined this month', 'manage_users.php', false],
    ['Plants added', (int) $totals['plants'], 'Plus 16 core species', 'manage_plants.php', false],
    ['Pending contributions', (int) $totals['pending'], (int) $totals['approved'] . ' approved so far', 'manage_contributions.php?status=pending', true],
    ['New enquiries', (int) $totals['new_enquiries'], (int) $totals['enquiries'] . ' received in total', 'manage_enquiries.php?status=new', true],
];

$pendingContributions = mysqli_fetch_all(mysqli_query($conn, "SELECT contribution_id, contributor_name, plant_name, created_at
    FROM `contribution` WHERE status = 'pending' ORDER BY created_at, contribution_id LIMIT 5"), MYSQLI_ASSOC);

$latestEnquiries = mysqli_fetch_all(mysqli_query($conn, 'SELECT enquiry_id, first_name, last_name, enquiry_type, status, created_at
    FROM `enquiry` ORDER BY created_at DESC, enquiry_id DESC LIMIT 5'), MYSQLI_ASSOC);

$byState = mysqli_fetch_all(mysqli_query($conn, 'SELECT state, COUNT(*) AS users
    FROM `user` GROUP BY state ORDER BY users DESC, state'), MYSQLI_ASSOC);
$topState = $byState ? (int) $byState[0]['users'] : 0;

$recent = mysqli_fetch_all(mysqli_query($conn, 'SELECT user_id, first_name, last_name, username, state, created_at
    FROM `user` ORDER BY created_at DESC, user_id DESC LIMIT 5'), MYSQLI_ASSOC);

$pageTitle = 'Dashboard — Plant Story';
$adminTitle = 'Dashboard';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section aria-label="Key figures">
    <ul class="admin-stats">
      <?php foreach ($stats as [$label, $value, $note, $link, $highlight]): ?>
      <li>
        <a class="admin-stat<?= $highlight && $value > 0 ? ' admin-stat--alert' : '' ?>" href="<?= $link ?>">
          <span class="admin-stat__value"><?= $value ?></span>
          <span class="admin-stat__label"><?= $label ?></span>
          <span class="admin-stat__note"><?= $note ?></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <section class="admin-quick" aria-label="Quick actions">
    <a href="plant_form.php" class="admin-btn">+ Add plant</a>
    <a href="add_user.php" class="admin-btn admin-btn--ghost">+ Add user</a>
    <a href="plants.php" class="admin-btn admin-btn--ghost" target="_blank" rel="noopener">View New Additions page</a>
    <a href="index.php" class="admin-btn admin-btn--ghost" target="_blank" rel="noopener">View site</a>
  </section>

  <div class="admin-dash-grid">
    <section class="admin-panel" aria-labelledby="pending-heading">
      <div class="admin-panel__head">
        <h2 id="pending-heading">Waiting for review</h2>
        <a href="manage_contributions.php" class="admin-btn admin-btn--ghost">All contributions</a>
      </div>
      <?php if (!$pendingContributions): ?>
      <p class="admin-empty">Nothing to review. You're all caught up.</p>
      <?php else: ?>
      <ul class="admin-list">
        <?php foreach ($pendingContributions as $c): ?>
        <li>
          <a href="view_contribution.php?id=<?= (int) $c['contribution_id'] ?>"><?= htmlspecialchars($c['plant_name']) ?></a>
          <span>by <?= htmlspecialchars($c['contributor_name']) ?> &middot; <?= date('j M', strtotime($c['created_at'])) ?></span>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </section>

    <section class="admin-panel" aria-labelledby="enquiries-heading">
      <div class="admin-panel__head">
        <h2 id="enquiries-heading">Latest enquiries</h2>
        <a href="manage_enquiries.php" class="admin-btn admin-btn--ghost">All enquiries</a>
      </div>
      <?php if (!$latestEnquiries): ?>
      <p class="admin-empty">No enquiries yet.</p>
      <?php else: ?>
      <ul class="admin-list">
        <?php foreach ($latestEnquiries as $e): ?>
        <li<?= $e['status'] === 'new' ? ' class="is-unread"' : '' ?>>
          <a href="view_enquiry.php?id=<?= (int) $e['enquiry_id'] ?>"><?= htmlspecialchars($e['first_name'] . ' ' . $e['last_name']) ?></a>
          <span><?= ucfirst($e['enquiry_type']) ?> &middot; <?= date('j M', strtotime($e['created_at'])) ?> <span class="status-pill status-pill--<?= $e['status'] ?>"><?= ucfirst($e['status']) ?></span></span>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </section>

    <section class="admin-panel" aria-labelledby="state-heading">
      <h2 id="state-heading">Users by state</h2>
      <?php if (!$byState): ?>
      <p class="admin-empty">No users yet.</p>
      <?php else: ?>
      <ul class="admin-bars">
        <?php foreach ($byState as $row): ?>
        <li>
          <span class="admin-bars__label"><?= htmlspecialchars($row['state']) ?></span>
          <span class="admin-bars__track"><span class="admin-bars__fill" style="width: <?= round($row['users'] / $topState * 100) ?>%"></span></span>
          <span class="admin-bars__value"><?= (int) $row['users'] ?></span>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </section>

    <section class="admin-panel" aria-labelledby="recent-heading">
      <div class="admin-panel__head">
        <h2 id="recent-heading">Recent sign-ups</h2>
        <a href="manage_users.php" class="admin-btn admin-btn--ghost">All users</a>
      </div>
      <?php if (!$recent): ?>
      <p class="admin-empty">No users yet. <a href="add_user.php">Add the first user</a>.</p>
      <?php else: ?>
      <ul class="admin-list">
        <?php foreach ($recent as $u): ?>
        <li>
          <a href="view_user.php?id=<?= (int) $u['user_id'] ?>"><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?></a>
          <span>@<?= htmlspecialchars($u['username']) ?> &middot; <?= htmlspecialchars($u['state']) ?> &middot; <?= date('j M', strtotime($u['created_at'])) ?></span>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </section>
  </div>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
