<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<!-- <header class="masthead" style="background-image: url('<?= base_url('/app/img/home-bg.jpg') ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Profile</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header> -->
<div style="padding-top: 5.4rem;"></div>
<!-- Main Content-->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <a href="javascript:void(0)" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap" />
                    </svg>
                    <span class="fs-4">Hi, <?= session('name') ?></span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('/profile') ?>" class="nav-link active" aria-current="page">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#home" />
                            </svg>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/auth/change-password') ?>" class="nav-link">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2" />
                            </svg>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/profile/posts') ?>" class="nav-link">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#table" />
                            </svg>
                            Posts
                        </a>
                    </li>
                </ul>
                <!-- <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
        <div class="col-md-9">
            Profile
        </div>
    </div>
</div>

<?= $this->endSection() ?>