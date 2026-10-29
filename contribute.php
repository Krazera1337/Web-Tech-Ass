<?php
$bodyClass = 'community-page contribution-page contribution-form-page';
$activePage = 'contribute';
$heroTitle = 'Your Contribution';
$heroLede = 'View plant contributions and the contribution form.';
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');
?>

<main class="contribution-stage">
  <div class="contribution-form-layout">
    <header class="contribution-intro">

    </header>
    <section class="contribution-form-card" aria-labelledby="contribution-form-title">
      <div class="form-card-heading">
        <h2 id="contribution-form-title">Contribution Form</h2>
      </div>
<form action="contribute_process.php" method="post" enctype="multipart/form-data">

          <p><label for="contributor">Name of the Contributor:</label> <input type="text" id="contributor" name="contributor" placeholder="Enter your name" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="plantname">Plant's Name:</label> <input type="text" id="plantname" name="plantname" placeholder="Enter the plant name" maxlength="25" pattern="[A-Za-z ]+" required></p>

          <p><label for="photo">Photo(s):</label> <input type="file" id="photo" name="photos[]" accept="image/jpeg,image/png" multiple required></p>

          <p><label for="comments">Comments:</label>
          <textarea id="comments" name="comments" rows="5" cols="30" placeholder="Type your comments here..." required></textarea></p>

          <p class="form-actions"><input type="submit" id="contribution-submit" value="Submit"> <input type="reset" id="contribution-reset" value="Reset"></p>

      </form>
    </section>
    <div class="contribution-back-wrap"><a class="form-back-link" href="contribute.php" id="back-to-contributors">&larr; Back to Contributors</a></div>
  </div>
</main>

<?php include('includes/footer.inc.php'); ?>
