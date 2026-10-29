<?php
$bodyClass = 'enquiry-page';
$activePage = 'enquiry';
$heroTitle = 'Enquiry';
$heroLede = 'Use this form to send an enquiry about Plant Story.';
$heroTag = 'header';
$heroVariant = 'form';
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');
?>

  <div class="enquiry-card">
    <h2 class="enquiry-card__title">Ask Something Here</h2>
    
    <form class="enquiry-form" action="enquiry_process.php" method="post">
      
      <!-- First Name -->
      <div class="enquiry-form__group">
        <label for="fname" class="enquiry-form__label">First Name</label>
        <input 
          type="text" 
          id="fname" 
          name="firstname" placeholder="Enter your first name" 
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
          class="enquiry-form__input"
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
          <option value="" disabled selected>Select an option...</option>
          <option value="families">Families</option>
          <option value="genera">Genera</option>
          <option value="species">Species</option>
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
          placeholder="Write your message here..." 
          required
        ></textarea>
      </div>

      <!-- Submit Button -->
      <div class="enquiry-form__actions"><button type="submit" class="enquiry-form__submit-btn" id="enquiry-submit">Submit Enquiry</button><button type="reset" class="enquiry-form__reset-btn" id="enquiry-reset">Reset</button></div>

    </form>
  </div>

<?php include('includes/footer.inc.php'); ?>
