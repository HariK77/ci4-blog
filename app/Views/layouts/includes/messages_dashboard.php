<?php if (session()->has('success')): ?>
    <div class="alert alert-success bg-success text-white" role="alert">
        <?= session('success'); ?>
    </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger bg-danger text-white mb-0" role="alert">
        <?= session('error'); ?>
    </div>
<?php endif; ?>