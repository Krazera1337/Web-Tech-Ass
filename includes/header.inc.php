<?php
/*
 * Shared document head and opening <body> tag.
 *
 * Set before including:
 *   $pageTitle       text for the <title> element
 *   $activePage      key of the nav item to mark with aria-current
 * Optional:
 *   $pageDescription, $pageAuthor, $bodyClass, $extraHead (raw HTML for <head>)
 */
$activePage = $activePage ?? '';

// Returns the aria-current attribute when $key is the page being viewed.
function current_attr($key)
{
    global $activePage;
    return $activePage === $key ? ' aria-current="page"' : '';
}

// Cache-busts the stylesheet whenever it changes on disk.
$cssVersion = filemtime(__DIR__ . '/../styles/style.css');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if (!empty($pageAuthor)): ?>
<meta name="author" content="<?= htmlspecialchars($pageAuthor) ?>">
<?php endif; ?>
<?php if (!empty($pageDescription)): ?>
<meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
<?php endif; ?>
<title><?= htmlspecialchars($pageTitle) ?></title>
<link rel="icon" type="image/jpeg" href="images/leaf-icon.jpg">
<link rel="stylesheet" href="styles/style.css?v=<?= $cssVersion ?>">
<?= $extraHead ?? '' ?>
</head>
<body<?= !empty($bodyClass) ? ' class="' . htmlspecialchars($bodyClass) . '"' : '' ?>>
