<?php
$activePage = $activePage ?? '';

function current_attr($key)
{
    global $activePage;
    return $activePage === $key ? ' aria-current="page"' : '';
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
';
echo '<link rel="icon" type="image/jpeg" href="images/leaf-icon.jpg">
<link rel="stylesheet" href="styles/style.css">
';
echo $extraHead ?? '';
echo '</head>
<body';
echo !empty($bodyClass) ? ' class="' . htmlspecialchars($bodyClass) . '"' : '';
echo '>
';
