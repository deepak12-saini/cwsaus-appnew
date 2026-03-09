<?php
$siteUrl = defined('SITEURL') ? SITEURL : $this->Url->build('/', true);
$siteUrl = rtrim($siteUrl ?? '', '/') . '/';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title><?= $this->fetch('title') ?: ($title_for_layout ?? 'CWS Australia') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<script src="<?= $siteUrl ?>front_theme/js/custom.js"></script>
<?= $this->fetch('script') ?>
</body>
</html>
