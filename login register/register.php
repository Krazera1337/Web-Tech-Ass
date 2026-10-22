<?php
$base = '../';
$pageTitle = 'Register — Plant Story';
$bodyClass = 'auth-page register-page';
$activePage = 'register';
$heroTitle = 'Registration';
$heroLede = 'Account registration form for Plant Story.';
$heroTag = 'header';
$heroVariant = 'form';
include __DIR__ . '/../includes/header.inc.php';
include __DIR__ . '/../includes/nav.inc.php';
include __DIR__ . '/../includes/page-hero.inc.php';
?>

<main class="auth-main">
    <div class="register-box">
        <h1>Sign up</h1>
        <p class="subtitle">Create your account</p>

        <form>
        <label for="name">Username</label>
        <input type="text" id="name" placeholder="Username" maxlength="10" required>

        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Create a password" maxlength="25" required>

        <label for="confirm">Confirm password</label>
        <input type="password" id="confirm" placeholder="Confirm your password" maxlength="25" required>

        <button type="submit" class="register-btn" id="register-submit">Sign up</button>
        </form>

        <p class="signup-text">Already have an account?
        <a href="login.php">Login</a>
        </p>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.inc.php'; ?>
