<!DOCTYPE html>
<html lang="en">
<script>
    "use strict";
</script>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title><?= $this->renderSection('title') ?> - Admin <?= getenv('app.name'); ?></title>
    <meta content="<?= $this->renderSection('title') ?> - <?= getenv('app.name'); ?>" name="description">
    <?= csrf_meta() ?>
    <meta content="<?= getenv('app.name'); ?>" name="author">
    <link rel="shortcut icon" href="<?= base_url('dboard/favicon.ico') ?>">
    <?= $this->renderSection('topCss') ?>
    <link href="<?= base_url('dboard/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('dboard/css/metismenu.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('dboard/css/icons.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('dboard/css/style.css') ?>" rel="stylesheet" type="text/css">
    <?= $this->renderSection('bottomCss') ?>
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left"><a href="<?= base_url('dashboard') ?>" class="logo"><span><img src="<?= base_url('dboard/images/logo-light.png') ?>" alt="" height="18"> </span><i><img src="<?= base_url('dboard/images/logo-sm.png') ?>" alt="" height="22"></i></a></div>
            <nav class="navbar-custom">
                <ul class="navbar-right d-flex list-inline float-right mb-0">
                    <li class="dropdown notification-list">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url('dboard/images/users/user-4.jpg') ?>" alt="user" class="rounded-circle">
                                <?= session('name') ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                <a class="dropdown-item" href="<?= base_url('dashboard/profile') ?>"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a> 
                                <a class="dropdown-item" href="<?= base_url('dashboard/wallet') ?>"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a> 
                                <a class="dropdown-item d-block" href="<?= base_url('dashboard/settings') ?>"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a> 
                                <a class="dropdown-item" href="<?= base_url('dashboard/lockscreen') ?>"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?= base_url('sign-out') ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="list-inline menu-left mb-0">
                    <li class="float-left"><button class="button-menu-mobile open-left waves-effect"><i class="mdi mdi-menu"></i></button></li>
                </ul>
            </nav>
        </div><!-- Top Bar End -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <!-- <li class="menu-title">Main</li> -->
                        <li><a href="<?= base_url('dashboard') ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i>
                                <span>Dashboard</span></a></li>
                        <li><a href="<?= base_url('dashboard/categories') ?>" class="waves-effect"><i class="mdi mdi-book-multiple"></i><span>
                                    Categories</span></a></li>
                        <li class="<?= getActiveClass('dashboard/users/edit/*') ?>"><a href="javascript:void(0);" class="waves-effect <?= getActiveClass('dashboard/users/edit/*') ?>"><i class="mdi mdi-account-multiple"></i><span> Users <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
                                <li class="<?= getActiveClass('dashboard/users/edit/*') ?>">
                                    <a class="<?= getActiveClass('dashboard/users/edit/*') ?>" href="<?= base_url('dashboard/users') ?>">Users</a>
                                </li>
                                <li><a href="<?= base_url('dashboard/users/create') ?>">Create</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-library-books"></i><span> Posts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
                                <li><a href="<?= base_url('dashboard/posts') ?>">Posts</a></li>
                                <!-- <li><a href="<?= base_url('dashboard/posts/create') ?>">Create</a></li> -->
                            </ul>
                        </li>
                        <li><a href="<?= base_url('') ?>" class="waves-effect"><i class="mdi mdi-chevron-double-right"></i>
                                <span>Go To Blog</span></a></li>
                    </ul>
                </div><!-- Sidebar -->
                <div class="clearfix"></div>
            </div><!-- Sidebar -left -->
        </div><!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?= $this->renderSection('content') ?>
                    </div><!-- end row -->
                </div><!-- container-fluid -->
            </div><!-- content -->
            <footer class="footer">© <?= date('Y') ?> - All Rights Reserved. <span class="d-none d-sm-inline-block">Crafted with <i class="mdi mdi-heart text-danger"></i> by <?= getenv('app.name') ?></span>.</footer>
        </div><!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div><!-- END wrapper -->
    <!-- jQuery  -->
    <script src="<?= base_url('dboard/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('dboard/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('dboard/js/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('dboard/js/jquery.slimscroll.js') ?>"></script>
    <script src="<?= base_url('dboard/js/waves.min.js') ?>"></script>
    <script src="<?= base_url('dboard/plugins/jquery-sparkline/jquery.sparkline.min.js') ?>"></script><!-- App js -->
    <script src="<?= base_url('dboard/js/app.js') ?>"></script>

    <?= $this->renderSection('js') ?>
</body>

</html>