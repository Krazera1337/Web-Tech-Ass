<?php
/*
 * Opening markup for the stand-alone admin pages (no site header, banner
 * or footer): document head, page heading, admin toolbar and any flash
 * message. Close the page with admin-foot.inc.php.
 *
 * Set before including:
 *   $pageTitle   text for the <title> element
 *   $adminTitle  heading shown at the top of the page
 * Optional:
 *   $adminBodyClass  extra classes for <body>, e.g. 'auth-page register-page' for the user forms
 *   $adminMainClass  extra classes for <main>
 */
$bodyClass = trim('admin-page admin-standalone ' . ($adminBodyClass ?? ''));
include __DIR__ . '/header.inc.php';
$flashMessage = flash();
?>
<main class="<?= trim('admin-main ' . ($adminMainClass ?? '')) ?>">
  <h1 class="admin-title"><?= htmlspecialchars($adminTitle) ?></h1>
  <?php include __DIR__ . '/admin-bar.inc.php'; ?>

  <?php if ($flashMessage): ?>
  <p class="form-alert form-alert--success" role="status"><?= htmlspecialchars($flashMessage) ?></p>
  <?php endif; ?>
