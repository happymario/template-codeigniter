<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<html lang="en">
<head>
    <head>
        <meta charset="utf-8"/>
        <title><?=t('site_name')?></title>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/css/components.css" rel="stylesheet" id="style_components"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-sweetalert/sweetalert.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet"
              type="text/css" id="style_color"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/layouts/layout/css/layout.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/layouts/layout/css/custom.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2-bootstrap.min.css"
              rel="stylesheet"
              type="text/css"/>
        <link href="<?= base_url() ?>assets/metronic/global/plugins/icheck/skins/all.css" rel="stylesheet"
              type="text/css"/>

        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/common/js/jquery.form.js" type="text/javascript"></script>

        <link href="<?= base_url() ?>assets/admin/img/logo.png" rel="icon">
        <link href="<?= base_url() ?>assets/admin/css/custom.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>assets/admin/js/ajaxupload.3.6.js" type="text/javascript"></script>
    </head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white  page-sidebar-fixed" id="total_body">
<div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <div class="page-logo" style="margin-top: -9px;">
                <a href="<?= site_url('Home') ?>">
<!--                <img src="--><?//= base_url() ?><!--assets/images/ic_logo.png" style="width: 30px;height: 30px;" alt=""-->
<!--                     class="logo-default"/>-->
                    <h3 style="color: white;margin-top: 20px;"><b><?=t('site_name')?> <?=VERSION?></b></h3>
                </a>
            </div>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <div class="top-menu" style="clear: none">
                <ul class="nav navbar-nav pull-right">
<!--                    <li class="dropdown dropdown-extended dropdown-notification open" id="header_notification_bar">-->
<!--                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"-->
<!--                           data-close-others="true" aria-expanded="true">-->
<!--                            <i class="icon-bell"></i>-->
<!--                            <span class="badge badge-default"> 7 </span>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li class="external">-->
<!--                                <h3><span class="bold">12 pending</span> notifications</h3>-->
<!--                                <a href="--><?//= site_url('User') ?><!--">view all</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <span class="username username-hide-on-mobile">  <?=t('manager')?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a onclick="ShowManagerSettingDialog()">
                                    <i class="icon-user"></i> <?=t('setting')?>  </a>
                            </li>
                            <li>
                                <a href="<?= site_url('login/logout') ?>">
                                    <i class="icon-key"></i> <?=t('logout')?>  </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="page-container">
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="200">
                    <li class="nav-item <?= !empty($menu) && $menu == MENU_USER ? 'active open' : '' ?>">
                        <a href="<?= site_url('User') ?>" class="nav-link nav-toggle">
                            <i class="fa fa-genderless"></i>
                            <span class="title"><?=t('menu_users') ?></span>
                            <span class=""></span>
                        </a>
                    </li>
                    <li class="nav-item <?= !empty($menu) && $menu == MENU_PHOTO_CHECK ? 'active open' : '' ?>">
                        <a href="<?= site_url('User/photo_list') ?>" class="nav-link nav-toggle">
                            <i class="fa fa-genderless"></i>
                            <span class="title"><?=t('menu_photo_check') ?></span>
                            <span class=""></span>
                        </a>
                    </li>
                    <li class="nav-item <?= !empty($menu) && $menu == MENU_NOTIFICATION ? 'active open' : '' ?>">
                        <a href="<?= site_url('push') ?>" class="nav-link nav-toggle">
                            <i class="fa fa-genderless"></i>
                            <span class="title"><?=t('menu_notifications') ?></span>
                            <span class=""></span>
                        </a>
                    </li>
                    <li class="nav-item" id="left_menu_apimanage_parent">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-genderless"></i>
                            <span class="title"><?=t('menu_api') ?></span>
                            <span class=""></span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="<?= site_url('apiManage/apimanage') ?>" class="nav-link ">
                                    <span class="title"><?=t('menu_api_list') ?></span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="<?= site_url('apiManage/apidocument') ?>" class="nav-link ">
                                    <span class="title"><?=t('menu_api_doc') ?></span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="<?= site_url('apiManage/apierrors') ?>" class="nav-link ">
                                    <span class="title"><?=t('menu_api_code') ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <i class="fa fa-circle" style="color: #92d050"></i>
                        <span id="page_title"
                              style="font-weight: 700;font-size: 15px;color:#92d050"><?= $page_title ?? '' ?></span>
                    </ul>

                    <a class="btn btn-sm btn-danger pull-right hidden" id="btn_top_menu_back" onclick="history.go(-1)"
                       style="margin-top: 7px;border-radius: 5px !important;">&nbsp;뒤&nbsp;로&nbsp;</a>
                </div>
                