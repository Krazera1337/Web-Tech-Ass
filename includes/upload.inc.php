<?php
/*
 * Image upload helpers shared by contribute.php and plant_form.php.
 * Files are checked by their actual content (not the name the browser
 * sent), given a random name and stored under uploads/.
 */

const IMAGE_TYPES = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
const IMAGE_MAX_BYTES = 5 * 1024 * 1024;

// Returns $_FILES[$field] as a list of single files, skipping empty slots.
function uploaded_files($field)
{
    $f = $_FILES[$field] ?? null;
    if (!$f) {
        return [];
    }
    if (!is_array($f['name'])) {
        $f = array_map(fn($v) => [$v], $f);
    }
    $files = [];
    foreach ($f['name'] as $i => $name) {
        if ($f['error'][$i] === UPLOAD_ERR_NO_FILE) {
            continue;
        }
        $files[] = ['name' => $name, 'tmp_name' => $f['tmp_name'][$i], 'error' => $f['error'][$i], 'size' => $f['size'][$i]];
    }
    return $files;
}

// Error message for one uploaded file, or '' when it is an acceptable image.
function image_upload_error($file)
{
    $name = '“' . $file['name'] . '”';
    if (in_array($file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true) || $file['size'] > IMAGE_MAX_BYTES) {
        return "$name is larger than 5 MB.";
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "$name could not be uploaded. Please try again.";
    }
    if (!isset(IMAGE_TYPES[mime_content_type($file['tmp_name'])])) {
        return "$name is not a JPG, PNG, GIF or WebP image.";
    }
    return '';
}

// Moves a checked upload into uploads/$folder and returns its site-relative path.
function store_image($file, $folder)
{
    $dir = __DIR__ . '/../uploads/' . $folder;
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $name = bin2hex(random_bytes(12)) . '.' . IMAGE_TYPES[mime_content_type($file['tmp_name'])];
    move_uploaded_file($file['tmp_name'], "$dir/$name");
    return "uploads/$folder/$name";
}

// Deletes a stored upload. Only paths inside uploads/ are touched.
function delete_image($path)
{
    if (str_starts_with($path, 'uploads/') && !str_contains($path, '..')) {
        @unlink(__DIR__ . '/../' . $path);
    }
}
