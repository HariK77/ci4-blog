<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Change Password<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->

<div style="padding-top: 5.4rem;"></div>
<!-- Main Content-->
<div class="container">
    <div class="row">
        <?= $this->include('layouts/includes/app_profile_sidebar') ?>
        <div class="col-md-9">
            <div class="my-5">
                <form id="sign-up-form" action="<?= base_url('profile/change-password') ?>" method="POST">
                    <?= csrf_field() ?>
                    <?= $this->include('layouts/includes/messages') ?>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'current_password') ?>" id="current_password" name="current_password" value="" type="password" placeholder="Enter your current password" />
                        <label for="phone">Current Password</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'current_password') ?></div>
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
                    <!-- Submit Button-->
                    <button class="btn btn-primary text-uppercase mt-4" id="update-btn" type="submit">Change</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>