<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$siteName = defined('SITENAME') ? SITENAME : 'CWS Australia';
$userName = $this->request->getSession()->read('User.name') ?? 'Admin';
?>
<div id="navbar" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'dashboard']) ?>" class="navbar-brand">
                <small><i class="fa fa-dashboard"></i> <?= h($siteName) ?> Admin</small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li>
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'dashboard']) ?>">
                        <i class="ace-icon fa fa-tachometer"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= h($siteUrl) ?>" target="_blank">
                        <i class="ace-icon fa fa-external-link"></i> View Site
                    </a>
                </li>
                <li>
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'logout']) ?>">
                        <i class="ace-icon fa fa-sign-out"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
