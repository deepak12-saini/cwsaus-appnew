<?php
$quoteRequestCount = $quoteRequestCount ?? 0;
$blogsCount = $blogsCount ?? 0;
?>
<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'dashboard']) ?>">Home</a>
        </li>
        <li class="active">Dashboard</li>
    </ul>
</div>

<div class="page-header">
    <h1>
        Dashboard
        <small><i class="ace-icon fa fa-angle-double-right"></i> overview &amp; stats</small>
    </h1>
</div>

    <div class="row">
        <div class="col-xs-12">
            <div class="infobox-container">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Quicks', 'action' => 'requestList']) ?>" class="infobox infobox-blue">
                    <span class="infobox-icon">
                        <i class="ace-icon fa fa-comments"></i>
                    </span>
                    <div class="infobox-data">
                        <span class="infobox-data-number"><?= $this->Number->format($quoteRequestCount) ?></span>
                        <div class="infobox-content">Quote Requests</div>
                    </div>
                </a>
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'index']) ?>" class="infobox infobox-green">
                    <span class="infobox-icon">
                        <i class="ace-icon fa fa-file-text"></i>
                    </span>
                    <div class="infobox-data">
                        <span class="infobox-data-number"><?= $this->Number->format($blogsCount) ?></span>
                        <div class="infobox-content">Published Blogs</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title">Quick Links</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled">
                                    <li><i class="ace-icon fa fa-angle-right blue"></i> <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Quicks', 'action' => 'requestList']) ?>">Contact Us Requests</a></li>
                                    <li><i class="ace-icon fa fa-angle-right blue"></i> <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Menus', 'action' => 'index']) ?>">Manage Pages</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled">
                                    <li><i class="ace-icon fa fa-angle-right blue"></i> <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'index']) ?>">Blog List</a></li>
                                    <li><i class="ace-icon fa fa-angle-right blue"></i> <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Galleries', 'action' => 'index']) ?>">Gallery</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
