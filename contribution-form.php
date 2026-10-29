<?php
$base = '';
$pageTitle = 'Contribution Form — Plant Story';
$pageDescription = 'Plant contribution form for Plant Story';
$pageAuthor = 'Nicholas Sia';
$bodyClass = 'community-page contribution-form-page';
$activePage = 'contribute';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
?>
<main class="contribution-stage">
  <div class="contribution-form-layout">
    <header class="contribution-intro">
      <h1>Your observations.<br><span>Our growing story.</span></h1>
      <p>Share a plant, a photo, and what you noticed.</p>
      <a class="form-back-link" href="contribute.php" id="back-to-contributors">&larr; Back to Contributors</a>
    </header>
    <section class="contribution-form-card" aria-labelledby="contribution-form-title">
      <div class="form-card-heading">
        <h2 id="contribution-form-title">Contribution Form</h2>
      </div>
<form method="post" enctype="multipart/form-data">

          <p><label for="contributor">Name of the Contributor:</label> <input type="text" id="contributor" name="contributor" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="plantname">Plant's Name:</label> <input type="text" id="plantname" name="plantname" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="photo">Photo(s):</label> <input type="file" id="photo" name="photo" accept="image/*" multiple required></p>

          <p><label for="comments">Comments:</label>
          <textarea id="comments" name="comments" rows="5" cols="30" placeholder="Type your comments here..." required></textarea></p>

          <p class="form-actions"><input type="submit" id="contribution-submit" value="Submit"> <input type="reset" id="contribution-reset" value="Reset"></p>

      </form>
    </section>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
