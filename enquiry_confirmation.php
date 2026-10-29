<?php
/*
 * Shown after an enquiry is sent. Reads the enquiry saved in this
 * visitor's session, so other people's messages cannot be viewed.
 */
session_start();

$id = (int) ($_SESSION['last_enquiry'] ?? 0);
if ($id === 0) {
    header('Location: enquiry.php');
    exit;
}

require_once __DIR__ . '/includes/db.inc.php';

$stmt = mysqli_prepare($conn, 'SELECT * FROM `enquiry` WHERE enquiry_id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$e = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$e) {
    unset($_SESSION['last_enquiry']);
    header('Location: enquiry.php');
    exit;
}

$pageTitle = 'Enquiry Sent — Plant Story';
$bodyClass = 'enquiry-page confirmation-page';
$activePage = 'enquiry';
$heroTitle = 'Enquiry Sent';
$heroLede = 'Thank you for getting in touch with Plant Story.';
$heroTag = 'header';
$heroVariant = 'form';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

<main class="confirm-main">
  <section class="confirm-card" aria-labelledby="confirm-heading">
    <p class="confirm-badge" aria-hidden="true">&#10003;</p>
    <h2 id="confirm-heading">Thanks, <?= htmlspecialchars($e['first_name']) ?>!</h2>
    <p class="confirm-lede">We have received your enquiry and will reply to <strong><?= htmlspecialchars($e['email']) ?></strong>. Please quote your reference if you contact us about it.</p>

    <dl class="confirm-details">
      <div><dt>Reference</dt><dd><?= sprintf('PS-E%04d', $e['enquiry_id']) ?></dd></div>
      <div><dt>Sent</dt><dd><?= date('j M Y, g:i a', strtotime($e['created_at'])) ?></dd></div>
      <div><dt>Name</dt><dd><?= htmlspecialchars($e['first_name'] . ' ' . $e['last_name']) ?></dd></div>
      <div><dt>Email</dt><dd><?= htmlspecialchars($e['email']) ?></dd></div>
      <div><dt>Phone</dt><dd><?= htmlspecialchars($e['phone']) ?></dd></div>
      <div><dt>Enquiry type</dt><dd><?= ucfirst($e['enquiry_type']) ?></dd></div>
      <div><dt>Message</dt><dd><?= nl2br(htmlspecialchars($e['comments'])) ?></dd></div>
    </dl>

    <div class="confirm-actions">
      <a href="enquiry.php" class="btn">Send another enquiry</a>
      <a href="explore.php" class="btn btn-ghost">Explore the collection</a>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
