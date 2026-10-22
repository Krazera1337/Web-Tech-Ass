<?php
$pageTitle = 'Plant Story — Discover the World of Rainforest Plants';
$activePage = 'home';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
?>
<section class="hero">
  <div class="container">
    <div class="hero-copy">
      <h1>A living catalogue of rainforest plant families</h1>
      <p>Explore four rainforest plant families, their genera and species.</p>
      <p class="hero-actions">
        <a class="btn" href="explore.php" id="home-explore">Start Exploring</a>
        <a class="btn btn-outline" href="explore3.php#aglaia-elliptica" id="random-plant-link">Explore a Featured Plant</a>
        <a class="btn btn-outline" href="identify.php" id="home-identify">Identify a Plant</a>
        <a class="btn btn-outline" href="contributor.php" id="home-contribute">Contribute Your Findings</a>
      </p>
    </div>
    <div class="hero-slideshow" role="img" aria-label="Slideshow of featured plants from the four families on this site">
      <img src="images/family-myristicaceae.jpg" alt="A tree of the nutmeg family, Myristicaceae">
      <img src="images/horsfieldia-kingii.jpg" alt="Horsfieldia kingii, Pakke Tiger Reserve">
      <img src="images/family-chrysobalanaceae.jpg" alt="A flowering tree of the cocoplum family, Chrysobalanaceae">
      <img src="images/parastemon-urophyllus.jpg" alt="Parastemon urophyllus, Bako National Park, Sarawak">
      <img src="images/family-meliaceae.jpg" alt="Flowers of a mahogany family tree, Meliaceae">
      <img src="images/aglaia-elliptica.jpg" alt="Aglaia elliptica, Kebun Raya Bogor">
      <img src="images/family-ebenaceae.jpg" alt="Foliage of an ebony family tree, Ebenaceae">
      <img src="images/diospyros-ebenum.jpg" alt="Diospyros ebenum, the source of true ebony, Kerala">
    </div>
  </div>
</section>

<main>
  <div class="container">
    <section aria-labelledby="about-heading" style="margin-top:2.5rem;">
      <h2 id="about-heading" class="mt-0">About this project</h2>
      <p>This website was created as a university web technology assignment. It
      catalogues four flowering plant families found predominantly across
      tropical Asia and Africa: <em>Myristicaceae</em>, <em>Chrysobalanaceae</em>,
      <em>Meliaceae</em>, and <em>Ebenaceae</em>. For each family we describe two
      representative genera, and for each genus we profile two species in
      detail — covering their appearance, habitat, distribution, and human
      uses. All botanical information has been cross-checked against
      recognised references such as Kew's Plants of the World Online and the
      IUCN Red List.</p>
    </section>

    <section aria-labelledby="quicklinks-heading">
      <h2 id="quicklinks-heading">Where to start</h2>
      <div class="card-grid">
        <div class="card">
          <h3>Families</h3>
          <p>Start with the broadest grouping — four plant families and what sets each one apart.</p>
          <a href="explore1.php">Go to Families &rarr;</a>
        </div>
        <div class="card">
          <h3>Genera</h3>
          <p>Eight genera, two nested inside each family, with the traits that distinguish them.</p>
          <a href="explore2.php">Go to Genera &rarr;</a>
        </div>
        <div class="card">
          <h3>Species</h3>
          <p>Sixteen species profiles with photographs, descriptions, distribution and uses.</p>
          <a href="explore3.php">Go to Species &rarr;</a>
        </div>
      </div>
    </section>

    <section aria-labelledby="contributors-heading">
      <h2 id="contributors-heading">Meet our contributors</h2>
      <p>Community members who've shared their own plant sightings with the
      collection. Hover or tap a card to see what they contributed.</p>
      <div class="flip-card-grid">
        <div class="flip-card" tabindex="0">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img src="images/man-1.jpg" alt="Portrait of Daniel James">
              <h3>Daniel James</h3>
            </div>
            <div class="flip-card-back">
              <img src="images/horsfieldia-kingii.jpg" alt="Horsfieldia kingii">
              <h3><em>Horsfieldia kingii</em></h3>
            </div>
          </div>
        </div>
        <div class="flip-card" tabindex="0">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img src="images/man-2.jpg" alt="Portrait of Ryan Tan">
              <h3>Ryan Tan</h3>
            </div>
            <div class="flip-card-back">
              <img src="images/parastemon-urophyllus.jpg" alt="Parastemon urophyllus">
              <h3><em>Parastemon urophyllus</em></h3>
            </div>
          </div>
        </div>
        <div class="flip-card" tabindex="0">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img src="images/woman-2.jpg" alt="Portrait of Aisha Rahman">
              <h3>Aisha Rahman</h3>
            </div>
            <div class="flip-card-back">
              <img src="images/aglaia-elliptica.jpg" alt="Aglaia elliptica">
              <h3><em>Aglaia elliptica</em></h3>
            </div>
          </div>
        </div>
        <div class="flip-card" tabindex="0">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img src="images/woman-1.jpg" alt="Portrait of Alex Lim">
              <h3>Alex Lim</h3>
            </div>
            <div class="flip-card-back">
              <img src="images/diospyros-ebenum.jpg" alt="Diospyros ebenum">
              <h3><em>Diospyros ebenum</em></h3>
            </div>
          </div>
        </div>
      </div>
      <p class="contributors-cta"><a href="contributor.php">See all contributions &rarr;</a></p>
    </section>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
