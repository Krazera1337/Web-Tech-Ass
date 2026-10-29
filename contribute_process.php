<?php
function contribution_field($name)
{
    if (isset($_POST[$name]) && is_string($_POST[$name])) {
        return trim($_POST[$name]);
    }
    return '';
}

$errors = [];
$resultRows = [];
$backHref = 'contribute.php';
$resultHeading = 'Contribution Confirmation';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    $errors[] = 'Open the contribution form, enter a plant observation, and select Submit.';
} else {
    $contributor = contribution_field('contributor');
    $plantName = contribution_field('plantname');
    $comments = contribution_field('comments');
    $photoNames = [];

    if (!preg_match('/^[A-Za-z ]{1,25}$/D', $contributor)) {
        $errors[] = 'Contributor name must contain letters only, up to 25 characters.';
    }
    if (!preg_match('/^[A-Za-z ]{1,25}$/D', $plantName)) {
        $errors[] = 'Plant name must contain letters only, up to 25 characters.';
    }
    if ($comments === '' || strlen($comments) > 2000) {
        $errors[] = 'Enter comments of no more than 2000 characters.';
    }

    $photos = $_FILES['photos'] ?? null;
    if (!is_array($photos) || !isset($photos['name']) || !is_array($photos['name'])) {
        $errors[] = 'Choose at least one JPG or PNG plant photo.';
    } else {
        $mimeChecker = new finfo(FILEINFO_MIME_TYPE);
        foreach ($photos['name'] as $index => $originalName) {
            $status = $photos['error'][$index] ?? UPLOAD_ERR_NO_FILE;
            if ($status === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            if ($status !== UPLOAD_ERR_OK) {
                $errors[] = 'A photo could not be uploaded. Please choose it again.';
                continue;
            }
            $temporaryFile = $photos['tmp_name'][$index] ?? '';
            $size = $photos['size'][$index] ?? 0;
            if (!is_string($temporaryFile) || !is_uploaded_file($temporaryFile)) {
                $errors[] = 'An uploaded photo could not be checked.';
                continue;
            }
            if (!is_numeric($size) || $size <= 0 || $size > 5 * 1024 * 1024) {
                $errors[] = 'Each photo must be no larger than 5 MB.';
                continue;
            }
            $mime = $mimeChecker->file($temporaryFile);
            if (!in_array($mime, ['image/jpeg', 'image/png'], true)) {
                $errors[] = 'Photos must be JPG or PNG images.';
                continue;
            }
            $photoNames[] = basename(str_replace('\\', '/', (string) $originalName));
        }
        if (!$photoNames && !$errors) {
            $errors[] = 'Choose at least one JPG or PNG plant photo.';
        }
    }

    if (!$errors) {
        include('includes/db.inc.php');
        include('includes/upload.inc.php');

        $saveContribution = mysqli_prepare($conn, 'INSERT INTO `contribution` (contributor_name, plant_name, comments) VALUES (?, ?, ?)');
        mysqli_stmt_bind_param($saveContribution, 'sss', $contributor, $plantName, $comments);
        mysqli_stmt_execute($saveContribution);
        $contributionId = mysqli_insert_id($conn);
        mysqli_stmt_close($saveContribution);

        $photoFiles = uploaded_files('photos');
        $savePhoto = mysqli_prepare($conn, 'INSERT INTO `contribution_photo` (contribution_id, file_path) VALUES (?, ?)');
        foreach ($photoFiles as $photo) {
            $photoPath = store_image($photo, 'contributions');
            mysqli_stmt_bind_param($savePhoto, 'is', $contributionId, $photoPath);
            mysqli_stmt_execute($savePhoto);
        }
        mysqli_stmt_close($savePhoto);

        $resultRows = [
            ['label' => 'Contributor', 'value' => $contributor],
            ['label' => 'Plant name', 'value' => $plantName],
            ['label' => 'Photo file(s)', 'value' => implode(', ', $photoNames)],
            ['label' => 'Comments', 'value' => $comments, 'multiline' => true]
        ];
    }
}

$bodyClass = 'community-page contribution-page contribution-form-page form-result-page';
$activePage = 'contribute';
$heroTitle = 'Your Contribution';
$heroLede = 'Form submission confirmation.';
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');
include('includes/form-result.inc.php');
include('includes/footer.inc.php');
