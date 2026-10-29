<?php
$errors = array();

// Read the submitted values from the registration form.
$firstName = '';
$lastName = '';
$username = '';
$email = '';
$street = '';
$city = '';
$state = '';
$postcode = '';
$phone = '';
$password = '';
$confirm = '';

if (isset($_POST['first_name']) && is_string($_POST['first_name'])) {
    $firstName = trim($_POST['first_name']);
}
if (isset($_POST['last_name']) && is_string($_POST['last_name'])) {
    $lastName = trim($_POST['last_name']);
}
if (isset($_POST['username']) && is_string($_POST['username'])) {
    $username = trim($_POST['username']);
}
if (isset($_POST['email']) && is_string($_POST['email'])) {
    $email = trim($_POST['email']);
}
if (isset($_POST['street']) && is_string($_POST['street'])) {
    $street = trim($_POST['street']);
}
if (isset($_POST['city']) && is_string($_POST['city'])) {
    $city = trim($_POST['city']);
}
if (isset($_POST['state']) && is_string($_POST['state'])) {
    $state = trim($_POST['state']);
}
if (isset($_POST['postcode']) && is_string($_POST['postcode'])) {
    $postcode = trim($_POST['postcode']);
}
if (isset($_POST['phone']) && is_string($_POST['phone'])) {
    $phone = trim($_POST['phone']);
}
if (isset($_POST['password']) && is_string($_POST['password'])) {
    $password = trim($_POST['password']);
}
if (isset($_POST['confirm_password']) && is_string($_POST['confirm_password'])) {
    $confirm = trim($_POST['confirm_password']);
}

// Check that the form was submitted.
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $errors[] = 'Open the registration form, enter your details, and select Sign up.';
} else {
    // Check each field.
    if ($firstName == '' || strlen($firstName) > 25 || !ctype_alpha($firstName)) {
        $errors[] = 'First name must contain letters only, up to 25 characters.';
    }
    if ($lastName == '' || strlen($lastName) > 25 || !ctype_alpha($lastName)) {
        $errors[] = 'Last name must contain letters only, up to 25 characters.';
    }
    if ($username == '' || strlen($username) > 10 || !preg_match('/^[A-Za-z0-9_]+$/', $username)) {
        $errors[] = 'Username must use letters, numbers or underscores, up to 10 characters.';
    }
    if (strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if ($street == '' || strlen($street) > 40) {
        $errors[] = 'Street address is required and must be at most 40 characters.';
    }
    if ($city == '' || strlen($city) > 20) {
        $errors[] = 'City or town is required and must be at most 20 characters.';
    }

    $states = array(
        'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
        'Pahang', 'Penang', 'Perak', 'Perlis', 'Sabah', 'Sarawak',
        'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya'
    );
    if (!in_array($state, $states)) {
        $errors[] = 'Select a Malaysian state or federal territory.';
    }
    if (strlen($postcode) != 5 || !ctype_digit($postcode)) {
        $errors[] = 'Postcode must contain exactly 5 digits.';
    }
    if ($phone == '' || strlen($phone) > 10 || !ctype_digit($phone)) {
        $errors[] = 'Phone number must contain up to 10 digits.';
    }
    if ($password == '' || strlen($password) > 25) {
        $errors[] = 'Enter a password of no more than 25 characters.';
    } else if ($password != $confirm) {
        $errors[] = 'Password and confirmation do not match.';
    }
}

// Save the registration details in the database.
if (count($errors) == 0) {
    include('includes/db.inc.php');

    $checkUser = mysqli_prepare($conn, 'SELECT user_id FROM `user` WHERE username = ?');
    mysqli_stmt_bind_param($checkUser, 's', $username);
    mysqli_stmt_execute($checkUser);
    mysqli_stmt_store_result($checkUser);

    if (mysqli_stmt_num_rows($checkUser) > 0) {
        $errors[] = 'That username is already in use. Please choose another one.';
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $saveUser = mysqli_prepare($conn, 'INSERT INTO `user` (first_name, last_name, username, email, street, city, state, postcode, phone, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($saveUser, 'ssssssssss', $firstName, $lastName, $username, $email, $street, $city, $state, $postcode, $phone, $passwordHash);
        mysqli_stmt_execute($saveUser);
        mysqli_stmt_close($saveUser);
    }

    mysqli_stmt_close($checkUser);
}
// Set the shared page information.
$bodyClass = 'auth-page register-page form-result-page';
$activePage = 'register';
$heroTitle = 'Registration';
$heroLede = 'Form submission confirmation.';
$heroTag = 'header';
$heroVariant = 'form';
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');

// Show the result of the form submission.
echo '<main class="form-result-main">
  <section class="form-result-card" aria-labelledby="form-result-heading">
    <h2 id="form-result-heading">Registration Confirmation</h2>';

if (count($errors) > 0) {
    echo '<div class="form-result-status form-result-status--error" role="alert">
      <strong>Please check your submission</strong>
      <ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ul></div>';
} else {
    echo '<div class="form-result-status form-result-status--success" role="status">
      <strong>Details received</strong>
    </div>
    <dl class="form-result-details">
      <div class="form-result-field"><dt>First name</dt><dd>' . htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>Last name</dt><dd>' . htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>Username</dt><dd>' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>Email address</dt><dd>' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>Street address</dt><dd>' . htmlspecialchars($street, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>City or town</dt><dd>' . htmlspecialchars($city, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>State / territory</dt><dd>' . htmlspecialchars($state, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>Postcode</dt><dd>' . htmlspecialchars($postcode, ENT_QUOTES, 'UTF-8') . '</dd></div>
      <div class="form-result-field"><dt>Phone number</dt><dd>' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</dd></div>
    </dl>';
}

echo '<div class="form-result-actions">
  <a class="form-result-primary" href="register.php">Back to form</a>
</div>
  </section>
</main>';

include('includes/footer.inc.php');
?>
