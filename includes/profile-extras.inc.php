<?php
echo '<div class="email-section profile-contact" id="profile-email">
  <a href="mailto:';
echo $profileEmail;
echo '" class="email-btn">
    <span class="email-icon">✉️</span> Email Me
  </a>
</div>

<audio id="bgm-toggle" class="bgm-player" controls loop preload="none" title="Background music">
  <source src="';
echo $profileSong;
echo '" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
';
