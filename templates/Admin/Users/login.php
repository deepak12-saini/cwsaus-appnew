<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$siteName = defined('SITENAME') ? SITENAME : 'CWS Australia';
?>
<div class="login-container">
    <div class="center">
        <h1>
            <img src="<?= $siteUrl ?>front_theme/images/logo.png" alt="<?= h($siteName) ?>" style="max-height: 60px;">
        </h1>
        <h4 class="blue" id="id-company-text">Admin Panel</h4>
    </div>

    <div class="space-6"></div>

    <div class="position-relative">
        <div id="login-box" class="login-box visible widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header blue lighter bigger">
                        <i class="ace-icon fa fa-coffee green"></i>
                        Please Enter Your Information
                    </h4>

                    <div class="space-6"></div>

                    <?= $this->Form->create(null, ['id' => 'loginForm']) ?>
                    <fieldset>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                <i class="ace-icon fa fa-user"></i>
                            </span>
                        </label>

                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <i class="ace-icon fa fa-lock"></i>
                            </span>
                        </label>

                        <div class="space"></div>

                        <div class="clearfix">
                            <?= $this->Form->button('Login', ['class' => 'width-35 pull-right btn btn-sm btn-primary']) ?>
                        </div>

                        <div class="space-4"></div>
                    </fieldset>
                    <?= $this->Form->end() ?>

                    <div class="toolbar clearfix" style="margin-top: 15px;">
                        <div>
                            <a href="<?= $this->Url->build('/') ?>" class="back-to-login-link">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Back to website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
