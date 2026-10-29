<?php
<<<<<<< HEAD
$bodyClass = 'profile-page right-flip-profile pokemon-themed theme-electric';
$activePage = 'profile';
$profileEmail = 'alex.chen@foreststory.example';
$profileSong = 'music/teomusic.mp3';
include('includes/header.inc.php');
include('includes/nav.inc.php');
=======
$pageTitle = 'Hui Ching Teo — Plant Story';
$pageDescription = 'Hui Ching Teo, a Plant Story team member.';
$pageAuthor = 'Hui Ching Teo';
$bodyClass = 'profile-page right-flip-profile pokemon-themed theme-electric';
$activePage = 'profile';
$profileEmail = 'alex.chen@foreststory.example';
$profileSong = 'teomusic.mp3';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
?>
<!-- Main profile area -->
<main class="profile-container">

  <!-- Left: profile card -->
  <div class="profile-static-wrapper">
    <div class="profile-static-card pokemon-trio">
        <img src="images/pikachu.png" alt="Pikachu" class="pokemon-corner pokemon-corner-tl trio-first">
        <img src="images/teo-profile-picture.jpeg" alt="Hui Ching Teo" class="profile-avatar-large">
        <h1 class="profile-name">Hui Ching TEO</h1>
        <div class="profile-student-id">Student ID: 104391847</div>
        <div class="profile-course">Bachelor of Engineering (Honours)(Software)</div>
    </div>
  </div>

  <!-- Right: details flip to the introduction -->
  <div class="details-flip-wrapper pokemon-decorated">
        <img src="images/pikachu meme.png" alt="Pikachu" class="pokemon-corner trio-third">
    <div class="details-flip" role="group" tabindex="0" aria-label="Focus to read About Me">
      <div class="info-table-card details-face details-front">
    <h3><span></span> Personal Details</h3>
    <table class="info-table">
      <tbody>
        <tr>
<<<<<<< HEAD
          <th>ðŸ¡ Hometown</th>
          <td>Kuching, Sarawak</td>
        </tr>
        <tr>
          <th>ðŸŽ¨ Hobbies</th>
          <td>Gaming, Take a walk, Crochet</td>
        </tr>
        <tr>
          <th>ðŸ”¬ Interests</th>
=======
          <th>🏡 Hometown</th>
          <td>Kuching, Sarawak</td>
        </tr>
        <tr>
          <th>🎨 Hobbies</th>
          <td>Gaming, Take a walk, Crochet</td>
        </tr>
        <tr>
          <th>🔬 Interests</th>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
          <td>Game Programming, Hiking</td>
        </tr>
      </tbody>
    </table>

        <p class="flip-hint">flip &amp; read intro</p>
      </div>
      <div class="details-face details-back">
<<<<<<< HEAD
        <h2 class="back-title">ðŸŒ± About Me</h2>
        <div class="back-intro-text">
          <p>Hello! I'm Hui Ching, a second-year student passionate about web development and rainforest ecology. I built this platform as part of my coursework, combining my love for coding with a desire to showcase the beauty of tropical plants.</p>
          <p>I believe technology can be a bridge between people and nature. In my free time, I like to take care of plants.</p>
          <p style="margin-top:0.8rem; font-style:italic; color: var(--forest);">"The forest is not just trees â€” it's a story waiting to be told."</p>
=======
        <h2 class="back-title">🌱 About Me</h2>
        <div class="back-intro-text">
          <p>Hello! I'm Hui Ching, a second-year student passionate about web development and rainforest ecology. I built this platform as part of my coursework, combining my love for coding with a desire to showcase the beauty of tropical plants.</p>
          <p>I believe technology can be a bridge between people and nature. In my free time, I like to take care of plants.</p>
          <p style="margin-top:0.8rem; font-style:italic; color: var(--forest);">"The forest is not just trees — it's a story waiting to be told."</p>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
        </div>
      </div>
    </div>
  </div>

</main>

<!-- ===== EXTRA ROW: Map ===== -->
<div class="extra-row">

  <div class="map-card pokemon-decorated">
        <div class="bush-split trio-bush" tabindex="0" aria-label="Hover or focus to part the grass around Raichu">
          <img src="images/raichu.png" alt="Raichu" class="venusaur-peek trio-second">
          <img src="images/bush.png" alt="" class="bush-half bush-half-left" aria-hidden="true">
          <img src="images/bush.png" alt="" class="bush-half bush-half-right" aria-hidden="true">
        </div>
<<<<<<< HEAD
    <h2 class="map-title"><span>ðŸ—ºï¸</span> Hometown â€” Kuching, Sarawak</h2>
=======
    <h2 class="map-title"><span>🗺️</span> Hometown — Kuching, Sarawak</h2>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
    <div class="map-frame">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127903.00109054318!2d110.2696573486328!3d1.5603873999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fde2e6e8e4b3f7%3A0x6b8b5e6b6e6b6e6b!2sKuching%2C%20Sarawak!5e0!3m2!1sen!2smy!4v1700000000000!5m2!1sen!2smy"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Map of Kuching, Sarawak">
      </iframe>
    </div>
    <div class="map-caption">
<<<<<<< HEAD
      <span>ðŸ“</span> Kuching, the cat city â€” capital of Sarawak, Borneo.
=======
      <span>📍</span> Kuching, the cat city — capital of Sarawak, Borneo.
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
    </div>
  </div>

</div>

<<<<<<< HEAD
<?php include('includes/profile-extras.inc.php'); ?>

<?php include('includes/footer.inc.php'); ?>
=======
<?php include __DIR__ . '/includes/profile-extras.inc.php'; ?>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
