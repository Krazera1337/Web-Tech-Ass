<?php
/*
 * Lists plant contributions sent in from contribute.php, filtered by review
 * status. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';

const CONTRIBUTION_FILTERS = ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'all' => 'All'];

$filter = $_GET['status'] ?? 'pending';
if (!isset(CONTRIBUTION_FILTERS[$filter])) {
    $filter = 'pending';
}

$counts = ['all' => 0];
foreach (mysqli_fetch_all(mysqli_query($conn, 'SELECT status, COUNT(*) FROM `contribution` GROUP BY status')) as [$status, $n]) {
    $counts[$status] = (int) $n;
    $counts['all'] += (int) $n;
}

// $filter is one of the fixed CONTRIBUTION_FILTERS keys, so it is safe to embed.
$sql = 'SELECT c.contribution_id, c.contributor_name, c.plant_name, c.status, c.created_at,
        (SELECT COUNT(*) FROM `contribution_photo` p WHERE p.contribution_id = c.contribution_id) AS photos,
        (SELECT p.file_path FROM `contribution_photo` p WHERE p.contribution_id = c.contribution_id ORDER BY p.photo_id LIMIT 1) AS thumb
    FROM `contribution` c';
if ($filter !== 'all') {
    $sql .= " WHERE c.status = '$filter'";
}
$sql .= ' ORDER BY c.created_at DESC, c.contribution_id DESC';
$contributions = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

$pageTitle = 'Contributions — Plant Story';
$adminTitle = 'Contributions';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel" aria-labelledby="contrib-heading">
    <div class="admin-panel__head">
      <h2 id="contrib-heading">Plant contributions</h2>
      <nav class="admin-tabs" aria-label="Filter by status">
        <?php foreach (CONTRIBUTION_FILTERS as $key => $label): ?>
        <a href="manage_contributions.php?status=<?= $key ?>"<?= $filter === $key ? ' aria-current="page"' : '' ?>><?= $label ?> <span class="admin-count"><?= $counts[$key] ?? 0 ?></span></a>
        <?php endforeach; ?>
      </nav>
    </div>

    <?php if (!$contributions): ?>
    <p class="admin-empty">No <?= $filter === 'all' ? '' : strtolower(CONTRIBUTION_FILTERS[$filter]) . ' ' ?>contributions.</p>
    <?php else: ?>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <caption class="sr-only"><?= CONTRIBUTION_FILTERS[$filter] ?> contributions</caption>
        <thead>
          <tr>
            <th scope="col">Ref</th>
            <th scope="col">Photo</th>
            <th scope="col">Plant</th>
            <th scope="col">Contributor</th>
            <th scope="col">Status</th>
            <th scope="col">Submitted</th>
            <th scope="col"><span class="sr-only">Actions</span></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($contributions as $c): ?>
          <tr>
            <td data-label="Ref"><?= sprintf('PS-C%04d', $c['contribution_id']) ?></td>
            <td data-label="Photo"><?php if ($c['thumb']): ?><img src="<?= htmlspecialchars($c['thumb']) ?>" alt="" class="admin-thumb"><?php if ($c['photos'] > 1): ?> <small>+<?= $c['photos'] - 1 ?></small><?php endif; ?><?php endif; ?></td>
            <td data-label="Plant"><?= htmlspecialchars($c['plant_name']) ?></td>
            <td data-label="Contributor"><?= htmlspecialchars($c['contributor_name']) ?></td>
            <td data-label="Status"><span class="status-pill status-pill--<?= $c['status'] ?>"><?= ucfirst($c['status']) ?></span></td>
            <td data-label="Submitted"><?= date('j M Y', strtotime($c['created_at'])) ?></td>
            <td class="admin-actions"><a href="view_contribution.php?id=<?= (int) $c['contribution_id'] ?>" class="admin-btn admin-btn--ghost"><?= $c['status'] === 'pending' ? 'Review' : 'View' ?></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
