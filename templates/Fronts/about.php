<?php
/**
 * About page
 * @var \Cake\ORM\Entity|null $menu
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$bannerTitle = $menu && ($menu->banner_title ?? $menu->title) ? ($menu->banner_title ?? $menu->title) : 'About Us';
$bannerSub = $menu && ($menu->banner_sub_text ?? '') !== '' ? $menu->banner_sub_text : 'Professional waterproofing contracting & installation across Australia';
$pageTitle = $menu && ($menu->main_title ?? $menu->title) ? ($menu->main_title ?? $menu->title) : 'About Us';
?>
<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1><?= h($bannerTitle) ?></h1>
      <p><?= h($bannerSub) ?></p>
    </div>
  </div>
</section>
<!-- End Banner -->

<section id="abtsec" class="about-page">
  <div class="container">
    <div class="row about-page-row">
      <div class="col-md-5 col-sm-12 about-page-visual">
        <div class="about-page-image-wrap">
          <img src="<?= $siteUrl ?>front_theme/images/guarantee.png" alt="100% Leak Free Guarantee" class="img-responsive about-page-image">
        </div>
      </div>
      <div class="col-md-7 col-sm-12 about-page-content">
        <div class="title-area">
          <h2 class="title"><?= h($pageTitle) ?></h2>
          <span class="line"></span>
        </div>
        <div class="about-page-text">
          <p>CWS Australia is a professional waterproofing contracting and installation company serving builders and property owners across Australia. With offices and teams positioned nationally, we are a trusted partner for domestic and commercial waterproofing projects of every scale.</p>
          <p>We specialise in the supply and installation of proven membrane systems for bathrooms, balconies, basements, podiums, roofs, and commercial structures. Our focus is on durable, warrantable outcomes — from product selection through to on-site application and quality assurance.</p>
          <p>Our licensed, experienced installers work with leading liquid, sheet, and cementitious membrane systems. We invest in training, compliance, and practical site knowledge so every installation meets Australian standards and manufacturer requirements.</p>
          <p>We work with residential building companies, national constructors, strata managers, engineers, consultants, and government projects. Whether you need a single wet area waterproofed or a large-scale commercial envelope, CWS delivers reliable installation backed by national support.</p>
        </div>
      </div>
    </div>
  </div>
</section>
