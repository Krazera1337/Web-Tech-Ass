<?php
/*
 * Site footer and closing tags. Relies on current_attr() from
 * header.inc.php, so include that first.
 */
?>
<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <p class="footer-logo">Plant Story</p>
      <p>A student project documenting rainforest plant families, genera and species for COS10026 Web Technology.</p>
    </div>
    <nav class="footer-links" aria-label="Footer">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="explore.php">Explore</a></li>
        <li><a href="contributor.php">Contribution</a></li>
        <li><a href="identify.php">Identification</a></li>
        <li><a href="profile.php">Profile</a></li>
      </ul>
    </nav>
    <div class="footer-credits">
      <h4>Data &amp; Credits</h4>
      <ul>
        <li><a href="https://plantnet.org/" target="_blank" rel="noopener">Pl@ntNet</a></li>
        <li><a href="https://powo.science.kew.org/" target="_blank" rel="noopener">Kew POWO</a></li>
        <li><a href="https://www.gbif.org/" target="_blank" rel="noopener">GBIF</a></li>
        <li><a href="https://www.iucnredlist.org/" target="_blank" rel="noopener">IUCN Red List</a></li>
      </ul>
    </div>
  </div>
  <p class="footer-bottom">&copy; <?= date('Y') ?> Plant Story. A student project for COS10026 Web Technology.</p>
<nav class="footer-page-links" aria-label="Project information"><a href="acknowledgement.php"<?= current_attr('acknowledgement') ?>>Acknowledgement</a><a href="enhancement.php"<?= current_attr('enhancement') ?>>Enhancements</a><a href="https://youtu.be/Hr3BoP4BBVc" target="_blank" rel="noopener">YouTube video</a></nav>
</footer>

</body>
</html>
