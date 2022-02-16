<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $this->renderSection('title') ?> - <?= getenv('app.name'); ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('app/favicon.ico') ?>" />
    <?= csrf_meta() ?>
    <meta name="base-url" content="<?= base_url() ?>">
    <?= $this->renderSection('topCss') ?>
    <!-- Font Awesome icons (free version)-->
    <script src="<?= base_url('app/js/all.js') ?>"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="<?= base_url('app/css/bootstrap-icons.css') ?>" />
    <link href="<?= base_url('app/css/styles.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('app/css/custom.css') ?>?<?= time() ?>" rel="stylesheet" />
    <?= $this->renderSection('bottomCss') ?>
</head>

<body class="d-flex flex-column h-100">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light is-fixed is-visible" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?= base_url('') ?>"><?= getenv('app.name'); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= base_url('about') ?>">About</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= base_url('contact') ?>">Contact</a></li>
                    <?php if(session('isLoggedIn')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-lg-3 py-3 py-lg-4 dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= session('name') ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (session('user_type') == 1): ?>
                            <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('posts') ?>">Posts</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('sign-out') ?>">Log Out</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= base_url('sign-in') ?>">Sign In</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= base_url('sign-up') ?>">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?= $this->renderSection('content') ?>
    <!-- Footer-->
    <footer class="border-top footer mt-auto py-3 bg-light">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="https://twitter.com" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://facebook.com" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/HariK77" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="small text-center text-muted fst-italic">Copyright &copy; <?= getenv('app.name'); ?> <?= date('Y') ?></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="<?= base_url('app/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url('app/js/app.js') ?>?<?= time() ?>"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script> -->
    <?= $this->renderSection('js') ?>
</body>

</html>