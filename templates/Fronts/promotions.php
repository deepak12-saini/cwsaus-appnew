<?php
/**
 * Promotions page
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$this->assign('meta_description', 'CWS Australia promotions – trade pricing, builder packages, and seasonal offers on waterproofing products and installation services across Australia.');
$this->assign('meta_keywords', 'waterproofing promotions Australia, trade pricing, builder account, CWS Australia offers');

$promoCards = [
    [
        'badge' => 'Trade',
        'title' => 'Builder & Trade Accounts',
        'text' => 'Preferred pricing and dedicated support for licensed builders, contractors, and repeat trade customers across Australia.',
        'icon' => 'fa-wrench',
    ],
    [
        'badge' => 'Projects',
        'title' => 'Multi-Unit & Commercial Packages',
        'text' => 'Tailored waterproofing packages for apartment, commercial, and civil projects — from supply through to installation.',
        'icon' => 'fa-building-o',
    ],
    [
        'badge' => 'Seasonal',
        'title' => 'Seasonal Product Offers',
        'text' => 'Limited-time promotions on selected membranes, sealants, and accessories. Contact your local CWS branch for current availability.',
        'icon' => 'fa-tags',
    ],
];

$promoBenefits = [
    'Competitive pricing on leading waterproofing brands',
    'National stock holdings and reliable delivery',
    'Technical support from experienced sales teams',
    'Installation services available through CWS contracting',
    'Warranted systems installed to manufacturer standards',
];
?>
<style>
.cws-promotions-page { padding: 50px 0 70px; background: #fff; }
.cws-promotions-page .page-script-title {
  font-family: "Brush Script MT", "Segoe Script", cursive;
  color: #f9a71f;
  font-size: 42px;
  line-height: 1.2;
  margin: 0 0 28px;
  text-align: center;
}
.cws-promotions-page .page-main-title {
  text-align: center;
  font-size: 30px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #222;
  margin: 0 0 18px;
}
.cws-promotions-page .page-intro {
  max-width: 920px;
  margin: 0 auto 40px;
  text-align: center;
  color: #666;
  font-size: 16px;
  line-height: 1.75;
}
.cws-promotions-page .promo-cards-row {
  display: flex;
  flex-wrap: wrap;
}
.cws-promotions-page .promo-cards-row > [class*="col-"] {
  display: flex;
  flex-direction: column;
  margin-bottom: 24px;
}
.cws-promotions-page .promo-card {
  background: #1f1f1f;
  border-radius: 4px;
  text-align: center;
  padding: 38px 24px 32px;
  height: 100%;
  min-height: 340px;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  position: relative;
}
.cws-promotions-page .promo-badge {
  position: absolute;
  top: 16px;
  right: 16px;
  background: #f9a71f;
  color: #1a1a1a;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 5px 12px;
  border-radius: 20px;
}
.cws-promotions-page .promo-card-icon {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  background: #2a2a2a;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 22px;
}
.cws-promotions-page .promo-card-icon i { color: #f9a71f; font-size: 32px; }
.cws-promotions-page .promo-card h3 {
  color: #fff;
  font-size: 21px;
  font-weight: 700;
  margin: 0 0 14px;
  padding: 0 10px;
}
.cws-promotions-page .promo-card p {
  color: #d5d5d5;
  font-size: 15px;
  line-height: 1.65;
  margin: 0 0 24px;
  flex: 1 1 auto;
  padding-bottom: 8px;
}
.cws-promotions-page .promo-card .btn-learn {
  display: inline-block;
  border: 2px solid #f9a71f;
  color: #fff !important;
  background: transparent;
  border-radius: 30px;
  padding: 10px 26px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none !important;
  margin-top: auto;
  flex-shrink: 0;
  transition: all 0.25s ease;
}
.cws-promotions-page .promo-card .btn-learn:hover {
  background: #f9a71f;
  color: #1a1a1a !important;
}
.cws-promotions-page .benefits-panel {
  background: linear-gradient(135deg, #007bc1 0%, #005a8f 100%);
  color: #fff;
  padding: 36px 40px;
  border-radius: 4px;
  margin: 10px 0 36px;
}
.cws-promotions-page .benefits-panel h3 {
  margin: 0 0 18px;
  font-size: 24px;
  font-weight: 700;
}
.cws-promotions-page .benefits-panel ul {
  margin: 0;
  padding-left: 20px;
  line-height: 1.9;
  font-size: 15px;
}
.cws-promotions-page .notice-box {
  background: #fff8e8;
  border: 1px solid #f9a71f;
  border-radius: 4px;
  padding: 18px 22px;
  text-align: center;
  color: #555;
  font-size: 15px;
  margin-bottom: 30px;
}
.cws-promotions-page .page-cta { text-align: center; }
.cws-promotions-page .page-cta .btn-contact {
  display: inline-block;
  background: #f9a71f;
  color: #1a1a1a !important;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 14px 36px;
  border-radius: 30px;
  text-decoration: none !important;
}
.cws-promotions-page .page-cta .btn-contact:hover { background: #e89610; }
@media (max-width: 991px) {
  .cws-promotions-page .promo-cards-row { display: block; }
  .cws-promotions-page .promo-cards-row > [class*="col-"] { display: block; }
  .cws-promotions-page .promo-card { min-height: 0; height: auto; }
}
</style>

<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>Promotions</h1>
      <p>Special offers, trade pricing and project packages from CWS Australia</p>
    </div>
  </div>
</section>

<section class="cws-promotions-page">
  <div class="container">
    <p class="page-script-title">Promotions</p>
    <h2 class="page-main-title">Current Offers &amp; Packages</h2>
    <p class="page-intro">
      CWS Australia supports builders, contractors, and project teams with competitive pricing on waterproofing
      products and installation services. Explore our trade programs and contact your nearest branch for the
      latest promotions available in your region.
    </p>

    <div class="notice-box wow fadeIn" data-wow-duration="1s">
      <strong>Note:</strong> Promotions vary by location and stock availability. Contact CWS for current pricing on your project.
    </div>

    <div class="row promo-cards-row">
      <?php foreach ($promoCards as $card) : ?>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="promo-card wow fadeInUp" data-wow-duration="1.2s">
          <span class="promo-badge"><?= h($card['badge']) ?></span>
          <div class="promo-card-icon">
            <i class="fa <?= h($card['icon']) ?>" aria-hidden="true"></i>
          </div>
          <h3><?= h($card['title']) ?></h3>
          <p><?= h($card['text']) ?></p>
          <a href="<?= $siteUrl ?>contact-us" class="btn-learn">Enquire Now</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="benefits-panel wow fadeInUp" data-wow-duration="1.2s">
      <h3>Why Choose CWS For Your Next Project</h3>
      <ul>
        <?php foreach ($promoBenefits as $benefit) : ?>
        <li><?= h($benefit) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="page-cta">
      <p style="color:#666; margin-bottom:18px;">Ask about trade accounts, bulk orders, or installation packages today.</p>
      <a href="<?= $siteUrl ?>contact-us" class="btn-contact">Get A Quote</a>
    </div>
  </div>
</section>
