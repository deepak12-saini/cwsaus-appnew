<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title><?= $title_for_layout ?? 'Admin' ?></title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/font-awesome.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/ace-fonts.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/ace-part2.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/ace-skins.css" class="ace-main-stylesheet" />
    <script src="<?= $siteUrl ?>theme/js/ace-extra.js"></script>
    <script src="<?= $siteUrl ?>theme/js/jquery.js"></script>
    <script src="<?= $siteUrl ?>theme/js/jquery.validate.js"></script>
    <script src="<?= $siteUrl ?>theme/js/jquery-ui.js"></script>
    <script src="<?= $siteUrl ?>theme/js/jquery.fancybox.js"></script>
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/jquery.fancybox.css" />
    <style>
    .ValidationErrors { color: #d00; display: inline-block; font-size: 12px; font-style: italic; padding-left: 10px; }
    .admin-form-spaced .form-group { margin-bottom: 20px; }
    .admin-form-spaced .form-group label { display: block; margin-bottom: 6px; font-weight: 500; }
    </style>
</head>
<body class="skin-1">
    <?= $this->element('admin_header') ?>
    <div class="main-container" id="main-container">
        <?= $this->element('admin_sidebar') ?>
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
        <?= $this->element('admin_footer') ?>
    </div>
    <script src="<?= $siteUrl ?>theme/js/bootstrap.js"></script>
    <script src="<?= $siteUrl ?>theme/js/jquery-ui.custom.js"></script>
    <script src="<?= $siteUrl ?>theme/js/ace/ace.js"></script>
    <script src="<?= $siteUrl ?>theme/js/ace/ace.sidebar.js"></script>
    <script src="<?= $siteUrl ?>theme/js/ace/ace.settings.js"></script>
</body>
</html>
