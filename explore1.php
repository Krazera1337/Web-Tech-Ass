<?php
$pageTitle = 'Plant Families — Forest Story';
$bodyClass = 'explore-page';
$activePage = 'explore';
$heroTitle = 'Plant Families';
$heroLede = 'Compare the four plant families in this collection.';
$heroCopyClass = true;
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/nav.inc.php';
include __DIR__ . '/includes/page-hero.inc.php';
?>

<main>
  <div class="page-wrap">
    <div class="page-hero-actions">
      <a class="btn" href="#family-cards" id="explore-families">Explore Families <span class="arrow" aria-hidden="true">&darr;</span></a>
      <a class="btn btn-outline" href="identify.php" id="family-identify">Identify a Plant</a>
    </div>
    <p class="back-link"><a href="explore.php">&larr; Back to Explore</a></p>

    <?php include __DIR__ . '/includes/catalogue-jump.inc.php'; ?>

    <div class="intro-section">
      <h2>Understanding Plant Families</h2>
      <div class="intro-grid">
        <p class="lede">A plant family is the taxonomic rank that groups
        genera sharing a common evolutionary ancestor and a broadly similar
        flower and fruit structure.</p>
        <p class="supporting-text">Forest Story features four families —
        two rooted mainly in tropical Asia, and two whose genera split
        between Asia, Africa and the Americas. Each entry below covers a
        family's growth habit and distribution, its diagnostic leaf, flower
        and fruit traits, then its two genera. Read the Genera and Species
        pages for finer detail.</p>
      </div>
    </div>

    <div class="family-picker" id="family-cards">
      <p class="tab-hint">Choose a family to explore its full profile:</p>

      <div class="family-cards">
        <a href="#myristicaceae" class="family-card">
          <span class="family-card-media"><img src="images/family-myristicaceae.jpg" alt="A tree of the nutmeg family, Myristicaceae"></span>
          <span class="family-card-body">
            <span class="family-card-name">Myristicaceae</span>
            <span class="family-card-desc">Simple leaves; fruit splits open to reveal a seed wrapped in a bright aril.</span>
            <span class="family-card-cta">Explore <span class="arrow" aria-hidden="true">&rarr;</span></span>
          </span>
        </a>
        <a href="#chrysobalanaceae" class="family-card">
          <span class="family-card-media"><img src="images/family-chrysobalanaceae.jpg" alt="A flowering tree of the cocoplum family, Chrysobalanaceae"></span>
          <span class="family-card-body">
            <span class="family-card-name">Chrysobalanaceae</span>
            <span class="family-card-desc">Simple leaves with small stipules; single-seeded fleshy drupe.</span>
            <span class="family-card-cta">Explore <span class="arrow" aria-hidden="true">&rarr;</span></span>
          </span>
        </a>
        <a href="#meliaceae" class="family-card">
          <span class="family-card-media"><img src="images/family-meliaceae.jpg" alt="Flowers of a mahogany family tree, Meliaceae"></span>
          <span class="family-card-body">
            <span class="family-card-name">Meliaceae</span>
            <span class="family-card-desc">Usually pinnately compound leaves; fragrant flowers; capsule or berry fruit.</span>
            <span class="family-card-cta">Explore <span class="arrow" aria-hidden="true">&rarr;</span></span>
          </span>
        </a>
        <a href="#ebenaceae" class="family-card">
          <span class="family-card-media"><img src="images/family-ebenaceae.jpg" alt="Foliage of an ebony family tree, Ebenaceae"></span>
          <span class="family-card-body">
            <span class="family-card-name">Ebenaceae</span>
            <span class="family-card-desc">Simple leaves; separate male/female flowers; berry with persistent calyx; dark heartwood.</span>
            <span class="family-card-cta">Explore <span class="arrow" aria-hidden="true">&rarr;</span></span>
          </span>
        </a>
      </div>

    <section id="myristicaceae" class="tab-panel" aria-labelledby="myristicaceae-heading">
      <h2 id="myristicaceae-heading">Myristicaceae — the Nutmeg Family</h2>
      <figure>
        <img src="images/family-myristicaceae.jpg" alt="A tree of the nutmeg family, Myristicaceae, showing its foliage and fruit" width="500">
        <figcaption>Fig. 1 — A representative tree of the nutmeg family (Myristicaceae).</figcaption>
      </figure>
      <p>Myristicaceae is a family of aromatic evergreen trees found across
      the tropics of Asia, Africa and the Americas, most famous for giving
      the world commercial nutmeg. Members typically have alternate, simple,
      leathery leaves and small, inconspicuous, single-sexed flowers, since
      individual trees are either male or female. The signature trait of the
      family is its fruit: a fleshy capsule that splits open to reveal a
      single seed wrapped in a bright red or orange aril, a structure prized
      by hornbills and pigeons as much as by cooks. Our two featured genera,
      <em>Horsfieldia</em> and <em>Knema</em>, are both large, species-rich
      genera concentrated in the rainforests of tropical Asia.</p>
      <h3>Genera in this family</h3>
      <ul>
        <li><a href="explore2.php#horsfieldia"><em>Horsfieldia</em></a> — trees ranging from the eastern Himalaya to Sumatra and the Malay Peninsula.</li>
        <li><a href="explore2.php#knema"><em>Knema</em></a> — trees of central and eastern Malesia with densely hairy fruit.</li>
      </ul>
      <h3>Species in this family</h3>
      <ul>
        <li><a href="explore3.php#horsfieldia-flocculosa"><em>Horsfieldia flocculosa</em></a></li>
        <li><a href="explore3.php#horsfieldia-kingii"><em>Horsfieldia kingii</em></a></li>
        <li><a href="explore3.php#knema-cinerea"><em>Knema cinerea</em></a></li>
        <li><a href="explore3.php#knema-sumatrana"><em>Knema sumatrana</em></a></li>
      </ul>
    </section>

    <section id="chrysobalanaceae" class="tab-panel" aria-labelledby="chrysobalanaceae-heading">
      <h2 id="chrysobalanaceae-heading">Chrysobalanaceae — the Cocoplum Family</h2>
      <figure>
        <img src="images/family-chrysobalanaceae.jpg" alt="A tree of the cocoplum family, Chrysobalanaceae, in flower" width="500">
        <figcaption>Fig. 2 — A flowering member of the cocoplum family (Chrysobalanaceae).</figcaption>
      </figure>
      <p>Chrysobalanaceae is a pantropical family whose genera are split
      between Asia and the Neotropics — a pattern reflected directly in our
      two chosen genera. Species are trees or shrubs with alternate, simple
      leaves, small paired stipules at the leaf base, and small white,
      cream or pink flowers arranged in racemes or panicles. The fruit is
      typically a single-seeded drupe, often edible, that gives the family
      its common name. <em>Parastemon</em> represents the family's
      Southeast Asian, peat-swamp-forest lineage, while <em>Hirtella</em>
      represents its Central and South American, rainforest-understorey
      lineage.</p>
      <h3>Genera in this family</h3>
      <ul>
        <li><a href="explore2.php#parastemon"><em>Parastemon</em></a> — large canopy trees of Southeast Asian peat-swamp and heath forest.</li>
        <li><a href="explore2.php#hirtella"><em>Hirtella</em></a> — shrubs and small understorey trees of Central and South America.</li>
      </ul>
      <h3>Species in this family</h3>
      <ul>
        <li><a href="explore3.php#parastemon-urophyllus"><em>Parastemon urophyllus</em></a></li>
        <li><a href="explore3.php#parastemon-grandifructus"><em>Parastemon grandifructus</em></a></li>
        <li><a href="explore3.php#hirtella-triandra"><em>Hirtella triandra</em></a></li>
        <li><a href="explore3.php#hirtella-racemosa"><em>Hirtella racemosa</em></a></li>
      </ul>
    </section>

    <section id="meliaceae" class="tab-panel" aria-labelledby="meliaceae-heading">
      <h2 id="meliaceae-heading">Meliaceae — the Mahogany Family</h2>
      <figure>
        <img src="images/family-meliaceae.jpg" alt="Flowers of Melia azedarach, a member of the mahogany family Meliaceae" width="500">
        <figcaption>Fig. 3 — Flowers of a mahogany-family (Meliaceae) tree.</figcaption>
      </figure>
      <p>Meliaceae is the family that gives the timber industry true
      mahogany, and its two featured genera here, <em>Aglaia</em> and
      <em>Dysoxylum</em>, are large Asian-Pacific genera valued for both
      timber and fruit. Unlike the previous two families, most Meliaceae
      species carry pinnately compound leaves rather than simple ones,
      often covered in distinctive star-shaped (stellate) or scaly hairs.
      Flowers are small but frequently intensely fragrant, and fruit is
      usually a capsule or berry containing seeds covered in an edible,
      oily aril. Several species in this family are important canopy or
      emergent rainforest trees reaching well over 30 metres tall.</p>
      <h3>Genera in this family</h3>
      <ul>
        <li><a href="explore2.php#aglaia"><em>Aglaia</em></a> — trees and shrubs known for fragrant flowers and edible arillate fruit.</li>
        <li><a href="explore2.php#dysoxylum"><em>Dysoxylum</em></a> — large timber trees ranging from mainland Asia to northern Australia.</li>
      </ul>
      <h3>Species in this family</h3>
      <ul>
        <li><a href="explore3.php#aglaia-elliptica"><em>Aglaia elliptica</em></a></li>
        <li><a href="explore3.php#aglaia-korthalsii"><em>Aglaia korthalsii</em></a></li>
        <li><a href="explore3.php#dysoxylum-acutangulum"><em>Dysoxylum acutangulum</em></a></li>
        <li><a href="explore3.php#dysoxylum-grande"><em>Dysoxylum grande</em></a></li>
      </ul>
    </section>

    <section id="ebenaceae" class="tab-panel" aria-labelledby="ebenaceae-heading">
      <h2 id="ebenaceae-heading">Ebenaceae — the Ebony Family</h2>
      <figure>
        <img src="images/family-ebenaceae.jpg" alt="Foliage of a tree in the ebony family, Ebenaceae" width="500">
        <figcaption>Fig. 4 — Foliage of an ebony-family (Ebenaceae) tree.</figcaption>
      </figure>
      <p>Ebenaceae is best known for producing the dense, jet-black
      heartwood traditionally called ebony. Like Chrysobalanaceae, this
      family's genera are split across continents: <em>Diospyros</em>
      (which also gives us the cultivated persimmon) is enormously diverse
      across Asia, while <em>Euclea</em> is its African counterpart. Both
      genera share simple, alternate, often leathery leaves, separate male
      and female flowers, and a berry-type fruit seated in a persistent,
      often enlarged calyx. Several species are important sources of
      traditional medicine as well as fine timber.</p>
      <h3>Genera in this family</h3>
      <ul>
        <li><a href="explore2.php#diospyros"><em>Diospyros</em></a> — the ebony genus, ranging from India across Malesia to the Pacific.</li>
        <li><a href="explore2.php#euclea"><em>Euclea</em></a> — shrubs and small trees native to eastern and southern Africa.</li>
      </ul>
      <h3>Species in this family</h3>
      <ul>
        <li><a href="explore3.php#diospyros-ferrea"><em>Diospyros ferrea</em></a></li>
        <li><a href="explore3.php#diospyros-ebenum"><em>Diospyros ebenum</em></a></li>
        <li><a href="explore3.php#euclea-natalensis"><em>Euclea natalensis</em></a></li>
        <li><a href="explore3.php#euclea-racemosa"><em>Euclea racemosa</em></a></li>
      </ul>
    </section>
    </div>
  </div>

  <div class="page-wrap with-aside">
   <div>
    <section aria-labelledby="compare-heading">
      <h2 id="compare-heading">Family comparison at a glance</h2>
      <p>Check the leaf shape first, then the fruit type, and shortlist a
      likely family from the quick reference below.</p>
      <div class="comparison-table-wrap">
        <table class="comparison-table">
          <caption class="sr-only">Leaf, fruit and key identifying feature for each of the four families</caption>
          <thead>
            <tr>
              <th scope="col">Family</th>
              <th scope="col">
                <span class="th-icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 20C4 10 10 4 20 4c0 10-6 16-16 16Z"/><path d="M6 18C10 14 13 11 18 6"/></svg>
                </span>Leaves
              </th>
              <th scope="col">
                <span class="th-icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3c3 4 6 7 6 11a6 6 0 1 1-12 0c0-4 3-7 6-11Z"/></svg>
                </span>Fruit
              </th>
              <th scope="col">
                <span class="th-icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.6 7.1.6-5.4 4.7 1.7 7-6.3-3.9L5.7 21l1.7-7-5.4-4.7 7.1-.6L12 2Z"/></svg>
                </span>Key feature
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Myristicaceae</th>
              <td>Simple</td>
              <td>Splits open to reveal a seed wrapped in a bright aril</td>
              <td>Capsule with bright aril</td>
            </tr>
            <tr>
              <th scope="row">Chrysobalanaceae</th>
              <td>Simple, with small stipules</td>
              <td>Single-seeded fleshy drupe</td>
              <td>Fleshy drupe</td>
            </tr>
            <tr>
              <th scope="row">Meliaceae</th>
              <td>Usually pinnately compound</td>
              <td>Capsule or berry</td>
              <td>Fragrant flowers</td>
            </tr>
            <tr>
              <th scope="row">Ebenaceae</th>
              <td>Simple</td>
              <td>Berry with persistent calyx</td>
              <td>Dark heartwood</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
   </div>

  <aside aria-labelledby="aside-heading" class="insight-panel">
    <svg class="insight-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" focusable="false"><path d="M4 20C4 10 10 4 20 4c0 10-6 16-16 16Z"/><path d="M6 18C10 14 13 11 18 6"/></svg>
    <h2 id="aside-heading">Why families matter</h2>
    <p>Taxonomic families are more than filing categories — plants in the
    same family often share useful chemical compounds, pollinator
    relationships, and vulnerabilities to pests or disease. Foresters and
    conservationists frequently make management decisions at the family
    level when species-specific data is unavailable.</p>
    <p class="continue-label">Continue exploring</p>
    <div class="continue-links">
      <a class="continue-link" href="explore2.php" id="family-browse-genera">Browse Genera <span class="arrow" aria-hidden="true">&rarr;</span></a>
      <a class="continue-link" href="explore3.php" id="family-browse-species">Browse Species <span class="arrow" aria-hidden="true">&rarr;</span></a>
    </div>
    <svg class="insight-decor" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true" focusable="false"><path d="M4 20C4 10 10 4 20 4c0 10-6 16-16 16Z"/><path d="M6 18C10 14 13 11 18 6"/></svg>
  </aside>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.inc.php'; ?>
