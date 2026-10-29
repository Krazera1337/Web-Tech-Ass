<?php
/*
 * Adds a new plant, or edits one when ?id= is given. Plants are stored in
 * the `plant` table with their photo under uploads/plants/ and listed
 * publicly on plants.php. Admin sign-in required.
 */
require_once __DIR__ . '/includes/admin-auth.inc.php';
require_once __DIR__ . '/includes/db.inc.php';
require_once __DIR__ . '/includes/upload.inc.php';

const PLANT_TYPES = ['Tree', 'Shrub', 'Climber', 'Herb', 'Palm', 'Fern', 'Other'];
const PLANT_FIELDS = ['scientific_name', 'common_name', 'family', 'genus', 'plant_type', 'description'];

$id = (int) ($_REQUEST['id'] ?? 0);
$plant = null;
if ($id > 0) {
    $stmt = mysqli_prepare($conn, 'SELECT * FROM `plant` WHERE plant_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $plant = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);

    if (!$plant) {
        flash('That plant no longer exists.');
        header('Location: manage_plants.php');
        exit;
    }
}

$values = [];
foreach (PLANT_FIELDS as $field) {
    $values[$field] = $plant[$field] ?? '';
}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (PLANT_FIELDS as $field) {
        $values[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    if (!csrf_valid()) {
        $errors['form'] = 'Your session expired. Please submit the form again.';
    }
    if (!preg_match('/^[A-Za-z][A-Za-z .()&×-]{2,99}$/u', $values['scientific_name'])) {
        $errors['scientific_name'] = 'Enter the scientific name (letters, spaces and . ( ) & - only, 3–100 characters).';
    } else {
        $stmt = mysqli_prepare($conn, 'SELECT plant_id FROM `plant` WHERE scientific_name = ? AND plant_id <> ?');
        mysqli_stmt_bind_param($stmt, 'si', $values['scientific_name'], $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors['scientific_name'] = 'A plant with this scientific name already exists.';
        }
        mysqli_stmt_close($stmt);
    }
    if (mb_strlen($values['common_name']) > 100) {
        $errors['common_name'] = 'Common name must be 100 characters or fewer.';
    }
    foreach (['family' => 'Family', 'genus' => 'Genus'] as $field => $label) {
        if (!preg_match('/^[A-Za-z]{2,50}$/', $values[$field])) {
            $errors[$field] = "$label must be a single word of letters only.";
        }
    }
    if (!in_array($values['plant_type'], PLANT_TYPES, true)) {
        $errors['plant_type'] = 'Select a plant type.';
    }
    if ($values['description'] === '') {
        $errors['description'] = 'Add a short description.';
    } elseif (mb_strlen($values['description']) > 2000) {
        $errors['description'] = 'Description must be 2000 characters or fewer.';
    }

    $image = uploaded_files('image')[0] ?? null;
    if ($image) {
        if (($error = image_upload_error($image)) !== '') {
            $errors['image'] = $error;
        }
    } elseif (!$plant) {
        $errors['image'] = 'Add a photo of the plant.';
    }

    if (!$errors) {
        $imagePath = $plant['image_path'] ?? '';
        if ($image) {
            $imagePath = store_image($image, 'plants');
            if ($plant) {
                delete_image($plant['image_path']);
            }
        }

        if ($plant) {
            $stmt = mysqli_prepare($conn, 'UPDATE `plant` SET scientific_name = ?, common_name = ?, family = ?, genus = ?,
                plant_type = ?, description = ?, image_path = ? WHERE plant_id = ?');
            mysqli_stmt_bind_param($stmt, 'sssssssi', $values['scientific_name'], $values['common_name'], $values['family'],
                $values['genus'], $values['plant_type'], $values['description'], $imagePath, $id);
        } else {
            $stmt = mysqli_prepare($conn, 'INSERT INTO `plant` (scientific_name, common_name, family, genus, plant_type, description, image_path)
                VALUES (?, ?, ?, ?, ?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'sssssss', $values['scientific_name'], $values['common_name'], $values['family'],
                $values['genus'], $values['plant_type'], $values['description'], $imagePath);
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        flash('“' . $values['scientific_name'] . '” was ' . ($plant ? 'updated.' : 'added to the collection.'));
        header('Location: manage_plants.php');
        exit;
    }
}

// Suggestions for the family and genus fields: the original catalogue plus anything added since.
$families = ['Myristicaceae', 'Chrysobalanaceae', 'Meliaceae', 'Ebenaceae'];
$genera = ['Horsfieldia', 'Knema', 'Parastemon', 'Hirtella', 'Aglaia', 'Dysoxylum', 'Diospyros', 'Euclea'];
foreach (mysqli_fetch_all(mysqli_query($conn, 'SELECT DISTINCT family, genus FROM `plant`')) as [$family, $genus]) {
    $families[] = $family;
    $genera[] = $genus;
}
$families = array_unique($families);
$genera = array_unique($genera);
sort($families);
sort($genera);

// Inline error message for a field, if it has one.
function plant_error($errors, $field)
{
    return isset($errors[$field]) ? '<p class="field-error" id="' . $field . '-error">' . htmlspecialchars($errors[$field]) . '</p>' : '';
}

// aria attributes linking an invalid field to its error message.
function plant_invalid($errors, $field)
{
    return isset($errors[$field]) ? ' aria-invalid="true" aria-describedby="' . $field . '-error"' : '';
}

$v = array_map('htmlspecialchars', $values);

$pageTitle = ($plant ? 'Edit Plant' : 'Add Plant') . ' — Plant Story';
$adminTitle = $plant ? 'Edit plant' : 'Add a plant';
include __DIR__ . '/includes/admin-head.inc.php';
?>

  <section class="admin-panel admin-panel--narrow" aria-labelledby="plant-form-heading">
    <h2 id="plant-form-heading"><?= $plant ? htmlspecialchars($plant['scientific_name']) : 'New species' ?></h2>
    <?php if ($errors): ?>
    <p class="form-alert form-alert--error" role="alert"><?= htmlspecialchars($errors['form'] ?? 'Please fix the highlighted fields and try again.') ?></p>
    <?php endif; ?>

    <form method="post" action="plant_form.php" enctype="multipart/form-data" class="admin-form" novalidate>
      <?= csrf_field() ?>
      <?php if ($plant): ?><input type="hidden" name="id" value="<?= $id ?>"><?php endif; ?>

      <div class="admin-form__grid">
        <div class="admin-field admin-field--wide">
          <label for="scientific_name">Scientific name <span aria-hidden="true">*</span></label>
          <input type="text" id="scientific_name" name="scientific_name" value="<?= $v['scientific_name'] ?>" maxlength="100" placeholder="e.g. Knema laurina (Blume) Warb." required<?= plant_invalid($errors, 'scientific_name') ?>>
          <?= plant_error($errors, 'scientific_name') ?>
        </div>
        <div class="admin-field admin-field--wide">
          <label for="common_name">Common name</label>
          <input type="text" id="common_name" name="common_name" value="<?= $v['common_name'] ?>" maxlength="100" placeholder="Optional"<?= plant_invalid($errors, 'common_name') ?>>
          <?= plant_error($errors, 'common_name') ?>
        </div>
        <div class="admin-field">
          <label for="family">Family <span aria-hidden="true">*</span></label>
          <input type="text" id="family" name="family" value="<?= $v['family'] ?>" maxlength="50" list="family-list" required<?= plant_invalid($errors, 'family') ?>>
          <datalist id="family-list"><?php foreach ($families as $f): ?><option value="<?= htmlspecialchars($f) ?>"><?php endforeach; ?></datalist>
          <?= plant_error($errors, 'family') ?>
        </div>
        <div class="admin-field">
          <label for="genus">Genus <span aria-hidden="true">*</span></label>
          <input type="text" id="genus" name="genus" value="<?= $v['genus'] ?>" maxlength="50" list="genus-list" required<?= plant_invalid($errors, 'genus') ?>>
          <datalist id="genus-list"><?php foreach ($genera as $g): ?><option value="<?= htmlspecialchars($g) ?>"><?php endforeach; ?></datalist>
          <?= plant_error($errors, 'genus') ?>
        </div>
        <div class="admin-field">
          <label for="plant_type">Plant type <span aria-hidden="true">*</span></label>
          <select id="plant_type" name="plant_type" required<?= plant_invalid($errors, 'plant_type') ?>>
            <option value="" disabled<?= $values['plant_type'] === '' ? ' selected' : '' ?>>Select a type</option>
            <?php foreach (PLANT_TYPES as $type): ?>
            <option<?= $values['plant_type'] === $type ? ' selected' : '' ?>><?= $type ?></option>
            <?php endforeach; ?>
          </select>
          <?= plant_error($errors, 'plant_type') ?>
        </div>
        <div class="admin-field">
          <label for="image">Photo<?= $plant ? '' : ' <span aria-hidden="true">*</span>' ?></label>
          <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif,image/webp"<?= $plant ? '' : ' required' ?><?= plant_invalid($errors, 'image') ?>>
          <small class="form-hint"><?= $plant ? 'Leave empty to keep the current photo. ' : '' ?>JPG, PNG, GIF or WebP, up to 5 MB.</small>
          <?= plant_error($errors, 'image') ?>
        </div>
        <?php if ($plant): ?>
        <div class="admin-field admin-field--wide">
          <span class="admin-field__label">Current photo</span>
          <img src="<?= htmlspecialchars($plant['image_path']) ?>" alt="Current photo of <?= htmlspecialchars($plant['scientific_name']) ?>" class="admin-preview">
        </div>
        <?php endif; ?>
        <div class="admin-field admin-field--wide">
          <label for="description">Description <span aria-hidden="true">*</span></label>
          <textarea id="description" name="description" rows="6" maxlength="2000" required<?= plant_invalid($errors, 'description') ?>><?= $v['description'] ?></textarea>
          <?= plant_error($errors, 'description') ?>
        </div>
      </div>

      <div class="admin-panel__actions">
        <button type="submit" class="admin-btn"><?= $plant ? 'Save changes' : 'Add plant' ?></button>
        <a href="manage_plants.php" class="admin-btn admin-btn--ghost">Cancel</a>
      </div>
    </form>
  </section>

<?php include __DIR__ . '/includes/admin-foot.inc.php'; ?>
