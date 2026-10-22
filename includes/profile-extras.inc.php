<?php
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
    <span class="email-icon">✉️</span> Email Me
  </a>
</div>

<!-- Background music: native HTML5 audio player, no scripting required -->
<audio id="bgm-toggle" class="bgm-player" controls loop preload="none" title="Background music">
  <source src="music/<?= $profileSong ?>" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
