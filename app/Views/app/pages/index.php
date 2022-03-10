<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Home<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('<?= base_url('/app/img/home-bg.jpg') ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1><?= getenv('app.name'); ?></h1>
                    <span class="subheading">Multiverse of Blog Posts</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <?php foreach($posts as $post): ?>
            <!-- Post preview-->
            <div class="post-preview">
                <a href="<?= base_url($post->slug) ?>">
                    <h2 class="post-title"><?= $post->title ?></h2>
                    <h3 class="post-subtitle"><?= $post->mini_title ?></h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!"><?= $post->name ?></a>
                    on <?= formatDate($post->created_at, 1) ?>
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
            <?php endforeach; ?>
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>