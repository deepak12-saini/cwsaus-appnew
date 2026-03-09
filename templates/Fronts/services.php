<?php
/**
 * Our Services page
 * @var \Cake\ORM\ResultSet $Gallery
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
?>
<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow fadeInLeft" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>Our SERVICES</h1>
    </div>
  </div>
</section>
<!-- End Banner -->

<section id="abtsec">
  <div class="container">
    <div class="row">
      <div class="contcttpsc">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">We Provide Professional Services</h2>
            <span class="line"></span>
            <p>We always offer a collaborative approach and integrated solutions that we tailor to each client's unique budget and timeline</p>
          </div>
        </div>
        <?php if ($Gallery && $Gallery->count() > 0): ?>
        <div class="servpgwrp">
          <div class="row">
            <div class="rgtsrin">
              <?php foreach ($Gallery as $gallery): ?>
              <div class="col-md-12 col-sm-12 wow zoomIn" data-wow-duration="1.9s" data-wow-delay="0s" style="margin-top:20px;">
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <a data-fancybox="gallery" data-caption="<?= h($gallery->title) ?>" href="<?= $siteUrl ?>gallery/<?= h($gallery->image) ?>" class="fans">
                    <img class="img-responsive" src="<?= $siteUrl ?>gallery/<?= h($gallery->image) ?>" alt="">
                  </a>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                  <h4 style="color:#007bc1;"><?= h($gallery->title) ?> <span class="line"></span></h4>
                  <br>
                  <div style="text-align: justify;font-size: 14px;">
                    <?= $gallery->description ? $this->Text->autoParagraph(h($gallery->description)) : '' ?>
                  </div>
                </div>
              </div>
              <br><hr/>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
