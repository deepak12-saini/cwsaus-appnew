<?php
/**
 * Services page
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$this->assign('meta_description', 'CWS waterproofing services – residential, commercial and liquid waterproofing systems installed by expert tradespeople across Sydney and Australia.');
$this->assign('meta_keywords', 'waterproofing services Sydney, residential waterproofing, commercial waterproofing, liquid membrane, CWS Australia services');

$serviceCards = [
    [
        'icon' => 'fa-home',
        'title' => 'Residential Waterproofing',
        'text' => 'Complete waterproofing solutions for homes, bathrooms, balconies, and wet areas across Sydney and Australia.',
        'link' => $siteUrl . 'contact-us',
    ],
    [
        'icon' => 'fa-building',
        'title' => 'Commercial Waterproofing',
        'text' => 'High-quality waterproofing systems for offices, retail, industrial, and multi-storey commercial developments.',
        'link' => $siteUrl . 'contact-us',
    ],
    [
        'icon' => 'fa-tint',
        'title' => 'Liquid Waterproofing',
        'text' => 'Advanced liquid-applied membranes and coating systems installed by trained CWS technicians for long-term protection.',
        'link' => $siteUrl . 'contact-us',
    ],
];
?>
<style>
.cws-services-page { padding: 50px 0 70px; background: #fff; }
.cws-services-page .services-script-title {
  font-family: "Brush Script MT", "Segoe Script", cursive;
  color: #f9a71f;
  font-size: 42px;
  line-height: 1.2;
  margin: 0 0 28px;
  padding-bottom: 6px;
  text-align: center;
}
.cws-services-page .services-main-title {
  text-align: center;
  font-size: 30px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #222;
  margin: 0 0 18px;
}
.cws-services-page .services-cards-row {
  display: flex;
  flex-wrap: wrap;
}
.cws-services-page .services-cards-row > [class*="col-"] {
  display: flex;
  flex-direction: column;
  margin-bottom: 24px;
}
.cws-services-page .services-intro {
  max-width: 900px;
  margin: 0 auto 45px;
  text-align: center;
  color: #666;
  font-size: 16px;
  line-height: 1.7;
}
.cws-services-page .services-intro strong { color: #333; }
.cws-services-page .service-card {
  background: #1f1f1f;
  border-radius: 4px;
  text-align: center;
  padding: 42px 24px 34px;
  height: 100%;
  min-height: 380px;
  margin-bottom: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}
.cws-services-page .service-card-icon {
  width: 92px;
  height: 92px;
  border-radius: 50%;
  background: #2a2a2a;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 24px;
}
.cws-services-page .service-card-icon i {
  color: #f9a71f;
  font-size: 34px;
}
.cws-services-page .service-card h3 {
  color: #fff;
  font-size: 22px;
  font-weight: 700;
  margin: 0 0 16px;
  text-transform: capitalize;
}
.cws-services-page .service-card p {
  color: #d5d5d5;
  font-size: 15px;
  line-height: 1.65;
  margin: 0 0 0;
  flex: 1 1 auto;
  padding-bottom: 28px;
}
.cws-services-page .service-card .btn-learn {
  display: inline-block;
  margin-top: auto;
  flex-shrink: 0;
  border: 2px solid #f9a71f;
  color: #fff !important;
  background: transparent;
  border-radius: 30px;
  padding: 10px 28px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none !important;
  transition: all 0.25s ease;
}
.cws-services-page .service-card .btn-learn:hover {
  background: #f9a71f;
  color: #1a1a1a !important;
}
@media (max-width: 991px) {
  .cws-services-page .services-cards-row { display: block; }
  .cws-services-page .services-cards-row > [class*="col-"] { display: block; }
  .cws-services-page .service-card { min-height: 320px; height: auto; margin-bottom: 20px; }
}
</style>

<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow fadeInLeft" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>Services</h1>
      <p>Professional waterproofing solutions across Australia</p>
    </div>
  </div>
</section>

<section class="cws-services-page">
  <div class="container">
    <p class="services-script-title">Services</p>
    <h2 class="services-main-title">What We Can Do For You</h2>
    <p class="services-intro">
      CWS Australia are specialists in the waterproofing industry, a <strong>leading waterproofing company</strong>
      with years of combined knowledge, experience and expertise across residential, commercial and liquid-applied systems.
    </p>

    <div class="row services-cards-row">
      <?php foreach ($serviceCards as $card) : ?>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="service-card wow fadeInUp" data-wow-duration="1.2s">
          <div class="service-card-icon">
            <i class="fa <?= h($card['icon']) ?>" aria-hidden="true"></i>
          </div>
          <h3><?= h($card['title']) ?></h3>
          <p><?= h($card['text']) ?></p>
          <a href="<?= h($card['link']) ?>" class="btn-learn">Learn More</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
