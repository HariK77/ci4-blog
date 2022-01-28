<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Categories<?= $this->endSection() ?>

<?= $this->section('topCss') ?>

<!-- DataTables -->
<link href="<?= base_url('/dboard/plugins/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?= base_url('/dboard/plugins/datatables/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css">
<!-- Responsive datatable examples -->
<link href="<?= base_url('/dboard/plugins/datatables/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="page-title-box">
        <h4 class="page-title">Categories</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Categories</li>
        </ol>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h5>Categories</h5>
                <button class="btn btn-primary ml-auto" id="add-form">Add Category</button>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<!-- Required datatable js -->
<script src="<?= base_url('/dboard/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<!-- Buttons examples -->
<script src="<?= base_url('/dboard/plugins/datatables/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/jszip.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/buttons.colVis.min.js') ?>"></script>
<!-- Responsive examples -->
<script src="<?= base_url('/dboard/plugins/datatables/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('/dboard/plugins/datatables/responsive.bootstrap4.min.js') ?>"></script>

<script>
    var categoriesTable = '';
    $(document).ready(function() {

        categoriesTable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            columns: [{
                    title: 'Id',
                    data: 'id'
                },
                {
                    title: 'Name',
                    data: 'name'
                },
                {
                    title: 'Actions',
                    data: 'id',
                    render: (data, type, row) => {
                        // console.log(data, type, row);
                        return `<button class="btn btn-success edit-category" data-id="${data}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger delete-category" data-id="${data}"><i class="fa fa-trash"></i></button>`;

                    }
                }
            ],
            ajax: {
                url: '<?= base_url('dashboard/categories/get') ?>',
                type: 'POST',
                data: {
                    csrf_token: document.querySelector('meta[name="X-CSRF-TOKEN"]').content
                },
            },
            length: 3,
        });

    });

    $(document).on('click', '.edit-category', function() {
        alert($(this).data('id'));
    });

    $(document).on('click', '.delete-category', function() {
        alert($(this).data('id'));
    });
</script>

<?= $this->endSection() ?>