<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Posts<?= $this->endSection() ?>

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
        <h4 class="page-title">Posts</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Posts</li>
        </ol>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h5>Posts</h5>
                <button data-toggle="modal" data-target="#modal" class="btn btn-primary ml-auto" id="add-form">Add Post</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                </table>
            </div>
        </div>
    </div>
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="modalLabel">Add Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="" id="name">
                            <div class="invalid-feedback">Test Message</div>
                        </div>
                        <input type="hidden" name="post_id" value="" id="post_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" id="save-btn">Add</button>
                </div>
            </div>
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
    var postsTable = '';
    $(document).ready(function() {
        // $("#datatable").DataTable({
        //     lengthChange: !1,
        //     buttons: ["copy", "excel", "pdf", "colvis"]
        // }).buttons().container().appendTo("#datatable_wrapper .col-md-6:eq(0)")

        postsTable = $('#datatable').DataTable({
            length: 10,
            processing: true,
            serverSide: true,
            // cache: false,
            // destroy: true,
            // order: [0],
            // searching: false,
            // ordering: false,
            // info: false,
            // lengthChange: false,
            lengthChange: !1,
            buttons: ["copy", "excel", "pdf", "colvis"],
            columns: [
                {
                    title: 'Id',
                    data: 'id'
                },
                {
                    title: 'User',
                    data: 'id_user'
                },
                {
                    title: 'Category',
                    data: 'id_category'
                },
                {
                    title: 'Title',
                    data: 'title'
                },
                {
                    title: 'Sub Title',
                    data: 'sub_title'
                },
                {
                    title: 'Url',
                    data: 'slug',
                    render: (data, type, row) => {
                        return `show`;
                    }
                },
                {
                    title: 'Post Content',
                    data: 'post_content',
                    render: (data, type, row) => {
                        return `show`;
                    }
                },
                {
                    title: 'Header Image',
                    data: 'header_image',
                    render: (data, type, row) => {
                        return `<img class="" src="<?= base_url() ?>/${data}" alt="${data} image" height="100px" />`;
                    }
                },
                {
                    title: 'Created At',
                    data: 'created_at'
                },
                {
                    title: 'Updated At',
                    data: 'updated_at'
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
                url: '<?= base_url('dashboard/posts/get') ?>',
                type: 'POST',
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                // success: function (response) {
                //     console.log(response);
                //     return data;
                // }
            },
            columnDefs: [
                {
                    orderable: false,
                    targets: [2]
                },
                {
                    searchable: false,
                    targets: [0, 2]
                }
            ],
            language: {
                info: "Showing page _PAGE_ of _PAGES_",
                infoFiltered: "",
                // emptyTable: "No data available in table",
                // info: "Showing _START_ to _END_ of _TOTAL_ entries",
                // infoEmpty: "No entries found",
                // infoFiltered: "(filtered1 from _MAX_ total entries)",
                // lengthMenu: "Show _MENU_ entries",
                // search: "Search",
                // zeroRecords: "No matching records found",
                // searc: "_INPUT_",
                // searchPlaceholde: "Search from below results.",
                // paginate: {
                //     previous: "Prev",
                //     next: "Next",
                //     last: "Last",
                //     first: "First"
                // }
            },
            initComplete: function (Settings, json) {
                
            },
            fnDrawCallback: function (oSettings) {
                console.log(oSettings);
            },

        });
    });

    $('#save-btn').on('click', function() {
        let params = {
            name: $('#name').val(),
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }

        let url = '<?= base_url('/dashboard/categories') ?>';

        if ($('#category_id').val()) {
            url = '<?= base_url('/dashboard/categories') ?>/' + $('#category_id').val();
            params._method = 'PATCH';
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: params,
            dataType: 'json',
            beforeSend: function() {
                $('.is-invalid').remove();
                $("#save-btn").prop('disabled', true);
                $("#save-btn").text('Sending..');
            },
            success: function(response) {
                updateSubmitBtnText();
                $('#modal').modal('toggle');
                $('#name').val('');
                $('#datatable').dataTable().fnDraw(false);
            },
            error: function(response) {
                let errors = response.responseJSON.messages.errors;
                updateSubmitBtnText();
                for (let error in errors) {
                    let element = document.getElementById(error);
                    element.classList.add('is-invalid');
                    element.nextElementSibling.innerHTML = errors[error];
                }
                Array.from(document.querySelectorAll('.is-invalid')).forEach(errorElement => {
                    errorElement.addEventListener('change', e => e.target.classList.remove('is-invalid'));
                })
            }
        });

    })

    $(document).on('click', '.edit-category', function() {

        let categoryId = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: '<?= base_url('/dashboard/categories') ?>/' + categoryId,
            dataType: 'json',
            success: function(response) {
                $("#save-btn").text('Update');
                $('#modalLabel').text('Update Category');
                $('#name').val(response.data.name);
                $('#category_id').val(response.data.id);
                $('#modal').modal('toggle');
            },
            error: function(response) {
                alert('some error happened');
            }
        });
    });

    $(document).on('click', '.delete-category', function() {

        if (!confirm('Are you sure !')) return;

        let categoryId = $(this).data('id');
        let params = {
            category_id: categoryId,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            _method: 'DELETE'
        }

        $.ajax({
            type: 'POST',
            url: '<?= base_url('/dashboard/categories') ?>/' + categoryId,
            dataType: 'json',
            data: params,
            success: function(response) {
                $('#datatable').dataTable().fnDraw(false);
            },
            error: function(response) {
                alert('some error happened');
            }
        });
    });

    $('#modal').on('hidden.bs.modal', function(e) {
        $('#name').val('');
        $('#category_id').val();
        $("#save-btn").text('Add');
        $('#modalLabel').text('Add Category');
        $('.is-invalid').removeClass('is-invalid');
    });

    function updateSubmitBtnText() {
        $("#save-btn").prop('disabled', false);

        if ($('#category_id').val()) {
            $("#save-btn").text('Update');
        } else {
            $("#save-btn").text('Add');
        }
    }
</script>

<?= $this->endSection() ?>