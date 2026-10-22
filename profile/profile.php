<?php
$base = '../';
$pageTitle = 'Meet the Team — Plant Story';
$pageDescription = 'Pick a Plant Story team member to view their profile.';
$bodyClass = 'profile-picker-page';
$activePage = 'profile';
$heroTitle = 'Meet the Team';
$heroLede = 'View the profiles of Plant Story team members.';
include __DIR__ . '/../includes/header.inc.php';
include __DIR__ . '/../includes/nav.inc.php';
include __DIR__ . '/../includes/page-hero.inc.php';
?>

<main>
  <div class="team-grid">

    <a class="team-card" href="nicholas_profile.php" id="nicholas-card" aria-label="View Nicholas Sia Siang Wei's profile">
      <img src="../images/nicholas-profile-picture.jpg" alt="Nicholas Sia Siang Wei" class="team-avatar">
      <h2 class="team-name">Nicholas Sia Siang Wei</h2>
      <p class="team-course">Bachelor of Computer Science (Software Development)</p>
      <span class="team-cta">View Profile &rarr;</span>
    </a>

    <a class="team-card" href="profile1.php" id="teo-card" aria-label="View Hui Ching Teo's profile">
      <img src="../images/teo-profile-picture.jpeg" alt="Hui Ching Teo" class="team-avatar">
      <h2 class="team-name">Hui Ching Teo</h2>
      <p class="team-course">Bachelor of Engineering (Honours)(Software)</p>
      <span class="team-cta">View Profile &rarr;</span>
    </a>

    <a class="team-card" href="profile3.php" id="hishamuddin-card" aria-label="View Muhammad Hishamuddin Ngu's profile">
      <img src="../images/muhammad-profile-picture.jpg" alt="Muhammad Hishamuddin Ngu" class="team-avatar">
      <h2 class="team-name">Muhammad Hishamuddin Ngu</h2>
      <p class="team-course">Bachelor of Computer Science (Data Science)</p>
      <span class="team-cta">View Profile &rarr;</span>
    </a>

    <a class="team-card" href="profile2.php" id="jayden-card" aria-label="View Jayden Wong Wen Jie's profile">
      <img src="../images/jayden-profile-picture.png" alt="Jayden Wong Wen Jie" class="team-avatar">
      <h2 class="team-name">Jayden Wong Wen Jie</h2>
      <p class="team-course">Bachelor of Computer Science （Data Science）</p>
      <span class="team-cta">View Profile &rarr;</span>
    </a>

  </div>
</main>

<?php include __DIR__ . '/../includes/footer.inc.php'; ?>
