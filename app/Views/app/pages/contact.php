<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Contact<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('<?= base_url('/app/img/home-bg.jpg') ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Contact</h1>
                    <!-- <span class="subheading">A Blog Theme by Start Bootstrap</span> -->
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
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                <div class="my-5">
                    <form id="contact-form" action="<?= base_url('contact') ?>" method="POST">
                        <?= csrf_field() ?>
                        <?= $this->include('layouts/includes/messages') ?>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'name') ?>" id="name" name="name" type="text" placeholder="Enter your name..." />
                            <label for="name">Name</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'name') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'email') ?>" id="email" name="email" type="email" placeholder="Enter your email..." />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'email') ?></div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control <?= getErrorClass($validation, 'phone') ?>" id="phone" name="phone" type="tel" placeholder="Enter your phone number..." />
                            <label for="phone">Phone Number</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'phone') ?></div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control <?= getErrorClass($validation, 'message') ?>" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback"><?= getErrorMessage($validation, 'message') ?></div>
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
                        <button class="btn btn-primary text-uppercase" id="submit-btn" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>