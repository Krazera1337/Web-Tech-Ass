<?php
$pageTitle = 'Register — Plant Story';
$bodyClass = 'auth-page register-page';
$activePage = 'register';
$heroTitle = 'Registration';
$heroLede = 'Create a Plant Story account.';
$heroTag = 'header';
$heroVariant = 'form';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

<main class="auth-main">
  <div class="register-box">
    <h1>Sign up</h1>
    <p class="subtitle">Create your account</p>
    <form>
      <div class="register-grid">
        <div class="register-field"><label for="first-name">First name</label><input type="text" id="first-name" name="first_name" placeholder="First name" maxlength="25" pattern="[A-Za-z]+" title="Use letters only, up to 25 characters" required></div>
        <div class="register-field"><label for="last-name">Last name</label><input type="text" id="last-name" name="last_name" placeholder="Last name" maxlength="25" pattern="[A-Za-z]+" title="Use letters only, up to 25 characters" required></div>
        <div class="register-field register-field-wide"><label for="username">Username</label><input type="text" id="username" name="username" placeholder="Choose a username" maxlength="10" pattern="[A-Za-z0-9_]+" title="Use letters, numbers or underscores, up to 10 characters" required></div>
        <div class="register-field register-field-wide"><label for="email">Email address</label><input type="email" id="email" name="email" placeholder="Your email" required></div>
        <fieldset class="register-address register-field-wide"><legend>Address</legend>
          <div class="register-grid">
            <div class="register-field register-field-wide"><label for="street">Street address</label><input type="text" id="street" name="street" placeholder="Street address" maxlength="40" required></div>
            <div class="register-field"><label for="city">City / town</label><input type="text" id="city" name="city" placeholder="City or town" maxlength="20" required></div>
            <div class="register-field"><label for="state">State / federal territory</label><select id="state" name="state" required><option value="" disabled selected>Select a state or territory</option><option>Johor</option><option>Kedah</option><option>Kelantan</option><option>Melaka</option><option>Negeri Sembilan</option><option>Pahang</option><option>Penang</option><option>Perak</option><option>Perlis</option><option>Sabah</option><option>Sarawak</option><option>Selangor</option><option>Terengganu</option><option>Kuala Lumpur</option><option>Labuan</option><option>Putrajaya</option></select></div>
            <div class="register-field"><label for="postcode">Postcode</label><input type="text" id="postcode" name="postcode" placeholder="Enter your postcode" inputmode="numeric" maxlength="5" pattern="[0-9]{5}" title="Enter exactly 5 digits" required></div>
          </div>
        </fieldset>
        <div class="register-field register-field-wide"><label for="phone">Phone number</label><input type="tel" id="phone" name="phone" placeholder="0123456789" inputmode="numeric" maxlength="10" pattern="[0-9]{1,10}" title="Enter up to 10 digits" required></div>
        <div class="register-field"><label for="password">Password</label><input type="password" id="password" name="password" placeholder="Create a password" maxlength="25" required></div>
        <div class="register-field"><label for="confirm">Confirm password</label><input type="password" id="confirm" name="confirm_password" placeholder="Confirm your password" maxlength="25" required></div>
      </div>
      <div class="auth-form-actions"><button type="submit" class="register-btn" id="register-submit">Sign up</button><button type="reset" class="auth-reset-btn" id="register-reset">Reset</button></div>
    </form>
    <p class="signup-text">Already have an account? <a href="login.php">Login</a></p>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
