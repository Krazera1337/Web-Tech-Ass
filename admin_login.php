<?php
/*
 * Admin sign-in for the user management module. Credentials are checked
 * against the `admin` table; the default account is Admin / Admin and both
 * fields ignore case.
 */
session_start();
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

if (!empty($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/includes/db.inc.php';

    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Enter both your username and password.';
    } else {
        $stmt = mysqli_prepare($conn, 'SELECT admin_id, username, password_hash FROM `admin` WHERE username = ?');
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);

        if ($admin && password_verify(strtolower($password), $admin['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = (int) $admin['admin_id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: dashboard.php');
            exit;
        }
        $error = 'Incorrect username or password.';
    }
}

$pageTitle = 'Admin Login — Plant Story';
$bodyClass = 'auth-page login-page admin-page';
$heroTitle = 'Admin Login';
$heroLede = 'Sign in to manage Plant Story user accounts.';
$heroTag = 'header';
$heroVariant = 'form';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

<main class="auth-main">
    <div class="login-box">
        <h1>Administrator sign in</h1>
        <p class="subtitle">For site administrators only</p>

        <?php if ($error !== ''): ?>
        <p class="form-alert form-alert--error" role="alert"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['logged_out'])): ?>
        <p class="form-alert form-alert--success" role="status">You have been logged out. Sign in again to continue.</p>
        <?php endif; ?>

        <form method="post" action="admin_login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" placeholder="Enter your username" maxlength="20" autocomplete="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" maxlength="25" autocomplete="current-password" required>

            <div class="auth-form-actions"><button type="submit" class="login-btn">Sign in</button><button type="reset" class="auth-reset-btn">Reset</button></div>
        </form>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
