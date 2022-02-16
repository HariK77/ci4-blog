<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Add<?= $this->endSection() ?>

<?= $this->section('bottomCss') ?>
<style>
    .form-floating-select {
        color: #6c757d;
        padding: 1.25rem 0;
    }

    .form-floating-select select {
        border-left: 0;
        border-right: 0;
        border-top: 0;
        outline: none;
    }

    .form-floating-select:focus~label,
    .form-floating-select:not(:placeholder-shown)~label,
    .form-select~label {
        opacity: 0.65;
        transform: scale(0.65) translateY(-0.5rem) translateX(0rem);
    }

    /* .form-floating-select select:focus {
        box-shadow: none;
    } */

    .ck-editor__editable {
        min-height: 500px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div style="padding-top: 5.4rem;"></div>
<!-- Main Content-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mt-2">Add Post</h4>
            <?= $this->include('layouts/includes/messages') ?>
            <div class="row">
                <form action="<?= base_url('posts') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-floating-select">
                        <label for="category_id">Select Category</label>
                        <select class="form-select <?= getErrorClass($validation, 'title') ?>" id="category_id" name="category_id" type="select" placeholder="Select category...">
                            <option selected disabled value="">Choose...</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'title') ?></div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'title') ?>" id="title" name="title" type="text" placeholder="Enter your title..." />
                        <label for="title">Title</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'title') ?></div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'mini_title') ?>" id="mini_title" name="mini_title" type="mini_title" placeholder="Enter your mini title..." />
                        <label for="mini_title">Mini Title</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'mini_title') ?></div>
                    </div>
                    <div class="mt-4">
                        <label for="post_content" style="color: #6c757d;">Post Content</label>
                        <textarea class="form-control <?= getErrorClass($validation, 'post_content') ?>" id="post_content" name="post_content" placeholder="Enter your post content..."></textarea>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'post_content') ?></div>
                    </div>
                    <button class="btn btn-primary text-uppercase mt-3 mb-3" id="submit-btn" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        // tinymce.init({selector:'#post_content'});
        ClassicEditor
            .create(document.querySelector('#post_content'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

<?= $this->endSection() ?>