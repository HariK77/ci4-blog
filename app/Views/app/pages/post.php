<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Blog Title<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('<?= base_url($post->header_image) ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?= $post->title ?></h1>
                    <h2 class="subheading"><?= $post->mini_title ?></h2>
                    <span class="meta">
                        Posted by
                        <a href="#!"><?= $post->user ?></a>
                        on <?= formatDate($post->created_at, 1) ?>
                        <span class="ms-3 btn btn-primary btn-sm">
                            <?= $post->category ?>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <?= $post->post_content ?>
            </div>
        </div>
    </div>
</article>

<?= $this->endSection() ?>