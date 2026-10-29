<?php
<<<<<<< HEAD
=======
/*
 * Contribution form. Valid submissions are saved to the `contribution`
 * table with their photos stored under uploads/contributions/, then the
 * visitor is sent to contribution_confirmation.php. New contributions wait
 * as "pending" until an admin approves them.
 */
session_start();

$values = ['contributor' => '', 'plantname' => '', 'comments' => ''];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/includes/db.inc.php';
    require_once __DIR__ . '/includes/upload.inc.php';

    foreach ($values as $field => $_) {
        $values[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    if (!preg_match('/^[A-Za-z ]{1,25}$/', $values['contributor'])) {
        $errors[] = 'Your name must be letters and spaces only, up to 25 characters.';
    }
    if (!preg_match('/^[A-Za-z ]{1,25}$/', $values['plantname'])) {
        $errors[] = "The plant's name must be letters and spaces only, up to 25 characters.";
    }
    if ($values['comments'] === '') {
        $errors[] = 'Please add a comment about the plant.';
    } elseif (mb_strlen($values['comments']) > 1000) {
        $errors[] = 'Comments must be 1000 characters or fewer.';
    }

    $photos = uploaded_files('photo');
    if (!$photos) {
        $errors[] = 'Please attach at least one photo.';
    } elseif (count($photos) > 5) {
        $errors[] = 'You can attach up to 5 photos.';
    } else {
        foreach ($photos as $photo) {
            if (($error = image_upload_error($photo)) !== '') {
                $errors[] = $error;
            }
        }
    }

    if (!$errors) {
        $stmt = mysqli_prepare($conn, 'INSERT INTO `contribution` (contributor_name, plant_name, comments) VALUES (?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sss', $values['contributor'], $values['plantname'], $values['comments']);
        mysqli_stmt_execute($stmt);
        $contributionId = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);

        $stmt = mysqli_prepare($conn, 'INSERT INTO `contribution_photo` (contribution_id, file_path) VALUES (?, ?)');
        foreach ($photos as $photo) {
            $path = store_image($photo, 'contributions');
            mysqli_stmt_bind_param($stmt, 'is', $contributionId, $path);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);

        // Only the person who just submitted can see the confirmation.
        $_SESSION['last_contribution'] = $contributionId;
        header('Location: contribution_confirmation.php');
        exit;
    }
}

$v = array_map('htmlspecialchars', $values);

$pageTitle = 'Contribution Form — Plant Story';
$pageDescription = 'Plant contribution form for Plant Story';
$pageAuthor = 'Nicholas Sia';
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
$bodyClass = 'community-page contribution-page contribution-form-page';
$activePage = 'contribute';
$heroTitle = 'Your Contribution';
$heroLede = 'View plant contributions and the contribution form.';
<<<<<<< HEAD
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');
=======
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
?>

<main class="contribution-stage">
  <div class="contribution-form-layout">
    <header class="contribution-intro">

    </header>
    <section class="contribution-form-card" aria-labelledby="contribution-form-title">
      <div class="form-card-heading">
        <h2 id="contribution-form-title">Contribution Form</h2>
      </div>
<<<<<<< HEAD
<form action="contribute_process.php" method="post" enctype="multipart/form-data">

          <p><label for="contributor">Name of the Contributor:</label> <input type="text" id="contributor" name="contributor" placeholder="Enter your name" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="plantname">Plant's Name:</label> <input type="text" id="plantname" name="plantname" placeholder="Enter the plant name" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="photo">Photo(s):</label> <input type="file" id="photo" name="photos[]" accept="image/jpeg,image/png" multiple required></p>

          <p><label for="comments">Comments:</label>
          <textarea id="comments" name="comments" rows="5" cols="30" placeholder="Type your comments here..." required></textarea></p>
=======
      <?php if ($errors): ?>
      <div class="form-alert form-alert--error" role="alert">
        <p class="mt-0">Please fix the following and submit again:</p>
        <ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul>
      </div>
      <?php endif; ?>
<form method="post" action="contribute.php" enctype="multipart/form-data">

          <p><label for="contributor">Name of the Contributor:</label> <input type="text" id="contributor" name="contributor" value="<?= $v['contributor'] ?>" placeholder="Enter your name" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="plantname">Plant's Name:</label> <input type="text" id="plantname" name="plantname" value="<?= $v['plantname'] ?>" placeholder="Enter the plant name" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="photo">Photo(s):</label> <input type="file" id="photo" name="photo[]" accept="image/jpeg,image/png,image/gif,image/webp" multiple required>
          <small class="form-hint">Up to 5 images (JPG, PNG, GIF or WebP), 5 MB each.</small></p>

          <p><label for="comments">Comments:</label>
          <textarea id="comments" name="comments" rows="5" cols="30" maxlength="1000" placeholder="Type your comments here..." required><?= $v['comments'] ?></textarea></p>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521

          <p class="form-actions"><input type="submit" id="contribution-submit" value="Submit"> <input type="reset" id="contribution-reset" value="Reset"></p>

      </form>
    </section>
<<<<<<< HEAD
    <div class="contribution-back-wrap"><a class="form-back-link" href="contribute.php" id="back-to-contributors">&larr; Back to Contributors</a></div>
  </div>
</main>

<?php include('includes/footer.inc.php'); ?>
=======
    <div class="contribution-back-wrap"><a class="form-back-link" href="contributor.php" id="back-to-contributors">&larr; Back to Contributors</a></div>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
