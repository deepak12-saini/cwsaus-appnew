<?php
/**
 * Projects page (menu slug: /products or /projects)
 * @var \Cake\ORM\Entity[]|\Cake\ORM\ResultSet $Gallery
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';

// Fallback static project images if gallery is empty
$staticImages = [
    ['src' => $siteUrl . 'front_theme/images/actimg.jpg',       'alt' => 'Waterproofing Project 1'],
    ['src' => $siteUrl . 'front_theme/images/actimg2.jpg',      'alt' => 'Waterproofing Project 2'],
    ['src' => $siteUrl . 'front_theme/images/actimg3.jpg',      'alt' => 'Waterproofing Project 3'],
    ['src' => $siteUrl . 'front_theme/images/actimg4.jpg',      'alt' => 'Waterproofing Project 4'],
    ['src' => $siteUrl . 'front_theme/images/servcsbg.jpg',     'alt' => 'Waterproofing Project 5'],
    ['src' => $siteUrl . 'front_theme/images/bannerbginer.jpg', 'alt' => 'Waterproofing Project 6'],
];

$galleryImages = [];
if (!empty($Gallery)) {
    foreach ($Gallery as $g) {
        $img = $g->image ?? ($g->photo ?? null);
        if ($img) {
            // Keep the same image path pattern used by services.php: /gallery/<filename>
            $galleryImages[] = [
                'src' => $siteUrl . 'gallery/' . h($img),
                'alt' => h($g->title ?? 'Project')
            ];
        }
    }
}
$projectImages = !empty($galleryImages) ? $galleryImages : $staticImages;
?>
<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>Projects</h1>
      <p>Professional waterproofing installations across Australia</p>
    </div>
  </div>
</section>
<!-- End Banner -->

<section id="projects-sec" style="padding: 60px 0; background: #fff;">
  <div class="container">

    <div class="row">
      <div class="col-md-12" style="text-align:center; margin-bottom:40px;">
        <h2 class="title" style="font-size:28px; font-weight:700; text-transform:uppercase; letter-spacing:1px;">PROJECTS</h2>
        <p style="color:#666; max-width:560px; margin:10px auto 0; font-size:15px; line-height:1.7;">
          We are committed to providing accredited workmanship<br>
          delivered by certified waterproofers which are recognised Australia wide.
        </p>
      </div>
    </div>

    <?php
    // Build mosaic: first image large (spans 2 rows), remaining 4 in 2×2 grid beside it
    $total = count($projectImages);
    $chunks = array_chunk($projectImages, 5); // groups of 5 per mosaic block
    foreach ($chunks as $group):
        $large = $group[0] ?? null;
        $smalls = array_slice($group, 1);
    ?>
    <div class="row projects-mosaic" style="margin-bottom:10px;">
      <?php if ($large): ?>
      <div class="col-md-5 col-sm-12 projects-mosaic-large" style="padding:5px;">
        <img src="<?= $large['src'] ?>" alt="<?= $large['alt'] ?>"
             style="width:100%; height:420px; object-fit:cover; display:block;">
      </div>
      <?php endif; ?>

      <div class="col-md-7 col-sm-12" style="padding:0;">
        <div class="row" style="margin:0;">
          <?php foreach ($smalls as $img): ?>
          <div class="col-md-6 col-sm-6" style="padding:5px;">
            <img src="<?= $img['src'] ?>" alt="<?= $img['alt'] ?>"
                 style="width:100%; height:205px; object-fit:cover; display:block;">
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

    <?php
    // Any overflow images (beyond multiples of 5) shown in a plain row
    $overflow = array_slice($projectImages, count($chunks) * 5);
    if (!empty($overflow)):
    ?>
    <div class="row" style="margin-top:10px;">
      <?php foreach ($overflow as $img): ?>
      <div class="col-md-4 col-sm-6" style="padding:5px;">
        <img src="<?= $img['src'] ?>" alt="<?= $img['alt'] ?>"
             style="width:100%; height:220px; object-fit:cover; display:block;">
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>
