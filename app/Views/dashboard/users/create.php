<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Add User<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="page-title-box">
        <h4 class="page-title">Add User</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
            <li class="breadcrumb-item active">Add User</li>
        </ol>
    </div>
</div>

<div class="col-md-12">
    <?= $this->include('layouts/includes/messages_dashboard') ?>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h6>Add User</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('dashboard/users') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Enter Name</label>
                    <div class="col-sm-6">
                        <input class="form-control <?= getErrorClass($validation, 'name') ?>" type="text" name="name" id="name" value="<?= old('name') ?>">
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'name') ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Enter Email</label>
                    <div class="col-sm-6">
                        <input class="form-control <?= getErrorClass($validation, 'email') ?>" type="email" name="email" id="email" value="<?= old('email') ?>">
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'email') ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Enter Phone</label>
                    <div class="col-sm-6">
                        <input class="form-control <?= getErrorClass($validation, 'phone') ?>" type="text" name="phone" id="phone" value="<?= old('phone') ?>">
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'phone') ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Enter Password</label>
                    <div class="col-sm-6">
                        <input class="form-control <?= getErrorClass($validation, 'password') ?>" type="password" name="password" id="password">
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'password') ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm_password" class="col-sm-2 col-form-label">Enter Password Confirmation</label>
                    <div class="col-sm-6">
                        <input class="form-control <?= getErrorClass($validation, 'confirm_password') ?>" type="password" name="confirm_password" id="confirm_password">
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'confirm_password') ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <button class="btn btn-primary float-right" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>