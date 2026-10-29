<?php
/*
 * Guards the user management pages. Include this before any output: it
 * starts the session, sends visitors who have not signed in as admin to
 * admin_login.php, and stops the browser caching these pages so the Back
 * button cannot show them again after logging out.
 *
 * Also provides the CSRF helpers used by the module's forms.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

if (empty($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Hidden form field carrying the session's CSRF token.
function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token']) . '">';
}

// True when a POSTed form carries this session's CSRF token.
function csrf_valid()
{
    return isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string) $_POST['csrf_token']);
}

// One-off message shown on the next page load, e.g. after a redirect.
function flash($message = null)
{
    if ($message !== null) {
        $_SESSION['flash'] = $message;
        return null;
    }
    $message = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $message;
}
