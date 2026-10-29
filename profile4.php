<?php
<<<<<<< HEAD
$bodyClass = 'profile-page right-flip-profile pokemon-themed theme-water';
$activePage = 'profile';
$profileEmail = '106765460@students.swinburne.edu.my';
$profileSong = 'music/jaydenmusic.mpeg';
include('includes/header.inc.php');
include('includes/nav.inc.php');
=======
$pageTitle = 'Jayden — Plant Story';
$pageDescription = 'Jayden, a Plant Story team member.';
$pageAuthor = 'Jayden';
$bodyClass = 'profile-page right-flip-profile pokemon-themed theme-water';
$activePage = 'profile';
$profileEmail = '106765460@students.swinburne.edu.my';
$profileSong = 'jaydenmusic.mpeg';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
?>
<!-- Main profile area -->
<main class="profile-container">

  <!-- Left: profile card -->
  <div class="profile-static-wrapper">
    <div class="profile-static-card pokemon-trio">
        <img src="images/squirtle.png" alt="Squirtle" class="pokemon-corner pokemon-corner-tl trio-first">
        <img src="images/jayden-profile-picture.png" alt="Jayden Wong Wen Jie" class="profile-avatar-large">
        <h1 class="profile-name">Jayden Wong Wen Jie</h1>
        <div class="profile-student-id">Student ID: 106765460</div>
<<<<<<< HEAD
        <div class="profile-course">Bachelor of Computer Science ï¼ˆData Scienceï¼‰</div>
=======
        <div class="profile-course">Bachelor of Computer Science （Data Science）</div>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
      </div>
    </div>

  <!-- Right: details flip to the introduction -->
  <div class="details-flip-wrapper pokemon-decorated">
        <img src="images/squirtle meme.png" alt="Squirtle wearing sunglasses" class="pokemon-corner trio-third">
    <div class="details-flip" role="group" tabindex="0" aria-label="Focus to read About Me">
      <div class="info-table-card details-face details-front">
    <h3><span></span> Personal Details</h3>
    <table class="info-table">
      <tbody>
        <tr>
<<<<<<< HEAD
          <th>ðŸ¡ Hometown</th>
          <td>Miri, Sarawak</td>
        </tr>
        <tr>
          <th>ðŸŽ¨ Hobbies</th>
          <td>Badminton, Gaming</td>
        </tr>
        <tr>
          <th>ðŸ”¬ Interests</th>
=======
          <th>🏡 Hometown</th>
          <td>Miri, Sarawak</td>
        </tr>
        <tr>
          <th>🎨 Hobbies</th>
          <td>Badminton, Gaming</td>
        </tr>
        <tr>
          <th>🔬 Interests</th>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
          <td>Reading reviews on new smartphone and gadgets</td>
        </tr>
      </tbody>
    </table>

        <p class="flip-hint">flip &amp; read intro</p>
      </div>
      <div class="details-face details-back">
<<<<<<< HEAD
        <h2 class="back-title">ðŸŒ± About Me</h2>
        <div class="back-intro-text">
          <p>Hello! I'm Jayden, a Plant Story team member, also first year student in Swinburne. This was my first assignment, and I was worried about whether I was doing it correctly. However, I felt good about the assignment because I am genuinely interested in the course. </p>
          <p class="profile-motto">"The forest is not just trees â€” it's a story waiting to be told."</p>
=======
        <h2 class="back-title">🌱 About Me</h2>
        <div class="back-intro-text">
          <p>Hello! I'm Jayden, a Plant Story team member, also first year student in Swinburne. This was my first assignment, and I was worried about whether I was doing it correctly. However, I felt good about the assignment because I am genuinely interested in the course. </p>
          <p class="profile-motto">"The forest is not just trees — it's a story waiting to be told."</p>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
        </div>
      </div>
    </div>
  </div>

</main>
<div class="extra-row">

  <div class="map-card pokemon-decorated">
        <div class="bush-split trio-bush" tabindex="0" aria-label="Hover or focus to part the grass around Wartortle">
          <img src="images/wartortle.png" alt="Wartortle" class="venusaur-peek trio-second">
          <img src="images/bush.png" alt="" class="bush-half bush-half-left" aria-hidden="true">
          <img src="images/bush.png" alt="" class="bush-half bush-half-right" aria-hidden="true">
        </div>
<<<<<<< HEAD
    <h2 class="map-title"><span>ðŸ—ºï¸</span> Hometown â€” Miri, Sarawak</h2>
=======
    <h2 class="map-title"><span>🗺️</span> Hometown — Miri, Sarawak</h2>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
    <div class="map-frame">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1018487.5909093255!2d112.76793407812498!3d4.322991399999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x321f48317b6f7f9d%3A0x40453cc01243976!2sMiri%20District%20Office!5e0!3m2!1sen!2smy!4v1790771405459!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"> title="Map of Miri, Sarawak
      </iframe>
    </div>
    <div class="map-caption">
<<<<<<< HEAD
      <span>ðŸ“</span> The seahorse was chosen as Miri's official city mascot, because it represents grace, friendliness, and the city's vibrant marine life.
=======
      <span>📍</span> The seahorse was chosen as Miri's official city mascot, because it represents grace, friendliness, and the city's vibrant marine life.
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
