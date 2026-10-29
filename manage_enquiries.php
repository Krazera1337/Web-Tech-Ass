<?php
/*
 * Lists enquiries sent from enquiry.php, filtered by status, with a search
 * across name, email and message. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';

const ENQUIRY_FILTERS = ['new' => 'New', 'read' => 'Read', 'replied' => 'Replied', 'all' => 'All'];

$filter = $_GET['status'] ?? 'all';
if (!isset(ENQUIRY_FILTERS[$filter])) {
    $filter = 'all';
}
$search = trim((string) ($_GET['q'] ?? ''));

$counts = ['all' => 0];
foreach (mysqli_fetch_all(mysqli_query($conn, 'SELECT status, COUNT(*) FROM `enquiry` GROUP BY status')) as [$status, $n]) {
    $counts[$status] = (int) $n;
    $counts['all'] += (int) $n;
}

$like = '%' . $search . '%';
$statusMatch = $filter === 'all' ? '%' : $filter;
$stmt = mysqli_prepare($conn, "SELECT enquiry_id, first_name, last_name, email, enquiry_type, comments, status, created_at
    FROM `enquiry`
    WHERE status LIKE ?
      AND (CONCAT(first_name, ' ', last_name) LIKE ? OR email LIKE ? OR comments LIKE ?)
    ORDER BY created_at DESC, enquiry_id DESC");
mysqli_stmt_bind_param($stmt, 'ssss', $statusMatch, $like, $like, $like);
mysqli_stmt_execute($stmt);
$enquiries = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

$pageTitle = 'Enquiries — Plant Story';
$adminTitle = 'Enquiries';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel" aria-labelledby="enquiry-heading">
    <div class="admin-panel__head">
      <h2 id="enquiry-heading">Visitor enquiries</h2>
      <form class="admin-search" method="get" action="manage_enquiries.php" role="search">
        <input type="hidden" name="status" value="<?= $filter ?>">
        <label for="q" class="sr-only">Search enquiries</label>
        <input type="search" id="q" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search name, email or message">
        <button type="submit" class="admin-btn">Search</button>
        <?php if ($search !== ''): ?><a href="manage_enquiries.php?status=<?= $filter ?>" class="admin-btn admin-btn--ghost">Clear</a><?php endif; ?>
      </form>
    </div>
    <nav class="admin-tabs" aria-label="Filter by status">
      <?php foreach (ENQUIRY_FILTERS as $key => $label): ?>
      <a href="manage_enquiries.php?status=<?= $key ?><?= $search !== '' ? '&amp;q=' . urlencode($search) : '' ?>"<?= $filter === $key ? ' aria-current="page"' : '' ?>><?= $label ?> <span class="admin-count"><?= $counts[$key] ?? 0 ?></span></a>
      <?php endforeach; ?>
    </nav>

    <?php if (!$enquiries): ?>
    <p class="admin-empty"><?= $search !== '' ? 'No enquiries match “' . htmlspecialchars($search) . '”.' : 'No enquiries here yet.' ?></p>
    <?php else: ?>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <caption class="sr-only"><?= ENQUIRY_FILTERS[$filter] ?> enquiries</caption>
        <thead>
          <tr>
            <th scope="col">Ref</th>
            <th scope="col">From</th>
            <th scope="col">Type</th>
            <th scope="col">Message</th>
            <th scope="col">Status</th>
            <th scope="col">Received</th>
            <th scope="col"><span class="sr-only">Actions</span></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($enquiries as $e): ?>
          <tr<?= $e['status'] === 'new' ? ' class="is-unread"' : '' ?>>
            <td data-label="Ref"><?= sprintf('PS-E%04d', $e['enquiry_id']) ?></td>
            <td data-label="From"><?= htmlspecialchars($e['first_name'] . ' ' . $e['last_name']) ?><br><small><?= htmlspecialchars($e['email']) ?></small></td>
            <td data-label="Type"><?= ucfirst($e['enquiry_type']) ?></td>
            <td data-label="Message" class="admin-excerpt"><?= htmlspecialchars(mb_strimwidth($e['comments'], 0, 90, '…')) ?></td>
            <td data-label="Status"><span class="status-pill status-pill--<?= $e['status'] ?>"><?= ucfirst($e['status']) ?></span></td>
            <td data-label="Received"><?= date('j M Y', strtotime($e['created_at'])) ?></td>
            <td class="admin-actions"><a href="view_enquiry.php?id=<?= (int) $e['enquiry_id'] ?>" class="admin-btn admin-btn--ghost">Open</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
