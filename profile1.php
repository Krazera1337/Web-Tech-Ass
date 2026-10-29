<?php
$bodyClass = 'profile-page right-flip-profile pokemon-themed theme-fire';
$activePage = 'profile';
$profileEmail = '106758936@students.swinburne.edu.my';
$profileSong = 'music/nickmusic.mp3';
include('includes/header.inc.php');
include('includes/nav.inc.php');
?>
<!-- Main profile area -->
<main class="profile-container">
  
  <!-- Left: profile card -->
  <div class="profile-static-wrapper">
    <div class="profile-static-card pokemon-trio">
      <img src="images/charmander.png" alt="Charmander" class="pokemon-corner pokemon-corner-tl trio-first">
      <img src="images/nicholas-profile-picture.jpg" alt="Nicholas Sia Siang Wei" class="profile-avatar-large">
      <h1 class="profile-name">Nicholas Sia Siang Wei</h1>
      <div class="profile-student-id">Student ID: 106758936</div>
      <div class="profile-course">Bachelor of Computer Science (Software Development)</div>
    </div>
  </div>

  <!-- Right: details flip to the introduction -->
  <div class="details-flip-wrapper pokemon-decorated">
      <img src="images/charizard meme.gif" alt="Animated Charizard" class="pokemon-corner trio-third">
    <div class="details-flip" role="group" tabindex="0" aria-label="Focus to read About Me">
      <div class="info-table-card details-face details-front">
        <h3><span></span> Personal Details</h3>
        <table class="info-table">
          <tbody>
            <tr>
              <th>ðŸ¡ Hometown</th>
              <td>Sibu, Sarawak</td>
            </tr>
            <tr>
              <th>ðŸŽ¨ Hobbies</th>
              <td>Gaming, Drawing, Jogging</td>
            </tr>
            <tr>
              <th>ðŸ”¬ Interests</th>
              <td>Game Development, Drawing, Listen to songs</td>
            </tr>
          </tbody>
        </table>
        <p class="flip-hint">flip &amp; read intro</p>
      </div>
      <div class="details-face details-back">
        <h2 class="back-title">ðŸŒ± About Me</h2>
        <div class="back-intro-text">
          <p>Hello! I'm Nicholas, a first-year Computer Science student at Swinburne University of Technology Sarawak. I am just an ordinary person.</p>
          <p>In my free time, I enjoy gaming, drawing and exploring different kinds of technology. I hope to improve my programming skills and possibly work in the game industry in the future.</p>
          <p class="profile-motto">"Keep learning, keep creating."</p>
        </div>
      </div>
    </div>
  </div>



</main>
<!-- ===== EXTRA ROW: Map ===== -->
<div class="extra-row">

  <div class="map-card pokemon-decorated" id="hometown-map">
        <div class="bush-split trio-bush" tabindex="0" aria-label="Hover or focus to part the grass around Charizard">
        <img src="images/charizard.png" alt="Charizard" class="venusaur-peek trio-second">
        <img src="images/bush.png" alt="" class="bush-half bush-half-left" aria-hidden="true">
        <img src="images/bush.png" alt="" class="bush-half bush-half-right" aria-hidden="true">
      </div>
    <h2 class="map-title"><span>ðŸ—ºï¸</span> Hometown â€” Sibu, Sarawak</h2>
    <div class="map-frame">
      <iframe src="https://www.google.com/maps?q=Sibu%2C%20Sarawak&amp;output=embed"
        loading="lazy" referrerpolicy="no-referrer-when-downgrade"
        title="Map of Sibu, Sarawak" allowfullscreen></iframe>
    </div>
    <div class="map-caption">
      <span>ðŸ“</span> Sibu, my hometown in central Sarawak.
    </div>
  </div>

</div>

<?php include('includes/profile-extras.inc.php'); ?>

<?php include('includes/footer.inc.php'); ?>
