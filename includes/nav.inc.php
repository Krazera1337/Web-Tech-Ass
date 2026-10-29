<?php
echo '<nav class="main-nav" id="top-navigation" aria-label="Primary">
  <div class="container">
    <a href="index.php" class="brand"';
echo current_attr('home');
echo '>
      <img src="images/LogoPlantStory.png" alt="Plant Story — Rainforest Plant Explorer" class="logo-mark">
    </a>
    <div class="nav-right">
    <ul>
      <li class="has-dropdown">
        <a href="explore.php"';
echo current_attr('explore');
echo '>Explore</a>
        <ul class="dropdown-menu" aria-label="Explore the plant catalogue">
          <li><a href="explore1.php">Families</a></li>
          <li><a href="explore2.php">Genera</a></li>
          <li><a href="explore3.php">Species</a></li>
        </ul>
      </li>
      <li><a href="contributor.php"';
echo current_attr('contribute');
echo '>Contribution</a></li>
      <li><a href="identify.php"';
echo current_attr('identify');
echo '>Identification</a></li>
      <li><a href="profile.php"';
echo current_attr('profile');
echo '>Profile</a></li>
      <li><a href="enquiry.php"';
echo current_attr('enquiry');
echo '>Enquiry</a></li>
    </ul>
      <div class="nav-auth">
        <a href="register.php" class="btn-navstyle" id="site-register"';
echo current_attr('register');
echo '>Registration</a>
        <a href="login.php" class="btn-navstyle" id="site-login"';
echo current_attr('login');
echo '>Login</a>
      </div>
    </div>
  </div>
</nav>
';
