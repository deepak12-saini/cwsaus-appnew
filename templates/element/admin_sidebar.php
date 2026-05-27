<?php
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');
$role = $this->request->getSession()->read('User.role') ?? '';
?>
<div id="sidebar" class="sidebar responsive">
<ul class="nav nav-list">
    <li class="<?= ($controller === 'Users' && $action === 'dashboard') ? 'active' : '' ?>">
        <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'dashboard']) ?>">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> Dashboard </span>
        </a>
        <b class="arrow"></b>
    </li>
    <li class="<?= ($controller === 'Quicks' && $action === 'requestList') ? 'active' : '' ?>">
        <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Quicks', 'action' => 'requestList']) ?>">
            <i class="menu-icon fa fa-comment"></i>
            <span class="menu-text">Contact Us Request</span>
        </a>
    </li>
    <li class="<?= ($controller === 'Menus' && $action === 'index') ? 'active' : '' ?>">
        <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Menus', 'action' => 'index']) ?>">
            <i class="menu-icon fa fa-bars"></i>
            <span class="menu-text"> Pages </span>
        </a>
    </li>
    <li class="<?= ($controller === 'Galleries' && $action === 'index') ? 'active' : '' ?>">
        <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Galleries', 'action' => 'index']) ?>">
            <i class="menu-icon fa fa-image"></i>
            <span class="menu-text"> Gallery </span>
        </a>
    </li>
    <li class="<?= ($controller === 'Blogs' || $controller === 'Categories') ? 'active' : '' ?>">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-file"></i>
            <span class="menu-text"> Blogs </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="<?= ($controller === 'Categories' && $action === 'index') ? 'active' : '' ?>">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'index']) ?>">
                    <i class="menu-icon fa fa-file"></i>
                    Categories
                </a>
                <b class="arrow"></b>
            </li>
            <li class="<?= ($controller === 'Blogs' && $action === 'index') ? 'active' : '' ?>">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'index']) ?>">
                    <i class="menu-icon fa fa-file"></i>
                    Blog List
                </a>
                <b class="arrow"></b>
            </li>
            <li class="<?= ($controller === 'Blogs' && $action === 'add') ? 'active' : '' ?>">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'add']) ?>">
                    <i class="menu-icon fa fa-cog"></i>
                    Add Blog
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
    </li>
    <li class="<?= ($controller === 'Users' && in_array($action, ['profile', 'changePassword', 'websiteSetting'])) ? 'active' : '' ?>">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-cog"></i>
            <span class="menu-text"> Settings</span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="<?= ($controller === 'Users' && $action === 'profile') ? 'active' : '' ?>">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'profile']) ?>">
                    <i class="menu-icon fa fa-cog"></i>
                    Profile
                </a>
                <b class="arrow"></b>
            </li>
            <li class="<?= ($controller === 'Users' && $action === 'changePassword') ? 'active' : '' ?>">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'changePassword']) ?>">
                    <i class="menu-icon fa fa-cog"></i>
                    Change Password
                </a>
                <b class="arrow"></b>
            </li>
            <?php if ($role === 'S'): ?>
            <li class="<?= ($controller === 'Users' && $action === 'websiteSetting') ? 'active' : '' ?>">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'websiteSetting']) ?>">
                    <i class="menu-icon fa fa-cog"></i>
                    Website Setting
                </a>
                <b class="arrow"></b>
            </li>
            <?php endif; ?>
        </ul>
    </li>
</ul>
</div>
