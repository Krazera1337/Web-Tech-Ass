<?php
$bodyClass = 'auth-page login-page';
$activePage = 'login';
$heroTitle = 'Login';
$heroLede = 'Account sign-in form for Plant Story.';
$heroTag = 'header';
$heroVariant = 'form';
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');
?>

<main class="auth-main">
    <div class="login-box">
        <h1>Sign in</h1>
        <p class="subtitle">Sign in to your account</p>

        <form>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" maxlength="10" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" maxlength="25" required>

            <div class="options">
                <label class="remember">
                <input type="checkbox">Remember me
                </label>
                <a href="forpass.php" class="forgot">Forgot Password?</a>
            </div>

            <div class="auth-form-actions"><button type="submit" class="login-btn" id="login-submit">Sign in</button><button type="reset" class="auth-reset-btn" id="login-reset">Reset</button></div>
        </form>

        <p class="signup-text">Don't have an account?
        <a href="register.php">Sign up</a>
        </p>
    </div>
</main>

<?php include('includes/footer.inc.php'); ?>
