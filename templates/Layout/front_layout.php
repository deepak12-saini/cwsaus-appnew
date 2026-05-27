<?php
$siteUrl = defined('SITEURL') ? SITEURL : $this->Url->build('/', true);
$siteUrl = rtrim($siteUrl ?? '', '/') . '/';
$canonicalUrl = rtrim($this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]), '/');
$pageTitle = $this->fetch('title') ?: ($title_for_layout ?? 'CWS Australia');
$pageDesc = $this->fetch('meta_description') ?: 'CWS Australia – Professional waterproofing contracting, installation and supply across Sydney, Newcastle, Melbourne, Brisbane and nationwide.';
$pageKeywords = $this->fetch('meta_keywords') ?: 'waterproofing Sydney, construction waterproofing Australia, waterproofing contractor, membrane installation, CWS Australia';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <title><?= h($pageTitle) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= h($pageDesc) ?>">
    <meta name="keywords" content="<?= h($pageKeywords) ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="CWS Australia">
    <link rel="canonical" href="<?= h($canonicalUrl) ?>">
    <!-- Open Graph -->
    <meta property="og:title" content="<?= h($pageTitle) ?>">
    <meta property="og:description" content="<?= h($pageDesc) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= h($canonicalUrl) ?>">
    <meta property="og:image" content="<?= $siteUrl ?>front_theme/images/logo.png">
    <meta property="og:site_name" content="CWS Australia">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= h($pageTitle) ?>">
    <meta name="twitter:description" content="<?= h($pageDesc) ?>">
    <link rel="shortcut icon" type="image/icon" href="<?= $siteUrl ?>front_theme/images/logo.png"/>
    <link href="<?= $siteUrl ?>front_theme/css/font-awesome.css" rel="stylesheet">
    <link href="<?= $siteUrl ?>front_theme/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $siteUrl ?>front_theme/css/slick.css"/>
    <link rel="stylesheet" href="<?= $siteUrl ?>front_theme/css/animate.css"/>
    <link href="<?= $siteUrl ?>front_theme/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,200i,300,300i,400,400i,500,500i,600,600i,700,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<?= $this->element('front_header') ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?= $this->element('front_footer') ?>
<script src="<?= $siteUrl ?>front_theme/js/bootstrap.js"></script>
<script src="<?= $siteUrl ?>front_theme/js/slick.js"></script>
<script src="<?= $siteUrl ?>front_theme/js/custom.js?v=20260527b"></script>
<?= $this->fetch('script') ?>
</body>
</html>
