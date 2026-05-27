<?php
/**
 * Consulting page
 * @var \Cake\ORM\Entity|null $menu
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$this->assign('meta_description', 'Waterproofing consulting by CWS Australia – design advice, compliance review, defect investigation and project support for builders, engineers and strata managers.');
$this->assign('meta_keywords', 'waterproofing consulting Australia, waterproofing specification, defect investigation, CWS consulting');

$bannerTitle = ($menu && ($menu->banner_title ?? $menu->title)) ? ($menu->banner_title ?? $menu->title) : 'Consulting';
$bannerSub = ($menu && ($menu->banner_sub_text ?? '') !== '') ? $menu->banner_sub_text : 'Expert guidance for waterproofing design, compliance and project delivery';

$consultingCards = [
    [
        'icon' => 'fa-pencil-square-o',
        'title' => 'Design & Specification',
        'text' => 'Membrane selection, detail design, and specification support aligned with Australian standards and manufacturer requirements.',
    ],
    [
        'icon' => 'fa-check-square-o',
        'title' => 'Compliance & Quality',
        'text' => 'Independent review of waterproofing details, QA processes, and site inspections to reduce defects and rework.',
    ],
    [
        'icon' => 'fa-users',
        'title' => 'Project Consultation',
        'text' => 'On-site and remote support for builders, engineers, architects, and strata managers throughout the project lifecycle.',
    ],
    [
        'icon' => 'fa-file-text-o',
        'title' => 'Reporting & Documentation',
        'text' => 'Clear written advice, remediation plans, and documentation for tenders, handover, and warranty purposes.',
    ],
];

$consultingPoints = [
    'Bathroom, balcony, basement and podium waterproofing advice',
    'Liquid-applied and sheet membrane system recommendations',
    'Defect investigation and remedial waterproofing strategies',
    'Builder and contractor training on best-practice installation',
    'Coordination with engineers, certifiers and project managers',
];
?>
<style>
.cws-consulting-page { padding: 50px 0 70px; background: #fff; }
.cws-consulting-page .page-script-title {
  font-family: "Brush Script MT", "Segoe Script", cursive;
  color: #f9a71f;
  font-size: 42px;
  line-height: 1.2;
  margin: 0 0 28px;
  text-align: center;
}
.cws-consulting-page .page-main-title {
  text-align: center;
  font-size: 30px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #222;
  margin: 0 0 18px;
}
.cws-consulting-page .page-intro {
  max-width: 920px;
  margin: 0 auto 40px;
  text-align: center;
  color: #666;
  font-size: 16px;
  line-height: 1.75;
}
.cws-consulting-page .page-cards-row {
  display: flex;
  flex-wrap: wrap;
}
.cws-consulting-page .page-cards-row > [class*="col-"] {
  display: flex;
  flex-direction: column;
  margin-bottom: 24px;
}
.cws-consulting-page .info-card {
  background: #1f1f1f;
  border-radius: 4px;
  text-align: center;
  padding: 36px 22px 30px;
  height: 100%;
  min-height: 300px;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}
.cws-consulting-page .info-card-icon {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: #2a2a2a;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}
.cws-consulting-page .info-card-icon i { color: #f9a71f; font-size: 30px; }
.cws-consulting-page .info-card h3 {
  color: #fff;
  font-size: 20px;
  font-weight: 700;
  margin: 0 0 14px;
}
.cws-consulting-page .info-card p {
  color: #d5d5d5;
  font-size: 15px;
  line-height: 1.65;
  margin: 0;
  flex: 1;
}
.cws-consulting-page .points-box {
  background: #f7f9fb;
  border-left: 4px solid #007bc1;
  padding: 28px 32px;
  margin: 20px 0 40px;
}
.cws-consulting-page .points-box h3 {
  color: #007bc1;
  font-size: 22px;
  font-weight: 700;
  margin: 0 0 16px;
}
.cws-consulting-page .points-box ul {
  margin: 0;
  padding-left: 20px;
  color: #444;
  font-size: 15px;
  line-height: 1.9;
}
.cws-consulting-page .page-cta {
  text-align: center;
  margin-top: 10px;
}
.cws-consulting-page .page-cta .btn-contact {
  display: inline-block;
  background: #f9a71f;
  color: #1a1a1a !important;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 14px 36px;
  border-radius: 30px;
  text-decoration: none !important;
  transition: background 0.25s ease;
}
.cws-consulting-page .page-cta .btn-contact:hover { background: #e89610; }
@media (max-width: 991px) {
  .cws-consulting-page .page-cards-row { display: block; }
  .cws-consulting-page .page-cards-row > [class*="col-"] { display: block; }
  .cws-consulting-page .info-card { min-height: 0; height: auto; margin-bottom: 16px; }
}
</style>

<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1><?= h($bannerTitle) ?></h1>
      <p><?= h($bannerSub) ?></p>
    </div>
  </div>
</section>

<section class="cws-consulting-page">
  <div class="container">
    <p class="page-script-title">Consulting</p>
    <h2 class="page-main-title">Professional Waterproofing Advice</h2>
    <p class="page-intro">
      CWS Australia provides practical consulting support for waterproofing design, product selection, compliance,
      and on-site problem solving. Our team combines national installation experience with deep product knowledge
      to help your project stay watertight, compliant, and on schedule.
    </p>

    <div class="row page-cards-row">
      <?php foreach ($consultingCards as $card) : ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-card wow fadeInUp" data-wow-duration="1.2s">
          <div class="info-card-icon">
            <i class="fa <?= h($card['icon']) ?>" aria-hidden="true"></i>
          </div>
          <h3><?= h($card['title']) ?></h3>
          <p><?= h($card['text']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="points-box wow fadeInUp" data-wow-duration="1.2s">
      <h3>How We Can Help Your Project</h3>
      <ul>
        <?php foreach ($consultingPoints as $point) : ?>
        <li><?= h($point) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="page-cta">
      <p style="color:#666; margin-bottom:18px;">Speak with our consultants about your next residential or commercial waterproofing project.</p>
      <a href="<?= $siteUrl ?>contact-us" class="btn-contact">Request A Consultation</a>
    </div>
  </div>
</section>
