<?php
/*
 * Lists the plants added through plant_form.php, with edit and delete.
 * These appear publicly on plants.php. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';
require_once __DIR__ . '/includes/upload.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    if (!csrf_valid()) {
        flash('Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = mysqli_prepare($conn, 'SELECT scientific_name, image_path FROM `plant` WHERE plant_id = ?');
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $plant = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);

        if ($plant) {
            $stmt = mysqli_prepare($conn, 'DELETE FROM `plant` WHERE plant_id = ?');
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            delete_image($plant['image_path']);
            flash('“' . $plant['scientific_name'] . '” was deleted.');
        }
    }
    header('Location: manage_plants.php');
    exit;
}

$search = trim((string) ($_GET['q'] ?? ''));
$like = '%' . $search . '%';
$stmt = mysqli_prepare($conn, 'SELECT plant_id, scientific_name, common_name, family, genus, plant_type, image_path, created_at
    FROM `plant`
    WHERE scientific_name LIKE ? OR common_name LIKE ? OR family LIKE ? OR genus LIKE ?
    ORDER BY family, genus, scientific_name');
mysqli_stmt_bind_param($stmt, 'ssss', $like, $like, $like, $like);
mysqli_stmt_execute($stmt);
$plants = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

$pageTitle = 'Plants — Plant Story';
$adminTitle = 'Plants';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel" aria-labelledby="plants-heading">
    <div class="admin-panel__head">
      <h2 id="plants-heading">Added plants <span class="admin-count"><?= count($plants) ?></span></h2>
      <form class="admin-search" method="get" action="manage_plants.php" role="search">
        <label for="q" class="sr-only">Search plants</label>
        <input type="search" id="q" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search name, family or genus">
        <button type="submit" class="admin-btn">Search</button>
        <?php if ($search !== ''): ?><a href="manage_plants.php" class="admin-btn admin-btn--ghost">Clear</a><?php endif; ?>
        <a href="plant_form.php" class="admin-btn">+ Add plant</a>
      </form>
    </div>
    <p class="admin-note">These plants are shown to visitors on the <a href="plants.php" target="_blank" rel="noopener">New Additions</a> page, alongside the original 16 species in the catalogue.</p>

    <?php if (!$plants): ?>
    <p class="admin-empty">
      <?= $search !== '' ? 'No plants match “' . htmlspecialchars($search) . '”.' : 'No plants added yet.' ?>
      <a href="plant_form.php">Add a plant</a>.
    </p>
    <?php else: ?>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <caption class="sr-only">Added plants</caption>
        <thead>
          <tr>
            <th scope="col">Photo</th>
            <th scope="col">Scientific name</th>
            <th scope="col">Common name</th>
            <th scope="col">Family</th>
            <th scope="col">Genus</th>
            <th scope="col">Type</th>
            <th scope="col">Added</th>
            <th scope="col"><span class="sr-only">Actions</span></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($plants as $p): ?>
          <tr>
            <td data-label="Photo"><img src="<?= htmlspecialchars($p['image_path']) ?>" alt="" class="admin-thumb"></td>
            <td data-label="Scientific name"><em><?= htmlspecialchars($p['scientific_name']) ?></em></td>
            <td data-label="Common name"><?= htmlspecialchars($p['common_name']) ?: '—' ?></td>
            <td data-label="Family"><?= htmlspecialchars($p['family']) ?></td>
            <td data-label="Genus"><?= htmlspecialchars($p['genus']) ?></td>
            <td data-label="Type"><?= htmlspecialchars($p['plant_type']) ?></td>
            <td data-label="Added"><?= date('j M Y', strtotime($p['created_at'])) ?></td>
            <td class="admin-actions">
              <a href="plant_form.php?id=<?= (int) $p['plant_id'] ?>" class="admin-btn admin-btn--ghost">Edit</a>
              <form method="post" action="manage_plants.php" class="admin-inline-form" onsubmit="return confirm('Delete this plant? This cannot be undone.')">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int) $p['plant_id'] ?>">
                <button type="submit" name="action" value="delete" class="admin-btn admin-btn--danger">Delete</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
