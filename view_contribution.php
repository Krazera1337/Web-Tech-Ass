<?php
/*
 * Shows one contribution with its photos and lets the admin approve,
 * reject or delete it. Approved contributions appear on contributor.php.
 * Changes only happen on POST. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';
require_once __DIR__ . '/includes/upload.inc.php';

$id = (int) ($_REQUEST['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM `contribution` WHERE contribution_id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$c = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$c) {
    flash('That contribution no longer exists.');
    header('Location: manage_contributions.php');
    exit;
}

$stmt = mysqli_prepare($conn, 'SELECT file_path FROM `contribution_photo` WHERE contribution_id = ? ORDER BY photo_id');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$photos = array_column(mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC), 'file_path');
mysqli_stmt_close($stmt);

$ref = sprintf('PS-C%04d', $c['contribution_id']);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if (!csrf_valid()) {
        $error = 'Your session expired. Please try again.';
    } elseif ($action === 'delete') {
        foreach ($photos as $path) {
            delete_image($path);
        }
        $stmt = mysqli_prepare($conn, 'DELETE FROM `contribution` WHERE contribution_id = ?');
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        flash("Contribution $ref was deleted.");
        header('Location: manage_contributions.php');
        exit;
    } elseif (in_array($action, ['approved', 'rejected', 'pending'], true)) {
        $stmt = mysqli_prepare($conn, 'UPDATE `contribution` SET status = ? WHERE contribution_id = ?');
        mysqli_stmt_bind_param($stmt, 'si', $action, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $messages = ['approved' => 'approved and is now public', 'rejected' => 'rejected', 'pending' => 'moved back to pending'];
        flash("Contribution $ref was {$messages[$action]}.");
        header('Location: manage_contributions.php?status=' . ($action === 'pending' ? 'pending' : 'all'));
        exit;
    }
}

$pageTitle = "Contribution $ref — Plant Story";
$adminTitle = "Contribution $ref";
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel admin-panel--narrow" aria-labelledby="details-heading">
    <div class="admin-panel__head">
      <h2 id="details-heading"><?= htmlspecialchars($c['plant_name']) ?></h2>
      <span class="status-pill status-pill--<?= $c['status'] ?>"><?= ucfirst($c['status']) ?></span>
    </div>
    <?php if ($error !== ''): ?>
    <p class="form-alert form-alert--error" role="alert"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($photos): ?>
    <div class="photo-strip">
      <?php foreach ($photos as $i => $path): ?>
      <a href="<?= htmlspecialchars($path) ?>" target="_blank" rel="noopener"><img src="<?= htmlspecialchars($path) ?>" alt="Photo <?= $i + 1 ?> of <?= htmlspecialchars($c['plant_name']) ?>"></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <dl class="admin-details">
      <div><dt>Contributor</dt><dd><?= htmlspecialchars($c['contributor_name']) ?></dd></div>
      <div><dt>Plant name</dt><dd><?= htmlspecialchars($c['plant_name']) ?></dd></div>
      <div><dt>Comments</dt><dd><?= nl2br(htmlspecialchars($c['comments'])) ?></dd></div>
      <div><dt>Photos</dt><dd><?= count($photos) ?></dd></div>
      <div><dt>Submitted</dt><dd><?= date('j M Y, g:i a', strtotime($c['created_at'])) ?></dd></div>
    </dl>

    <form method="post" action="view_contribution.php" class="admin-panel__actions">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int) $c['contribution_id'] ?>">
      <?php if ($c['status'] !== 'approved'): ?>
      <button type="submit" name="action" value="approved" class="admin-btn">Approve</button>
      <?php endif; ?>
      <?php if ($c['status'] !== 'rejected'): ?>
      <button type="submit" name="action" value="rejected" class="admin-btn admin-btn--ghost">Reject</button>
      <?php endif; ?>
      <?php if ($c['status'] !== 'pending'): ?>
      <button type="submit" name="action" value="pending" class="admin-btn admin-btn--ghost">Move back to pending</button>
      <?php endif; ?>
      <button type="submit" name="action" value="delete" class="admin-btn admin-btn--danger" onclick="return confirm('Delete this contribution and its photos? This cannot be undone.')">Delete</button>
      <a href="manage_contributions.php" class="admin-btn admin-btn--ghost">Back to list</a>
    </form>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
