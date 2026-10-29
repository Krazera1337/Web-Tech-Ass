<?php
$bodyClass = 'community-page identification-page';
$activePage = 'identify';
$heroTitle = 'Plant Identification';
$heroLede = 'Select a plant photo and view a sample identification result.';
$heroTag = 'header';
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');
?>
<main>
  <div class="page-wrap identification-layout">

    <section class="identify-panel" aria-labelledby="upload-title">
      <h2 id="upload-title">Upload Your Plant</h2>

      <form>

        <fieldset>
          <legend>Plant Identification</legend>

          <div class="plant-upload" id="plant-upload"><span class="upload-symbol" aria-hidden="true"><img src="images/upload-icon.png" alt=""></span><label for="plantphoto">Choose a plant photo</label><p id="photo-hint">JPG or PNG - a clear image works best.</p><input type="file" id="plantphoto" name="plantphoto" accept="image/jpeg,image/png" aria-describedby="photo-hint"></div>
          <p class="form-actions"><a class="identify-example-link" href="#example-results" id="view-example-button">View example result</a> <input type="reset" id="identify-reset" value="Reset"></p>

        </fieldset>

      </form>
    </section>


    <section class="identify-panel identify-steps" aria-labelledby="steps-title">
      <h2 id="steps-title">How It Works</h2>
      <aside class="photo-tip-flip" aria-labelledby="photo-tips-title" tabindex="0">
        <div class="photo-tip-card">
          <div class="photo-tip-face photo-tip-front">
            <h3 id="photo-tips-title">Photo Tips</h3>
            <p>Flip for a few easy photo tips.</p>
          </div>
          <div class="photo-tip-face photo-tip-back">
            <p>For a clearer photo, try to:</p>
            <ul class="photo-tip-list">
              <li>Take the photo in good natural light.</li>
              <li>Keep the leaves or flowers in focus.</li>
              <li>Get close enough to show the details.</li>
              <li>Keep other plants out of the way.</li>
            </ul>
            <figure class="leaf-guide">
              <img src="images/leaf-venation-guide.svg" alt="Diagram comparing three leaf vein patterns">
              <figcaption>Leaf veins can be useful to look at.</figcaption>
            </figure>
          </div>
        </div>
      </aside>
      <ol>
        <li><strong>Choose a photo</strong><span>Show one plant, including its leaves or flowers.</span></li>
        <li><strong>View an example</strong><span>See how a plant result could appear below.</span></li>
        <li><strong>Explore plants</strong><span>Browse the <a href="explore3.php">plant catalogue</a>.</span></li>
      </ol>
    </section>
    <section class="identify-panel" id="example-results" aria-labelledby="example-results-title">
      <h2 id="example-results-title">Example Results</h2>
      <div class="identify-info-grid">
        <div>
          <dl class="identify-glossary">
            <div><dt>Scientific name</dt><dd>The botanical name of a species.</dd></div>
            <div><dt>Common name</dt><dd>A familiar or local plant name.</dd></div>
            <div><dt>Care tips</dt><dd>Suitable light, water and growing conditions.</dd></div>
            <div><dt>Location</dt><dd>Where the plant grows.</dd></div>
          </dl>
          <a class="identify-catalogue-link" href="explore3.php" id="identify-catalogue-button">Explore the plant catalogue <span aria-hidden="true">&rarr;</span></a>
        </div>
        <div class="identify-sample-flip" tabindex="0" role="group" aria-label="Focus or hover to see habitat and care notes">
          <div class="identify-sample-card">
            <div class="identify-sample identify-sample-face identify-sample-front">
              <p class="identify-sample-label">Sample identification</p>
              <img src="images/horsfieldia-kingii.jpg" alt="Horsfieldia kingii fruit and leaves">
              <h3><i>Horsfieldia kingii</i></h3>
              <p>Example confidence: <strong>92.4%</strong></p>
              <p class="identify-sample-note">Illustrative result only; it is not based on the photo you choose.</p>
              <p class="identify-sample-hint">Hover or focus to see habitat &amp; care</p>
            </div>
            <div class="identify-sample-face identify-sample-back">
              <p class="identify-sample-label">Care tips</p>
              <p>Grow in warm, humid conditions with partial shade. Keep the soil moist but well-drained, and avoid letting it dry out completely.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>

<?php include('includes/footer.inc.php'); ?>
