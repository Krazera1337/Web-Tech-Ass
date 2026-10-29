<?php
<<<<<<< HEAD
$bodyClass = 'profile-page right-flip-profile pokemon-themed theme-grass';
$activePage = 'profile';
$profileEmail = 'hishamuddin@students.swinburne.edu.my';
$profileSong = 'music/hishamusic.mp3';
include('includes/header.inc.php');
include('includes/nav.inc.php');
=======
$pageTitle = 'Muhammad Hishamuddin Ngu — Plant Story';
$pageDescription = 'Muhammad Hishamuddin Ngu, a Plant Story team member.';
$pageAuthor = 'Muhammad Hishamuddin Ngu';
$bodyClass = 'profile-page right-flip-profile pokemon-themed theme-grass';
$activePage = 'profile';
$profileEmail = 'hishamuddin@students.swinburne.edu.my';
$profileSong = 'hishamusic.mp3';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
?>
<!-- Main profile area -->
<main class="profile-container">

  <!-- Left: profile card -->
  <div class="profile-static-wrapper">
    <div class="profile-static-card">
        <img src="images/bulbasaur.png" alt="Bulbasaur" class="pokemon-corner pokemon-corner-tl">
        <img src="images/ivysaur.png" alt="Ivysaur" class="pokemon-corner pokemon-corner-tr">
        <div class="bush-split" tabindex="0" aria-label="Hover to reveal a hidden Venusaur">
          <img src="images/venusaur.png" alt="Venusaur" class="venusaur-peek">
          <img src="images/bush.png" alt="" class="bush-half bush-half-left" aria-hidden="true">
          <img src="images/bush.png" alt="" class="bush-half bush-half-right" aria-hidden="true">
        </div>
        <img src="images/muhammad-profile-picture.jpg" alt="Muhammad Hishamuddin Ngu" class="profile-avatar-large">
        <h1 class="profile-name">Muhammad Hishamuddin Ngu</h1>
        <div class="profile-student-id">Student ID: 105825538 </div>
        <div class="profile-course">Bachelor of Computer Science (Data Science)</div>
      </div>
    </div>

  <!-- Right: details flip to the introduction -->
  <div class="details-flip-wrapper">
    <div class="details-flip" role="group" tabindex="0" aria-label="Focus to read About Me">
      <div class="info-table-card details-face details-front">
    <img src="images/rayquaza.png" alt="Rayquaza" class="pokemon-corner pokemon-corner-tr">
    <h3><span></span> Personal Details</h3>
    <table class="info-table">
      <tbody>
        <tr>
<<<<<<< HEAD
          <th>ðŸ¡ Hometown</th>
          <td>Sarikei, Sarawak &amp; Bukit Timah, Singapore</td>
        </tr>
        <tr>
          <th>ðŸŽ¨ Hobbies</th>
          <td>Gaming, Reading, Workout, Tinkering & Collecting TCG</td>
        </tr>
        <tr>
          <th>ðŸ”¬ Interests</th>
=======
          <th>🏡 Hometown</th>
          <td>Sarikei, Sarawak &amp; Bukit Timah, Singapore</td>
        </tr>
        <tr>
          <th>🎨 Hobbies</th>
          <td>Gaming, Reading, Workout, Tinkering & Collecting TCG</td>
        </tr>
        <tr>
          <th>🔬 Interests</th>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
          <td>TCG, Technology, Medicine & Gaming</td>
        </tr>
      </tbody>
    </table>

        <p class="flip-hint">flip &amp; read intro</p>
      </div>
      <div class="details-face details-back">
<<<<<<< HEAD
        <h2 class="back-title">ðŸŒ± About Me</h2>
=======
        <h2 class="back-title">🌱 About Me</h2>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
        <div class="back-intro-text">
          <p>Hello! I'm Muhammad Hishamuddin Ngu, a Swinburne University student. I am passionate about technology and its applications in solving real-world problems.</p>
          <p>I hit Radiant#499 in Valorant, Faceit Level 10 in CS:GO, and 4.0 in my foundation year.</p>
          <p>I love to ruin my mental health with excessive gaming and studies.</p>
          <p class="profile-motto">"He never sleeps, the judge.  He is dancing, dancing. He says that he will never die. -Holden"</p>
        </div>
      </div>
    </div>
  </div>

</main>

<!-- ===== EXTRA ROW: Skill Garden (grows with CSS animation only) ===== -->
<div class="extra-row">

  <section class="skill-garden" aria-labelledby="skill-garden-title">
<<<<<<< HEAD
    <h2 class="map-title" id="skill-garden-title"><span>ðŸŒ¿</span> Skill Garden</h2>
    <p class="map-select-label">Every stem grows to the level I have reached so far â€” hover or focus a plant to read more.</p>
=======
    <h2 class="map-title" id="skill-garden-title"><span>🌿</span> Skill Garden</h2>
    <p class="map-select-label">Every stem grows to the level I have reached so far — hover or focus a plant to read more.</p>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521

    <ul class="garden-bed">
      <li class="garden-plant plant-python" tabindex="0">
        <span class="plant-tip">My main language for data work, scripting and automation.</span>
        <span class="plant-stem"><span class="plant-level">90%</span></span>
        <span class="plant-name">Python</span>
      </li>
      <li class="garden-plant plant-js" tabindex="0">
<<<<<<< HEAD
        <span class="plant-tip">Logic, events and interactivity â€” used outside this unit.</span>
=======
        <span class="plant-tip">Logic, events and interactivity — used outside this unit.</span>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
        <span class="plant-stem"><span class="plant-level">85%</span></span>
        <span class="plant-name">Javascript</span>
      </li>
      <li class="garden-plant plant-cpp" tabindex="0">
        <span class="plant-tip">My beginner language for learning programming concepts.</span>
        <span class="plant-stem"><span class="plant-level">80%</span></span>
        <span class="plant-name">C++</span>
      </li>
      <li class="garden-plant plant-css" tabindex="0">
        <span class="plant-tip">Flexbox, grid, animation and responsive media queries.</span>
        <span class="plant-stem"><span class="plant-level">75%</span></span>
        <span class="plant-name">CSS</span>
      </li>
      <li class="garden-plant plant-data" tabindex="0">
<<<<<<< HEAD
        <span class="plant-tip">Cleaning, analysing and visualising data â€” my degree major.</span>
=======
        <span class="plant-tip">Cleaning, analysing and visualising data — my degree major.</span>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
        <span class="plant-stem"><span class="plant-level">70%</span></span>
        <span class="plant-name">Data Science</span>
      </li>
      <li class="garden-plant plant-html" tabindex="0">
        <span class="plant-tip">Semantic structure, tables, forms and accessible markup.</span>
        <span class="plant-stem"><span class="plant-level">60%</span></span>
        <span class="plant-name">HTML</span>
      </li>
    </ul>
  </section>

</div>

<!-- ===== EXTRA ROW: Map ===== -->
<div class="extra-row">

  <div class="map-card">
<<<<<<< HEAD
    <h2 class="map-title"><span>ðŸ—ºï¸</span> Hometown</h2>
=======
    <h2 class="map-title"><span>🗺️</span> Hometown</h2>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
    <p class="map-select-label">Choose a hometown to view:</p>

    <!-- CSS-only switcher: the checked radio reveals its matching map panel -->
    <input type="radio" id="hometown-select" name="hometown" class="map-radio" checked>
    <input type="radio" id="map-bukit-timah" name="hometown" class="map-radio">

    <div class="map-tabs">
      <label for="hometown-select" class="map-tab">Sarikei, Sarawak</label>
      <label for="map-bukit-timah" class="map-tab">Bukit Timah, Singapore</label>
    </div>

    <div class="map-panel map-panel-sarikei">
      <div class="map-frame">
        <iframe src="https://www.google.com/maps?q=Sarikei%2C%20Sarawak&amp;output=embed"
          loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          title="Map of Sarikei, Sarawak" allowfullscreen></iframe>
      </div>
      <div class="map-caption">
<<<<<<< HEAD
        <span>ðŸ“</span> <span>Sarikei, my hometown in Sarawak.</span>
=======
        <span>📍</span> <span>Sarikei, my hometown in Sarawak.</span>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
      </div>
    </div>

    <div class="map-panel map-panel-bukit-timah">
      <div class="map-frame">
        <iframe src="https://www.google.com/maps?q=Bukit%20Timah%2C%20Singapore&amp;output=embed"
          loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          title="Map of Bukit Timah, Singapore" allowfullscreen></iframe>
      </div>
      <div class="map-caption">
<<<<<<< HEAD
        <span>ðŸ“</span> <span>Bukit Timah, my second hometown in Singapore.</span>
=======
        <span>📍</span> <span>Bukit Timah, my second hometown in Singapore.</span>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
      </div>
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
