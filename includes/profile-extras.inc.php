<?php
<<<<<<< HEAD
echo '<div class="email-section profile-contact" id="profile-email">
  <a href="mailto:';
echo $profileEmail;
echo '" class="email-btn">
=======
/*
 * Email button and background music player at the foot of each team
 * member's profile.
 *
 * Set before including:
 *   $profileEmail    address for the mailto link
 *   $profileSong     audio file name inside music/
 */
?>
<div class="email-section profile-contact" id="profile-email">
  <a href="mailto:<?= $profileEmail ?>" class="email-btn">
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
    <span class="email-icon">✉️</span> Email Me
  </a>
</div>

<<<<<<< HEAD
<audio id="bgm-toggle" class="bgm-player" controls loop preload="none" title="Background music">
  <source src="';
echo $profileSong;
echo '" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
';
=======
<!-- Background music: native HTML5 audio player, no scripting required -->
<audio id="bgm-toggle" class="bgm-player" controls loop preload="none" title="Background music">
  <source src="music/<?= $profileSong ?>" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
>>>>>>> c640d7d065b241793ef5ad0a2fa864cf43fa6521
