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
        <?= $this->include('layouts/includes/app_profile_sidebar') ?>
        <div class="col-md-9">
            <div class="my-5">
                <form id="sign-up-form" action="<?= base_url('profile') ?>" method="POST">
                    <?= csrf_field() ?>
                    <?= $this->include('layouts/includes/messages') ?>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'name') ?>" id="name" name="name" value="<?= old('name') ?? $user->name ?>" type="text" placeholder="Enter your name..." />
                        <label for="name">Name</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'name') ?></div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'email') ?>" id="email" name="email" value="<?= old('email') ?? $user->email ?>" type="email" placeholder="Enter your email..." />
                        <label for="email">Email address</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'email') ?></div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'phone') ?>" id="phone" name="phone" value="<?= old('phone') ?? $user->phone ?>" type="tel" placeholder="Enter your phone number..." />
                        <label for="phone">Phone number</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'phone') ?></div>
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary text-uppercase mt-4" id="update-btn" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>