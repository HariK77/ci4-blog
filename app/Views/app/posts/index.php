<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Posts<?= $this->endSection() ?>

<?= $this->section('bottomCss') ?>
<style>
    .posts .card-body {
        padding: 0 !important;
    }

    .posts .card-title {
        margin-bottom: 0 !important;
        padding-left: 20px;
        font-size: large;
    }

    .posts .card-text {
        margin: 0 !important;
        padding-left: 20px;
        padding-top: 5px;
        font-size: 16px;
    }

    .text-muted {
        font-size: small;
    }

    .center-h-v {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<!-- <header class="masthead" style="background-image: url('<?= base_url('/app/img/home-bg.jpg') ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Posts</h1>
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
            <div class="mt-2 mb-2 d-flex">
                <h5>Your Posts</h5>
                <a class="ms-auto" href="<?= base_url('posts/create') ?>"><button data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></button></a>
            </div>
            <div class="posts">
                <?php foreach($posts as $post): ?>
                <div class="card mb-3">
                    <div class="row g-0 p-3">
                        <div class="col-md-2 mt-auto mb-auto">
                            <img src="<?= base_url($post->header_image) ?>" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body pl-2">
                                <h5 class="card-title"><?= $post->title ?></h5>
                                <p class="card-text"><?= $post->mini_title ?></p>
                                <p class="card-text"><small class="text-muted"><?= time_elapsed_string($post->created_at) ?></small> <small class="ms-3 text-muted"><?= $post->category ?></small></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex h-100 justify-content-center align-items-center">
                                <button data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
                                <button data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>