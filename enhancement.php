<?php
$bodyClass = 'documentation-page';
$activePage = 'enhancement';
include('includes/header.inc.php');
include('includes/nav.inc.php');
?>
<main class="container credits-page">
  <h1 class="docs-page-title">Enhancements</h1>
  <p class="docs-lede">A quick guide to the site's interactive features.</p>

  <div class="enhancement-grid">
    <section id="layout">
      <div class="enhancement-copy">
        <h2>Responsive layout</h2>
        <p>The page rearranges its content to fit different screen sizes. Flexible grids and images keep text, cards and photos readable on phones and desktop screens.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Responsive layout demonstration">
          <source src="videos/responsive%20layout.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="index.php">Home</a>
            <a class="enhancement-button" href="explore.php">Explore</a>
            <a class="enhancement-button" href="explore1.php">Families</a>
            <a class="enhancement-button" href="explore2.php">Genera</a>
            <a class="enhancement-button" href="explore3.php">Species</a>
            <a class="enhancement-button" href="contributor.php">Contribution</a>
            <a class="enhancement-button" href="contributor.php">Contribution Form</a>
            <a class="enhancement-button" href="identify.php">Identification</a>
            <a class="enhancement-button" href="profile.php">Profile</a>
            <a class="enhancement-button" href="profile1.php">Nicholas Sia Siang Wei Profile</a>
            <a class="enhancement-button" href="profile2.php">Hui Ching Teo Profile</a>
            <a class="enhancement-button" href="profile4.php">Jayden Wong Wen Jie Profile</a>
            <a class="enhancement-button" href="profile3.php">Muhammad Hishamuddin Ngu Profile</a>
            <a class="enhancement-button" href="enquiry.php">Enquiry</a>
            <a class="enhancement-button" href="login.php">Login</a>
            <a class="enhancement-button" href="register.php">Registration</a>
            <a class="enhancement-button" href="forpass.php">Forgot Password</a>
            <a class="enhancement-button" href="acknowledgement.php">Acknowledgement</a>
            <a class="enhancement-button" href="enhancement.php">Enhancements</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/css/css_rwd_intro.asp">W3Schools: Responsive design</a>
          </div>
        </div>
      </aside>
    </section>
    <section id="navigation">
      <div class="enhancement-copy">
        <h2>Explore dropdown</h2>
        <p>The Explore navigation reveals a menu when visitors hover over it or move keyboard focus to it. The menu provides direct links to Families, Genera and Species while keeping the main navigation compact.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Explore dropdown demonstration">
          <source src="videos/dropdownmenu.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="#top-navigation">Navigation bar</a>
            <a class="enhancement-button" href="explore.php#catalogue-jump">Explore catalogue quick links</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/howto/howto_css_dropdown.asp">W3Schools: Dropdown menu</a>
          </div>
        </div>
      </aside>
    </section>

    <section id="nav-slider">
      <div class="enhancement-copy">
        <h2>Navigation sliding highlight</h2>
        <p>When a visitor selects a navigation link, the highlight glides to the active page. This motion makes the current location easier to recognise in the navigation bar.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Navigation sliding highlight demonstration">
          <source src="videos/navigation-slider.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="#top-navigation">Navigation bar</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://developer.mozilla.org/en-US/docs/Web/CSS/Reference/At-rules/@view-transition">MDN: Cross-document view transitions</a>
          </div>
        </div>
      </aside>
    </section>

    <section id="slideshow">
      <div class="enhancement-copy">
        <h2>Plant photo slideshow</h2>
        <p>The Home banner fades between a series of plant photographs. The changing images introduce visitors to different plants without requiring them to select anything.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Plant slideshow demonstration">
          <source src="videos/plantslideshow.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="index.php">Home page</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/css/css3_animations.asp">W3Schools: CSS animation</a>
          </div>
        </div>
      </aside>
    </section>
    <section id="banners">
      <div class="enhancement-copy">
        <h2>Gently moving hero images</h2>
        <p>Hero photographs move slowly behind the page headings. The gentle movement adds visual interest while the dark overlay keeps the heading text readable.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Moving hero images demonstration">
          <source src="videos/heropageslowmove.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="contributor.php">Contribution</a>
            <a class="enhancement-button" href="explore.php">Explore</a>
            <a class="enhancement-button" href="explore1.php">Families</a>
            <a class="enhancement-button" href="explore2.php">Genera</a>
            <a class="enhancement-button" href="explore3.php">Species</a>
            <a class="enhancement-button" href="identify.php">Identification</a>
            <a class="enhancement-button" href="enquiry.php">Enquiry</a>
            <a class="enhancement-button" href="login.php">Login</a>
            <a class="enhancement-button" href="register.php">Registration</a>
            <a class="enhancement-button" href="profile.php">Profile</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/css/css3_2dtransforms.asp">W3Schools: CSS transforms</a>
          </div>
        </div>
      </aside>
    </section>

    <section id="flip">
      <div class="enhancement-copy">
        <h2>Two-sided flip cards</h2>
        <p>Hover over or focus a card to turn it and reveal the reverse side. The back shows additional contributor details, plant-care tips or a profile introduction.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Flip cards demonstration">
          <source src="videos/flip.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="contributor.php">Contributor cards</a>
            <a class="enhancement-button" href="identify.php#example-results">sample result</a>
            <a class="enhancement-button" href="profile1.php">Personal Details</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/howto/howto_css_flip_card.asp">W3Schools: Flip card</a>
          </div>
        </div>
      </aside>
    </section>

    <section id="hover">
      <div class="enhancement-copy">
        <h2>Image &amp; button hover effects</h2>
        <p>Photos and buttons change appearance when visitors hover over them. This provides a clear visual response and helps interactive items stand out across the catalogue and team pages.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Image hover effect demonstration">
          <source src="videos/hovereffect.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="index.php">Home</a>
            <a class="enhancement-button" href="explore.php">Explore</a>
            <a class="enhancement-button" href="explore1.php">Families</a>
            <a class="enhancement-button" href="explore2.php">Genera</a>
            <a class="enhancement-button" href="explore3.php">Species</a>
            <a class="enhancement-button" href="contributor.php">Contribution</a>
            <a class="enhancement-button" href="identify.php">Identification</a>
            <a class="enhancement-button" href="profile.php">Profile</a>
            <a class="enhancement-button" href="profile1.php">Nicholas Sia Siang Wei Profile</a>
            <a class="enhancement-button" href="profile2.php">Hui Ching Teo Profile</a>
            <a class="enhancement-button" href="profile4.php">Jayden Wong Wen Jie Profile</a>
            <a class="enhancement-button" href="profile3.php">Muhammad Hishamuddin Ngu Profile</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/howto/howto_css_transition_hover.asp">W3Schools: Hover transition</a>
          </div>
        </div>
      </aside>
    </section>
    <section id="maps">
      <div class="enhancement-copy">
        <h2>Embedded hometown maps</h2>
        <p>Each member profile includes a map embedded from Google Maps. It shows the hometown associated with that team member.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Google Maps demonstration">
          <source src="videos/google%20map.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="profile1.php">Nicholas Sia Siang Wei Profile</a>
            <a class="enhancement-button" href="profile2.php">Hui Ching Teo Profile</a>
            <a class="enhancement-button" href="profile4.php">Jayden Wong Wen Jie Profile</a>
            <a class="enhancement-button" href="profile3.php">Muhammad Hishamuddin Ngu Profile</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://developers.google.com/maps/documentation/embed/embedding-map">Google: Embed a map</a>
          </div>
        </div>
      </aside>
    </section>

    <section id="audio">
      <div class="enhancement-copy">
        <h2>Profile music controls</h2>
        <p>Each profile page has a compact music control. Visitors can use it to play or pause the audio on that profile.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Background music demonstration">
          <source src="videos/backmusic.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="profile1.php">Nicholas Sia Siang Wei Profile</a>
            <a class="enhancement-button" href="profile2.php">Hui Ching Teo Profile</a>
            <a class="enhancement-button" href="profile4.php">Jayden Wong Wen Jie Profile</a>
            <a class="enhancement-button" href="profile3.php">Muhammad Hishamuddin Ngu Profile</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/html/html5_audio.asp">W3Schools: HTML audio</a>
          </div>
        </div>
      </aside>
    </section>

    <section id="skill-garden">
      <div class="enhancement-copy">
        <h2>Skill Garden</h2>
        <p>Muhammad's skills appear as six growing stems with percentage labels. Hover over or focus a plant to read more about that skill; the illustration and motion use CSS.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Skill Garden demonstration">
          <source src="videos/skill-garden.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="profile3.php#skill-garden-title">Muhammad Hishamuddin Ngu Profile</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://www.w3schools.com/css/css3_animations.asp">W3Schools: CSS animations</a>
          </div>
        </div>
      </aside>
    </section>

    <section id="form-reset">
      <div class="enhancement-copy">
        <h2>Form reset buttons</h2>
        <p>A Reset button clears the values entered in its form and restores the original field values. This uses the browser's built-in HTML form behaviour.</p>
        <video class="enhancement-demo" autoplay muted loop playsinline preload="metadata" aria-label="Form reset button demonstration">
          <source src="videos/form-reset.mp4" type="video/mp4">
          Your browser does not support embedded video.
        </video>
      </div>
      <aside class="enhancement-actions">
        <div class="enhancement-action-group">
          <h3>Where it appears</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button" href="contribute.php#contribution-reset">Contribution Form</a>
            <a class="enhancement-button" href="identify.php#identify-reset">Identification</a>
            <a class="enhancement-button" href="enquiry.php#enquiry-reset">Enquiry</a>
            <a class="enhancement-button" href="register.php#register-reset">Registration</a>
            <a class="enhancement-button" href="login.php#login-reset">Login</a>
            <a class="enhancement-button" href="forpass.php#forgot-reset">Forgot Password</a>
          </div>
        </div>
        <div class="enhancement-action-group">
          <h3>Reference</h3>
          <div class="enhancement-buttons">
            <a class="enhancement-button reference-button" href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/reset">MDN: Reset button</a>
          </div>
        </div>
      </aside>
    </section>
  </div>
</main>

<?php include('includes/footer.inc.php'); ?>
