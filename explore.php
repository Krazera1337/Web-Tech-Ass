<?php
$pageTitle = 'Explore the Collection — Forest Story';
$bodyClass = 'explore-page';
$activePage = 'explore';
$heroTitle = 'Explore the Collection';
$heroLede = 'Browse the plant collection by family, genus and species.';
$heroTag = 'header';
$heroCopyClass = true;
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

<div class="page-wrap">
  <main>
    <p>Forest Story documents four flowering plant families in a simple
    three-level hierarchy: each <strong>family</strong> contains two
    <strong>genera</strong>, and each genus contains two <strong>species</strong>.
    Browse the families below, use the search to jump straight to any genus
    or species, or scan the full hierarchy in the overview table.</p>

    <?php include __DIR__ . '/includes/catalogue-jump.inc.php'; ?>

    <section aria-labelledby="gallery-heading">
      <h2 id="gallery-heading" class="mt-0">Meet the families</h2>
      <p>Each family below is a doorway into its two genera and four
      species. Click a photo to see the full family profile.</p>
      <div class="family-gallery">
        <a class="family-photo-card" href="explore1.php#myristicaceae">
          <img src="images/family-myristicaceae.jpg" alt="A tree of the nutmeg family, Myristicaceae">
          <span class="family-photo-label">Myristicaceae<small>The Nutmeg Family</small><small class="family-photo-origin">Native to tropical Asia — Himalaya to Malesia</small></span>
        </a>
        <a class="family-photo-card" href="explore1.php#chrysobalanaceae">
          <img src="images/family-chrysobalanaceae.jpg" alt="A flowering tree of the cocoplum family, Chrysobalanaceae">
          <span class="family-photo-label">Chrysobalanaceae<small>The Cocoplum Family</small><small class="family-photo-origin">Native to Southeast Asia &amp; tropical Americas</small></span>
        </a>
        <a class="family-photo-card" href="explore1.php#meliaceae">
          <img src="images/family-meliaceae.jpg" alt="Flowers of a mahogany family tree, Meliaceae">
          <span class="family-photo-label">Meliaceae<small>The Mahogany Family</small><small class="family-photo-origin">Native to Asia-Pacific — South Asia to N. Australia</small></span>
        </a>
        <a class="family-photo-card" href="explore1.php#ebenaceae">
          <img src="images/family-ebenaceae.jpg" alt="Foliage of an ebony family tree, Ebenaceae">
          <span class="family-photo-label">Ebenaceae<small>The Ebony Family</small><small class="family-photo-origin">Native to Asia-Pacific &amp; Africa</small></span>
        </a>
      </div>
    </section>

    <section aria-labelledby="levels-heading">
      <h2 id="levels-heading">More ways to help</h2>
      <div class="card-grid">
        <div class="card">
          <h3>Identification</h3>
          <p>Not sure what you're looking at? Upload a photo and get help
          identifying it.</p>
          <a href="identify.php">Identify a Plant &rarr;</a>
        </div>
        <div class="card">
          <h3>Contribution</h3>
          <p>Seen a plant we haven't documented yet? Share your own
          observations with the collection.</p>
          <a href="contributor.php">Contribute Your Findings &rarr;</a>
        </div>
        <div class="card">
          <h3>New Additions</h3>
          <p>See the species added to the collection since the core
          catalogue was published.</p>
          <a href="plants.php">See What's New &rarr;</a>
        </div>
      </div>
    </section>

    <section aria-labelledby="overview-heading">
      <h2 id="overview-heading">Collection overview</h2>
      <table>
        <caption>Families, genera and species documented on this site</caption>
        <thead>
          <tr><th>Family</th><th>Genus</th><th>Species</th></tr>
        </thead>
        <tbody>
          <tr><td rowspan="2"><a href="explore1.php#myristicaceae">Myristicaceae</a></td><td><a href="explore2.php#horsfieldia">Horsfieldia</a></td><td><em><a href="explore3.php#horsfieldia-flocculosa">Horsfieldia flocculosa</a></em>, <em><a href="explore3.php#horsfieldia-kingii">H. kingii</a></em></td></tr>
          <tr><td><a href="explore2.php#knema">Knema</a></td><td><em><a href="explore3.php#knema-cinerea">Knema cinerea</a></em>, <em><a href="explore3.php#knema-sumatrana">K. sumatrana</a></em></td></tr>
          <tr><td rowspan="2"><a href="explore1.php#chrysobalanaceae">Chrysobalanaceae</a></td><td><a href="explore2.php#parastemon">Parastemon</a></td><td><em><a href="explore3.php#parastemon-urophyllus">Parastemon urophyllus</a></em>, <em><a href="explore3.php#parastemon-grandifructus">P. grandifructus</a></em></td></tr>
          <tr><td><a href="explore2.php#hirtella">Hirtella</a></td><td><em><a href="explore3.php#hirtella-triandra">Hirtella triandra</a></em>, <em><a href="explore3.php#hirtella-racemosa">H. racemosa</a></em></td></tr>
          <tr><td rowspan="2"><a href="explore1.php#meliaceae">Meliaceae</a></td><td><a href="explore2.php#aglaia">Aglaia</a></td><td><em><a href="explore3.php#aglaia-elliptica">Aglaia elliptica</a></em>, <em><a href="explore3.php#aglaia-korthalsii">A. korthalsii</a></em></td></tr>
          <tr><td><a href="explore2.php#dysoxylum">Dysoxylum</a></td><td><em><a href="explore3.php#dysoxylum-acutangulum">Dysoxylum acutangulum</a></em>, <em><a href="explore3.php#dysoxylum-grande">D. grande</a></em></td></tr>
          <tr><td rowspan="2"><a href="explore1.php#ebenaceae">Ebenaceae</a></td><td><a href="explore2.php#diospyros">Diospyros</a></td><td><em><a href="explore3.php#diospyros-ferrea">Diospyros ferrea</a></em>, <em><a href="explore3.php#diospyros-ebenum">D. ebenum</a></em></td></tr>
          <tr><td><a href="explore2.php#euclea">Euclea</a></td><td><em><a href="explore3.php#euclea-natalensis">Euclea natalensis</a></em>, <em><a href="explore3.php#euclea-racemosa">E. racemosa</a></em></td></tr>
        </tbody>
      </table>
    </section>
  </main>
</div>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
