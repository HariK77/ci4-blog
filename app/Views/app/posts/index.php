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
        <?= $this->include('layouts/includes/messages') ?>
            <div class="mt-2 mb-2 d-flex">
                <h5>Your Posts</h5>
                <a class="ms-auto" href="<?= base_url('posts/create') ?>"><button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Add Post"><i class="fa fa-plus"></i></button></a>
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
                                <p class="card-text"><?= $post->sub_title ?></p>
                                <p class="card-text">
                                    <small class="text-muted"><?= $post->category ?></small>
                                    <small class="ms-3 text-muted">Created On: <?= formatDate($post->created_at, 1) ?></small>
                                    <small class="ms-3 text-muted">Last Updated: <?= formatDate($post->updated_at, 1) ?></small>
                                    <?php if($post->deleted_at): ?>
                                    <small class="ms-3 text-muted">Deleted On: <?= formatDate($post->deleted_at, 1) ?></small>
                                    <?php endif ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex h-100 justify-content-center align-items-center">
                                <a href="<?= base_url($post->slug) ?>" target="_blank"><button data-bs-toggle="tooltip" title="Show" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button></a>&nbsp;&nbsp;
                                <a href="<?= base_url('posts/edit/'.$post->id) ?>"><button data-bs-toggle="tooltip" title="Edit" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a>&nbsp;&nbsp;
                                <?php if($post->deleted_at): ?>
                                    <a class="ml-auto" data-toggle="tooltip" title="Undo Delete" href="<?= base_url('posts/undo-delete/' . $post->id)  ?>">
                                        <button data-bs-toggle="tooltip" title="Undo Delete" class="btn btn-sm btn-warning"><i class="fas fa-undo-alt"></i></button>
                                    </a>
                                    &nbsp;&nbsp;
                                    <button class="btn btn-sm btn-danger ml-auto delete-btn" data-toggle="tooltip" title="Permanent Delete" data-id="<?= $post->id ?>" data-type="permanent"><i class="fas fa-times-circle"></i></button>
                                <?php else: ?>
                                    <button data-bs-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete-btn" data-id="<?= $post->id ?>"><i class="fa fa-trash"></i></button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Delete form -->
    <form id="delete-post-form" action="<?= base_url('posts') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="DELETE" />
        <input type="hidden" id="delete_id" name="id">
        <input type="hidden" id="delete_type" name="type">
    </form>
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>

    window.addEventListener('DOMContentLoaded', () => {
        const deleteBtns = document.querySelectorAll('.delete-btn');
        const form = document.getElementById('delete-post-form');
        const id = document.getElementById('delete_id');
        const type = document.getElementById('delete_type');

        for (const deleteBtn of deleteBtns) {

            deleteBtn.addEventListener('click', () => {
                deleteBtn.disabled = true;
                if (!confirm('Are you sure !')) {
                    deleteBtn.disabled = false;
                    return
                };

                id.value = deleteBtn.getAttribute('data-id');

                if (deleteBtn.getAttribute('data-type')) {
                    type.value = deleteBtn.getAttribute('data-type')
                }

                form.submit();
            });
        }
    });

</script>

<?= $this->endSection() ?>