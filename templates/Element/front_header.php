<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');
?>
<style>.tpsocialicns li a { font-size: 13px; }</style>
<header id="header" class="wow slideInDown" data-wow-duration="1.3s" data-wow-delay="0.0s">
  <div class="header-bottom">
    <div class="container">
      <div class="row">
        <ul class="tpsocialicns">
          <li><a href="<?= $siteUrl ?>">Newcastle</a></li>
          <li><a href="<?= $siteUrl ?>">Seven Hills</a></li>
          <li><a href="<?= $siteUrl ?>">Wollongong</a></li>
          <li><a href="<?= $siteUrl ?>">Melbourne</a></li>
          <li><a href="<?= $siteUrl ?>">Canberra</a></li>
          <li><a href="<?= $siteUrl ?>">Perth</a></li>
          <li><a href="<?= $siteUrl ?>">Queensland</a></li>
        </ul>
        <div class="col-xs-4 pull-right">
          <div class="header-contact">
            <ul>
              <li><div class="mail"><a href="mailto:<?= defined('EMAIL') ? h(EMAIL) : 'info@cwsaus.com.au' ?>"><i class="fa fa-envelope-o"></i> <?= defined('EMAIL') ? h(EMAIL) : 'info@cwsaus.com.au' ?></a></div></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section id="menu-area">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $siteUrl ?>"><img src="<?= $siteUrl ?>front_theme/images/logo.png" alt="logo"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul id="top-menu" class="nav navbar-nav navbar-right main-nav" style="margin-top: 13px;">
              <li class="<?= ($controller === 'Fronts' && $action === 'index') ? 'active' : '' ?>"><a href="<?= $siteUrl ?>">Home</a></li>
              <li class="<?= ($controller === 'Fronts' && $action === 'about') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/about') ?>">About Us</a></li>
              <li class="<?= ($controller === 'Fronts' && $action === 'products') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/products') ?>">Products</a></li>
              <li class="<?= ($controller === 'Fronts' && $action === 'suppliers') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/suppliers') ?>">Suppliers</a></li>
              <li class="<?= ($controller === 'Fronts' && $action === 'consulting') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/consulting') ?>">Consulting</a></li>
              <li class="<?= ($controller === 'Fronts' && $action === 'promotions') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/promotions') ?>">Promotions</a></li>
              <li class="<?= ($controller === 'Fronts' && $action === 'services') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/our-services') ?>">Our Service</a></li>
              <li class="<?= ($controller === 'Blogs') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/blog') ?>">Blog</a></li>
              <li class="<?= ($controller === 'Fronts' && $action === 'contact') ? 'active' : '' ?>"><a href="<?= $this->Url->build('/contact-us') ?>">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </section>
</header>
