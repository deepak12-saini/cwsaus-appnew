<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title><?= $title_for_layout ?? 'Admin Login' ?></title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/font-awesome.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/ace-fonts.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/ace.css" />
    <link rel="stylesheet" href="<?= $siteUrl ?>theme/css/ace-skins.css" />
</head>
<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= $siteUrl ?>theme/js/jquery.js"></script>
    <script src="<?= $siteUrl ?>theme/js/bootstrap.js"></script>
</body>
</html>
