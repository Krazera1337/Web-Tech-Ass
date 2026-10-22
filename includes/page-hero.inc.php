<?php
/*
 * Page banner shown under the navigation on inner pages.
 *
 * Set before including:
 *   $heroTitle       heading text
 *   $heroLede        one-line summary under the heading
 * Optional:
 *   $heroTag         'section' (default) or 'header'
 *   $heroVariant     'page' (default) or 'form' for the login/register/enquiry banner
 *   $heroCopyClass   true to add the hero-copy class to the inner container
 */
$heroTag = $heroTag ?? 'section';
$heroVariant = $heroVariant ?? 'page';
?>
<?php if ($heroVariant === 'form'): ?>
<<?= $heroTag ?> class="form-page-hero blended-hero">
  <div class="hero-copy">
    <h1><?= $heroTitle ?></h1>
    <p><?= $heroLede ?></p>
  </div>
</<?= $heroTag ?>>
<?php else: ?>
<<?= $heroTag ?> class="page-hero blended-hero">
  <div class="container<?= !empty($heroCopyClass) ? ' hero-copy' : '' ?>">
    <h1><?= $heroTitle ?></h1>
    <p class="page-hero-lede"><?= $heroLede ?></p>
  </div>
</<?= $heroTag ?>>
<?php endif; ?>
