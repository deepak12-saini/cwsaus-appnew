<?php
/**
 * Consulting page
 * @var \Cake\ORM\Entity|null $menu
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
?>
<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1><?= h($menu && ($menu->banner_title ?? $menu->title) ? ($menu->banner_title ?? $menu->title) : 'Consulting') ?></h1>
      <p><?= h($menu->banner_sub_text ?? '') ?></p>
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
            <h2 class="title"><?= h($menu && ($menu->main_title ?? $menu->title) ? ($menu->main_title ?? $menu->title) : 'Consulting') ?></h2>
            <span class="line"></span>
            <p><?= ($menu && $menu->content) ? $this->Text->autoParagraph(h($menu->content)) : '' ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
