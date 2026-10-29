<?php
/*
 * Shows one enquiry. Opening a new enquiry marks it as read; the admin can
 * reply by email, mark it replied or unread, or delete it. Changes other
 * than the automatic "read" only happen on POST. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';

$id = (int) ($_REQUEST['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM `enquiry` WHERE enquiry_id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$e = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$e) {
    flash('That enquiry no longer exists.');
    header('Location: manage_enquiries.php');
    exit;
}

$ref = sprintf('PS-E%04d', $e['enquiry_id']);
$error = '';

// Sets this enquiry's status.
function set_enquiry_status($conn, $id, $status)
{
    $stmt = mysqli_prepare($conn, 'UPDATE `enquiry` SET status = ? WHERE enquiry_id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if (!csrf_valid()) {
        $error = 'Your session expired. Please try again.';
    } elseif ($action === 'delete') {
        $stmt = mysqli_prepare($conn, 'DELETE FROM `enquiry` WHERE enquiry_id = ?');
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        flash("Enquiry $ref was deleted.");
        header('Location: manage_enquiries.php');
        exit;
    } elseif ($action === 'replied' || $action === 'new') {
        set_enquiry_status($conn, $id, $action);
        flash("Enquiry $ref was marked as " . ($action === 'new' ? 'unread' : 'replied') . '.');
        header('Location: manage_enquiries.php');
        exit;
    }
} elseif ($e['status'] === 'new') {
    set_enquiry_status($conn, $id, 'read');
    $e['status'] = 'read';
}

$name = $e['first_name'] . ' ' . $e['last_name'];
$replyLink = 'mailto:' . rawurlencode($e['email'])
    . '?subject=' . rawurlencode("Re: your Plant Story enquiry ($ref)")
    . '&body=' . rawurlencode("Hi {$e['first_name']},\n\n\n\n> " . str_replace("\n", "\n> ", $e['comments']));

$pageTitle = "Enquiry $ref — Plant Story";
$adminTitle = "Enquiry $ref";
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel admin-panel--narrow" aria-labelledby="details-heading">
    <div class="admin-panel__head">
      <h2 id="details-heading"><?= htmlspecialchars($name) ?></h2>
      <span class="status-pill status-pill--<?= $e['status'] ?>"><?= ucfirst($e['status']) ?></span>
    </div>
    <?php if ($error !== ''): ?>
    <p class="form-alert form-alert--error" role="alert"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <blockquote class="admin-message"><?= nl2br(htmlspecialchars($e['comments'])) ?></blockquote>

    <dl class="admin-details">
      <div><dt>Email</dt><dd><a href="mailto:<?= htmlspecialchars($e['email']) ?>"><?= htmlspecialchars($e['email']) ?></a></dd></div>
      <div><dt>Phone</dt><dd><a href="tel:<?= htmlspecialchars($e['phone']) ?>"><?= htmlspecialchars($e['phone']) ?></a></dd></div>
      <div><dt>Enquiry type</dt><dd><?= ucfirst($e['enquiry_type']) ?></dd></div>
      <div><dt>Received</dt><dd><?= date('j M Y, g:i a', strtotime($e['created_at'])) ?></dd></div>
    </dl>

    <form method="post" action="view_enquiry.php" class="admin-panel__actions">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int) $e['enquiry_id'] ?>">
      <a href="<?= htmlspecialchars($replyLink) ?>" class="admin-btn">Reply by email</a>
      <?php if ($e['status'] !== 'replied'): ?>
      <button type="submit" name="action" value="replied" class="admin-btn admin-btn--ghost">Mark as replied</button>
      <?php endif; ?>
      <button type="submit" name="action" value="new" class="admin-btn admin-btn--ghost">Mark as unread</button>
      <button type="submit" name="action" value="delete" class="admin-btn admin-btn--danger" onclick="return confirm('Delete this enquiry? This cannot be undone.')">Delete</button>
      <a href="manage_enquiries.php" class="admin-btn admin-btn--ghost">Back to list</a>
    </form>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
