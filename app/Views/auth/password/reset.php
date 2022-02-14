<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Reset Password<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<!-- <header class="masthead" style="background-image: url('<?= base_url('/app/img/home-bg.jpg') ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Sign In</h1>
                </div>
            </div>
        </div>
    </div>
</header> -->
<div style="padding-top: 5.4rem;"></div>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p> -->
                <div class="my-5">
                    <form id="sign-in-form" action="<?= base_url('password/reset') ?>" method="POST">
                        <?= csrf_field() ?>
                        <?= $this->include('layouts/includes/messages') ?>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'email') ?>" id="email" name="email" type="email" disabled placeholder="Enter your email..." value="<?= $user->email ?>"/>
                            <label for="email">Email address</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'email') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'password') ?>" id="password" name="password" value="" type="password" placeholder="Enter your password" />
                            <label for="phone">New Password</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'password') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'confirm_password') ?>" id="confirm_password" name="confirm_password" value="" type="password" placeholder="Confirm your password" />
                            <label for="phone">Confirm password</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'confirm_password') ?></div>
                        </div>
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <!-- Submit Button-->
                        <div class="my-3">
                            <button class="btn btn-primary text-uppercase" id="submit-btn" type="submit">Reset Password</button>
                        </div>
                        
                    </form>
                </div>
                <div>
                    <p>Remember your password? <a href="<?= base_url('sign-in') ?>">Sign in here</a> </p>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>