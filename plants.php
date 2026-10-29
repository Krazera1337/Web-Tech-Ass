<?php
/*
 * Public list of species added by the admin through plant_form.php, with
 * an optional filter by family.
 */
require_once __DIR__ . '/includes/db.inc.php';

$family = trim((string) ($_GET['family'] ?? ''));
$families = array_column(mysqli_fetch_all(mysqli_query($conn, 'SELECT DISTINCT family FROM `plant` ORDER BY family')), 0);
if (!in_array($family, $families, true)) {
    $family = '';
}

$familyMatch = $family === '' ? '%' : $family;
$stmt = mysqli_prepare($conn, 'SELECT * FROM `plant` WHERE family LIKE ? ORDER BY created_at DESC, plant_id DESC');
mysqli_stmt_bind_param($stmt, 's', $familyMatch);
mysqli_stmt_execute($stmt);
$plants = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

$pageTitle = 'New Additions — Plant Story';
$pageDescription = 'Plant species recently added to the Plant Story collection';
$bodyClass = 'explore-page plants-page';
$activePage = 'explore';
$heroTitle = 'New Additions';
$heroLede = 'Species recently added to the Plant Story collection.';
$heroTag = 'header';
$heroCopyClass = true;
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

<div class="page-wrap">
  <main>
    <p>Beyond the sixteen species in our <a href="explore.php">core catalogue</a>, the collection keeps
    growing. Here are the latest plants our team has documented.</p>

    <?php if ($families): ?>
    <nav class="plant-filter" aria-label="Filter by family">
      <a href="plants.php"<?= $family === '' ? ' aria-current="page"' : '' ?>>All families</a>
      <?php foreach ($families as $f): ?>
      <a href="plants.php?family=<?= urlencode($f) ?>"<?= $family === $f ? ' aria-current="page"' : '' ?>><?= htmlspecialchars($f) ?></a>
      <?php endforeach; ?>
    </nav>
    <?php endif; ?>

    <?php if (!$plants): ?>
    <p class="plant-empty">No new species have been added yet. Check back soon, or <a href="contribute.php">contribute one yourself</a>.</p>
    <?php else: ?>
    <div class="plant-grid">
      <?php foreach ($plants as $p): ?>
      <article class="plant-card" id="plant-<?= (int) $p['plant_id'] ?>">
        <img src="<?= htmlspecialchars($p['image_path']) ?>" alt="<?= htmlspecialchars($p['scientific_name']) ?>" class="plant-card__img" loading="lazy">
        <div class="plant-card__body">
          <?php if ($p['common_name'] !== ''): ?>
          <h2 class="plant-card__title"><?= htmlspecialchars($p['common_name']) ?></h2>
          <p class="plant-card__sci"><em><?= htmlspecialchars($p['scientific_name']) ?></em></p>
          <?php else: ?>
          <h2 class="plant-card__title"><em><?= htmlspecialchars($p['scientific_name']) ?></em></h2>
          <?php endif; ?>
          <dl class="plant-card__meta">
            <div><dt>Family</dt><dd><?= htmlspecialchars($p['family']) ?></dd></div>
            <div><dt>Genus</dt><dd><?= htmlspecialchars($p['genus']) ?></dd></div>
            <div><dt>Type</dt><dd><?= htmlspecialchars($p['plant_type']) ?></dd></div>
          </dl>
          <p class="plant-card__desc"><?= nl2br(htmlspecialchars($p['description'])) ?></p>
          <p class="plant-card__date">Added <?= date('j M Y', strtotime($p['created_at'])) ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </main>
</div>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
