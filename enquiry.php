<?php
/*
 * Enquiry form. Valid enquiries are saved to the `enquiry` table and the
 * visitor is sent to enquiry_confirmation.php. Admins read and answer them
 * from manage_enquiries.php.
 */
session_start();

const ENQUIRY_TYPES = ['families' => 'Families', 'genera' => 'Genera', 'species' => 'Species'];

$values = ['firstname' => '', 'lastname' => '', 'email' => '', 'phone' => '', 'enquiry_type' => '', 'comments' => ''];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $field => $_) {
        $values[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    if (!preg_match('/^[A-Za-z ]{1,25}$/', $values['firstname'])) {
        $errors[] = 'First name must be letters only, up to 25 characters.';
    }
    if (!preg_match('/^[A-Za-z ]{1,25}$/', $values['lastname'])) {
        $errors[] = 'Last name must be letters only, up to 25 characters.';
    }
    if (strlen($values['email']) > 100 || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (!preg_match('/^[0-9]{1,10}$/', $values['phone'])) {
        $errors[] = 'Phone number must be digits only, up to 10 digits.';
    }
    if (!isset(ENQUIRY_TYPES[$values['enquiry_type']])) {
        $errors[] = 'Select an enquiry type.';
    }
    if ($values['comments'] === '') {
        $errors[] = 'Please write your message.';
    } elseif (mb_strlen($values['comments']) > 2000) {
        $errors[] = 'Your message must be 2000 characters or fewer.';
    }

    if (!$errors) {
        require_once __DIR__ . '/includes/db.inc.php';

        $stmt = mysqli_prepare($conn, 'INSERT INTO `enquiry` (first_name, last_name, email, phone, enquiry_type, comments) VALUES (?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'ssssss', $values['firstname'], $values['lastname'], $values['email'],
            $values['phone'], $values['enquiry_type'], $values['comments']);
        mysqli_stmt_execute($stmt);
        $_SESSION['last_enquiry'] = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);

        header('Location: enquiry_confirmation.php');
        exit;
    }
}

$v = array_map('htmlspecialchars', $values);

$pageTitle = 'Enquiry — Plant Story';
$bodyClass = 'enquiry-page';
$activePage = 'enquiry';
$heroTitle = 'Enquiry';
$heroLede = 'Use this form to send an enquiry about Plant Story.';
$heroTag = 'header';
$heroVariant = 'form';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

  <div class="enquiry-card">
    <h2 class="enquiry-card__title">Ask Something Here</h2>

    <?php if ($errors): ?>
    <div class="form-alert form-alert--error" role="alert">
      <p class="mt-0">Please fix the following and submit again:</p>
      <ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul>
    </div>
    <?php endif; ?>

    <form class="enquiry-form" action="enquiry.php" method="post">

      <!-- First Name -->
      <div class="enquiry-form__group">
        <label for="fname" class="enquiry-form__label">First Name</label>
        <input
          type="text"
          id="fname"
          name="firstname" placeholder="Enter your first name"
          value="<?= $v['firstname'] ?>"
          class="enquiry-form__input"
          maxlength="25"
          pattern="[A-Za-z\s]+"
          title="Alphabetical characters only"
          required
        >
      </div>

      <!-- Last Name -->
      <div class="enquiry-form__group">
        <label for="lname" class="enquiry-form__label">Last Name</label>
        <input
          type="text"
          id="lname"
          name="lastname" placeholder="Enter your last name"
          value="<?= $v['lastname'] ?>"
          class="enquiry-form__input"
          maxlength="25"
          pattern="[A-Za-z\s]+"
          title="Alphabetical characters only"
          required
        >
      </div>

      <!-- Email Address -->
      <div class="enquiry-form__group">
        <label for="email" class="enquiry-form__label">Email Address</label>
        <input
          type="email"
          id="email"
          name="email" placeholder="name@example.com"
          value="<?= $v['email'] ?>"
          class="enquiry-form__input"
          maxlength="100"
          required
        >
      </div>

      <!-- Phone Number -->
      <div class="enquiry-form__group">
        <label for="phone" class="enquiry-form__label">Phone Number</label>
        <input
          type="tel"
          id="phone"
          name="phone"
          value="<?= $v['phone'] ?>"
          class="enquiry-form__input"
          maxlength="10"
          pattern="[0-9]{1,10}"
          placeholder="0123456789"
          required
        >
      </div>

      <!-- Enquiry Selection -->
      <div class="enquiry-form__group">
        <label for="enquiry-type" class="enquiry-form__label">Enquiry Type</label>
        <select id="enquiry-type" name="enquiry_type" class="enquiry-form__select" required>
          <option value="" disabled<?= $values['enquiry_type'] === '' ? ' selected' : '' ?>>Select an option...</option>
          <?php foreach (ENQUIRY_TYPES as $key => $label): ?>
          <option value="<?= $key ?>"<?= $values['enquiry_type'] === $key ? ' selected' : '' ?>><?= $label ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Comments Area -->
      <div class="enquiry-form__group">
        <label for="comments" class="enquiry-form__label">Comments</label>
        <textarea
          id="comments"
          name="comments"
          class="enquiry-form__textarea"
          rows="5"
          cols="40"
          maxlength="2000"
          placeholder="Write your message here..."
          required
        ><?= $v['comments'] ?></textarea>
      </div>

      <!-- Submit Button -->
      <div class="enquiry-form__actions"><button type="submit" class="enquiry-form__submit-btn" id="enquiry-submit">Submit Enquiry</button><button type="reset" class="enquiry-form__reset-btn" id="enquiry-reset">Reset</button></div>

    </form>
  </div>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
