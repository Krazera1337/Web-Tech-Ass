<?php
/*
 * Shown after a successful contribution. Reads the contribution saved in
 * this visitor's session, so a submission cannot be looked up by guessing
 * its number.
 */
session_start();

$id = (int) ($_SESSION['last_contribution'] ?? 0);
if ($id === 0) {
    header('Location: contribute.php');
    exit;
}

require_once __DIR__ . '/includes/db.inc.php';

$stmt = mysqli_prepare($conn, 'SELECT * FROM `contribution` WHERE contribution_id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$c = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$c) {
    unset($_SESSION['last_contribution']);
    header('Location: contribute.php');
    exit;
}

$stmt = mysqli_prepare($conn, 'SELECT file_path FROM `contribution_photo` WHERE contribution_id = ? ORDER BY photo_id');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$photos = array_column(mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC), 'file_path');
mysqli_stmt_close($stmt);

$pageTitle = 'Contribution Received — Plant Story';
$bodyClass = 'community-page contribution-page confirmation-page';
$activePage = 'contribute';
$heroTitle = 'Thank You!';
$heroLede = 'Your contribution has been received.';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

<main class="confirm-main">
  <section class="confirm-card" aria-labelledby="confirm-heading">
    <p class="confirm-badge" aria-hidden="true">&#10003;</p>
    <h2 id="confirm-heading">Thanks, <?= htmlspecialchars($c['contributor_name']) ?>!</h2>
    <p class="confirm-lede">Your observation of <strong><?= htmlspecialchars($c['plant_name']) ?></strong> is now waiting for review. Once an administrator approves it, it will appear on the Contributors page.</p>

    <dl class="confirm-details">
      <div><dt>Reference</dt><dd><?= sprintf('PS-C%04d', $c['contribution_id']) ?></dd></div>
      <div><dt>Submitted</dt><dd><?= date('j M Y, g:i a', strtotime($c['created_at'])) ?></dd></div>
      <div><dt>Status</dt><dd><span class="status-pill status-pill--<?= $c['status'] ?>"><?= ucfirst($c['status']) ?></span></dd></div>
      <div><dt>Contributor</dt><dd><?= htmlspecialchars($c['contributor_name']) ?></dd></div>
      <div><dt>Plant</dt><dd><?= htmlspecialchars($c['plant_name']) ?></dd></div>
      <div><dt>Comments</dt><dd><?= nl2br(htmlspecialchars($c['comments'])) ?></dd></div>
    </dl>

    <?php if ($photos): ?>
    <h3>Your photo<?= count($photos) > 1 ? 's' : '' ?></h3>
    <div class="photo-strip">
      <?php foreach ($photos as $i => $path): ?>
      <img src="<?= htmlspecialchars($path) ?>" alt="Photo <?= $i + 1 ?> of <?= htmlspecialchars($c['plant_name']) ?>">
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="confirm-actions">
      <a href="contribute.php" class="btn">Submit another</a>
      <a href="contributor.php" class="btn btn-ghost">Back to Contributors</a>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
