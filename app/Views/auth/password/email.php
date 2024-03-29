<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Send Password Reset Email<?= $this->endSection() ?>

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
                    <form id="sign-in-form" action="<?= base_url('password/forgot') ?>" method="POST">
                        <?= csrf_field() ?>
                        <?= $this->include('layouts/includes/messages') ?>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'email') ?>" id="email" name="email" type="email" placeholder="Enter your email..." autofocus/>
                            <label for="email">Email address</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'email') ?></div>
                        </div>

                        <!-- Submit Button-->
                        <div class="my-3">
                            <button class="btn btn-primary text-uppercase" id="submit-btn" type="submit">Send Password Reset Email</button>
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