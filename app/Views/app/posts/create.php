<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>Add Post<?= $this->endSection() ?>

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
                <form action="<?= base_url('posts') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-floating-select">
                        <label for="id_category">Select Category</label>
                        <select class="form-select <?= getErrorClass($validation, 'id_category') ?>" id="id_category" name="id_category" type="select" placeholder="Select category...">
                            <option selected disabled value="">Choose...</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'id_category') ?></div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'title') ?>" id="title" name="title" type="text" placeholder="Enter your title..." />
                        <label for="title">Title</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'title') ?></div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control <?= getErrorClass($validation, 'sub_title') ?>" id="sub_title" name="sub_title" type="text" placeholder="Enter your mini title..." />
                        <label for="sub_title">Mini Title</label>
                        <div class="invalid-feedback"><?= getErrorMessage($validation, 'sub_title') ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 py-5">
                            <div class="form-floating">
                                <input class="form-control <?= getErrorClass($validation, 'header_image') ?>" id="header_image" name="header_image"  onchange="readURL(this, 'preview_image');" accept='image/*' type="file" placeholder="Upload image" />
                                <label for="header_image">Header Image</label>
                                <div class="invalid-feedback"><?= getErrorMessage($validation, 'header_image') ?></div>
                            </div>
                        </div>
                        <div class="col-md-6 my-3">
                            <img src="<?= base_url('/app/img/no_image.png') ?>" id="preview_image" class="img-thumbnail" width="250px">
                        </div>
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

<script src="<?= base_url('app/js/ckeditor-5-32.js') ?>"></script>


<script>
    window.addEventListener('DOMContentLoaded', () => {
        // tinymce.init({selector:'#post_content'});
        ClassicEditor
            .create(document.querySelector('#post_content'))
            .then(editor => {
                // console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    });

    const readURL = (input, previewElement) => {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewElement).src = e.target.result
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>