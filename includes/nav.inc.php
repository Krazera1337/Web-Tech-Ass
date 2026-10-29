<?php
<<<<<<< HEAD
echo '<nav class="main-nav" id="top-navigation" aria-label="Primary">
  <div class="container">
    <a href="index.php" class="brand"';
echo current_attr('home');
echo '>
=======
/*
 * Primary site navigation. Relies on current_attr() from header.inc.php,
 * so include that first.
 */
?>
<nav class="main-nav" id="top-navigation" aria-label="Primary">
  <div class="container">
    <a href="index.php" class="brand"<?= current_attr('home') ?>>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
      <img src="images/LogoPlantStory.png" alt="Plant Story — Rainforest Plant Explorer" class="logo-mark">
    </a>
    <div class="nav-right">
    <ul>
      <li class="has-dropdown">
<<<<<<< HEAD
        <a href="explore.php"';
echo current_attr('explore');
echo '>Explore</a>
=======
        <a href="explore.php"<?= current_attr('explore') ?>>Explore</a>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
        <ul class="dropdown-menu" aria-label="Explore the plant catalogue">
          <li><a href="explore1.php">Families</a></li>
          <li><a href="explore2.php">Genera</a></li>
          <li><a href="explore3.php">Species</a></li>
<<<<<<< HEAD
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
=======
          <li><a href="plants.php">New Additions</a></li>
        </ul>
      </li>
      <li><a href="contributor.php"<?= current_attr('contribute') ?>>Contribution</a></li>
      <li><a href="identify.php"<?= current_attr('identify') ?>>Identification</a></li>
      <li><a href="profile.php"<?= current_attr('profile') ?>>Profile</a></li>
      <li><a href="enquiry.php"<?= current_attr('enquiry') ?>>Enquiry</a></li>
    </ul>
      <div class="nav-auth">
        <a href="register.php" class="btn-navstyle" id="site-register"<?= current_attr('register') ?>>Registration</a>
        <a href="login.php" class="btn-navstyle" id="site-login"<?= current_attr('login') ?>>Login</a>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
      </div>
    </div>
  </div>
</nav>
<<<<<<< HEAD
';
=======
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
