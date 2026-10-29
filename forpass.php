<?php
<<<<<<< HEAD
$activePage = 'login';
include('includes/header.inc.php');
include('includes/nav.inc.php');
?>
<main class="auth-main">
    <div class="forgot-box">
        <div class="icon-circle">Ã°Å¸â€Â</div>
=======
$pageTitle = 'Forgot Password — Plant Story';
$activePage = 'login';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
?>
<main class="auth-main">
    <div class="forgot-box">
        <div class="icon-circle">ðŸ”</div>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
        <h1>Forgot password</h1>
        <p class="description">Enter your email to receive a link to reset your password.</p>
            <form>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <div class="auth-form-actions"><button type="submit" class="submit-btn" id="reset-link-submit">Send reset link</button><button type="reset" class="auth-reset-btn" id="forgot-reset">Reset</button></div>
            </form>
            <p class="back-text">Remember your password?
            <a href="login.php">Back to login</a>
            </p>
        </div>
</main>

<<<<<<< HEAD
<?php include('includes/footer.inc.php'); ?>
=======
<?php include __DIR__ . '/includes/footer.inc.php'; ?>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
