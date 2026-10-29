<?php
$activePage = 'login';
include('includes/header.inc.php');
include('includes/nav.inc.php');
?>
<main class="auth-main">
    <div class="forgot-box">
        <div class="icon-circle">Ã°Å¸â€Â</div>
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

<?php include('includes/footer.inc.php'); ?>
