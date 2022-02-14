<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Sign Up<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('<?= base_url('/app/img/home-bg.jpg') ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Sign Up</h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p> -->
                <div class="my-5">
                    <form id="sign-up-form" action="<?= base_url('sign-up') ?>" method="POST">
                        <?= csrf_field() ?>
                        <?= $this->include('layouts/includes/messages') ?>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'name') ?>" id="name" name="name" value="<?= old('name') ?>" type="text" placeholder="Enter your name..." autofocus />
                            <label for="name">Name</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'name') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'email') ?>" id="email" name="email" value="<?= old('email') ?>" type="email" placeholder="Enter your email..." />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'email') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'phone') ?>" id="phone" name="phone" value="<?= old('phone') ?>" type="tel" placeholder="Enter your phone number..." />
                            <label for="phone">Phone number</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'phone') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'password') ?>" id="password" name="password" value="" type="password" placeholder="Enter your password" />
                            <label for="phone">Password</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'password') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'confirm_password') ?>" id="confirm_password" name="confirm_password" value="" type="password" placeholder="Confirm your password" />
                            <label for="phone">Confirm password</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'confirm_password') ?></div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input  <?= getErrorClass($validation, 'terms') ?>" type="checkbox" name="terms" <?= old('terms') ? 'checked' : '' ?> id="terms">
                                <label class="form-check-label" for="terms">Accept Terms</label>
                                <div class="invalid-feedback">Confirm <?= getErrorMessage($validation, 'terms') ?></div>
                            </div>
                        </div>
                        <br />
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                            </div>
                        </div>
                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3">Error sending message!</div>
                        </div>
                        <!-- Submit Button-->
                        <button class="btn btn-primary text-uppercase" id="submit-btn" type="submit">Submit</button>
                    </form>
                </div>
                <div>
                    <p>Already have an account? <a href="<?= base_url('sign-in') ?>">Sign in here</a> </p>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>