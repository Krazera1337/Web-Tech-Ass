<?php
$base = '../';
$pageTitle = 'Login — Plant Story';
$bodyClass = 'auth-page login-page';
$activePage = 'login';
$heroTitle = 'Login';
$heroLede = 'Account sign-in form for Plant Story.';
$heroTag = 'header';
$heroVariant = 'form';
include __DIR__ . '/../includes/header.inc.php';
include __DIR__ . '/../includes/nav.inc.php';
include __DIR__ . '/../includes/page-hero.inc.php';
?>

<main class="auth-main">
    <div class="login-box">
        <h1>Login</h1>
        <p class="subtitle">Welcome back! Please enter your details.</p>

        <form>
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Enter your username" maxlength="10" required>

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter your password" maxlength="25" required>

            <div class="options">
                <label class="remember">
                <input type="checkbox">Remember me
                </label>
                <a href="forpass.php" class="forgot">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn" id="login-submit">Login</button>
        </form>

        <p class="signup-text">Don't have an account?
        <a href="register.php">Sign up</a>
        </p>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.inc.php'; ?>
