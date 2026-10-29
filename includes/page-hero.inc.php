<?php
$heroTag = $heroTag ?? 'section';
$heroVariant = $heroVariant ?? 'page';
if ($heroVariant === 'form'):
echo '<';
echo $heroTag;
echo ' class="form-page-hero blended-hero">
  <div class="hero-copy">
    <h1>';
echo $heroTitle;
echo '</h1>
    <p>';
echo $heroLede;
echo '</p>
  </div>
</';
echo $heroTag;
echo '>
';
else:
echo '<';
echo $heroTag;
echo ' class="page-hero blended-hero">
  <div class="container';
echo !empty($heroCopyClass) ? ' hero-copy' : '';
echo '">
    <h1>';
echo $heroTitle;
echo '</h1>
    <p class="page-hero-lede">';
echo $heroLede;
echo '</p>
  </div>
</';
echo $heroTag;
echo '>
';
endif;
