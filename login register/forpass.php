<?php
$base = '../';
$pageTitle = 'Forgot Password — Plant Story';
$activePage = 'login';
include __DIR__ . '/../includes/header.inc.php';
include __DIR__ . '/../includes/nav.inc.php';
?>
<main class="auth-main">
    <div class="forgot-box">
        <div class="icon-circle">🔐</div>
        <h1>Forgot password</h1>
        <p class="description">Enter your email to receive a link to reset your password.</p>
            <form>
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter your email" required>
                <button type="submit" class="submit-btn" id="reset-link-submit">Send reset link</button>
            </form>
            <p class="back-text">Remember your password?
            <a href="login.php">Back to login</a>
            </p>
        </div>
</main>

<?php include __DIR__ . '/../includes/footer.inc.php'; ?>
