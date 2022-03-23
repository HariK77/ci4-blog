<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>About<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('<?= base_url('/app/img/home-bg.jpg') ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>About</h1>
                    <span class="subheading">This is a simple blogging website.</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam pariatur nobis, ratione officia itaque veritatis vitae officiis atque ea provident mollitia vero, omnis eos sapiente totam eum amet? Ratione, necessitatibus.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum quasi quam obcaecati dignissimos, doloremque exercitationem vero aut inventore animi, voluptas quia? Aut, voluptates nostrum commodi quae reprehenderit consectetur nesciunt culpa!</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>