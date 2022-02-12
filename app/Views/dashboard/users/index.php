<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Users<?= $this->endSection() ?>

<?= $this->section('bottomCss') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="page-title-box">
        <h4 class="page-title">Users</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </div>
</div>
<div class="col-md-12">
    <?= $this->include('layouts/includes/messages_dashboard') ?>
    <div class="form-group row">
        <div class="col-md-2">
            <select class="form-control" name="deleted" id="deleted">
                <?php foreach ($active_types as $active_type): ?>
                    <option value="<?= $active_type->value ?>"><?= $active_type->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" name="email_verified" id="email_verified">
                <?php foreach ($status_types as $status_type): ?>
                    <option value="<?= $status_type->value ?>"><?= $status_type->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" name="order_by" id="order_by">
                <?php foreach ($order_by_types as $order_by_type): ?>
                    <option value="<?= $order_by_type->value ?>"><?= $order_by_type->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input class="form-control" type="text" name="search" id="search" value="" placeholder="Search name, email">
            </div>
        </div>
        <div class="col-md-4">
            <button id="search-btn" class="btn btn-primary">Search</button>
            <button id="clear-search-btn" class="btn btn-primary ml-2">Clear Search</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h6>Users</h6>
                <a class="ml-auto" href="<?= base_url('dashboard/users/create') ?>"><button class="btn btn-primary">Add User</button></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Regsitered At</th>
                            <th class="text-center">Email Verified</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($users)): ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <th scope="row"><?= $user->id ?></th>
                                <td><?= $user->name ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->phone ?></td>
                                <td><?= formatDate($user->created_at) ?></td>
                                <td class="text-center"><?= $user->email_verified == 0 ? '<span style="font-size: 12px;" class="badge badge-pill badge-warning">No</span>' : '<span style="font-size: 12px;" class="badge badge-pill badge-success">Yes</span>' ?></td>
                                <td class="text-center">
                                    <a class="ml-auto" data-toggle="tooltip" title="Edit" href="<?= base_url('dashboard/users/edit/' . $user->id)  ?>">
                                        <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                                    </a>
                                    <?php if($user->deleted_at): ?>
                                    <a class="ml-auto" data-toggle="tooltip" title="Undo Delete" href="<?= base_url('dashboard/users/enable/' . $user->id)  ?>">
                                        <button class="btn btn-warning"><i class="fas fa-undo-alt"></i></button>
                                    </a>
                                    <button class="btn btn-danger ml-auto delete-btn" data-toggle="tooltip" title="Permanent Delete" data-id="<?= $user->id ?>" data-type="permanent"><i class="fas fa-times-circle"></i></button>
                                    <?php else: ?>
                                        <button class="btn btn-danger ml-auto delete-btn" data-toggle="tooltip" title="Delete" data-id="<?= $user->id ?>"><i class="fa fa-trash"></i></button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center" colspan="7">No Data Available</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                <div>
                    <p class="p-1">Showing <?= $showing_records ?> of <?= $total_records ?> records</p>
                </div>
                <div class="ml-auto">
                    <?= $pager->links('default', 'bs_full') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete form -->
    <form id="delete-user-form" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="DELETE" />
        <input type="hidden" id="delete_id" name="id">
        <input type="hidden" id="delete_type" name="type">
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>

    $(document).ready(function() {
        var urlObject = new URL(window.location.href);
        if (urlObject.searchParams.has('deleted')) {
            $('#deleted').val(urlObject.searchParams.get('deleted'));
        }
        if (urlObject.searchParams.has('email_verified')) {
            $('#email_verified').val(urlObject.searchParams.get('email_verified'));
        }

        if (urlObject.searchParams.has('order_by')) {
            $('#order_by').val(urlObject.searchParams.get('order_by'));
        }

        if (urlObject.searchParams.has('search')) {
            $('#search').val(urlObject.searchParams.get('search'));
        }
    });

    $('.delete-btn').on('click', function() {
        if (!confirm('Are you sure !')) return;

        $('#delete-user-form').attr('action', '<?= base_url('dashboard/users') ?>')
        $('#delete_id').val($(this).data('id'));

        if ($(this).data('type')) {
            $('#delete_type').val($(this).data('type'));
        }
        
        $('#delete-user-form').submit();
    });

    $('#deleted').on('change', function () {
        var urlObject = new URL(window.location.href);
        urlObject.searchParams.set('deleted', $(this).val());
        window.location = urlObject.href;
    });

    $('#email_verified').on('change', function () {
        var urlObject = new URL(window.location.href);
        urlObject.searchParams.set('email_verified', $(this).val());
        window.location = urlObject.href;
    });

    $('#order_by').on('change', function () {
        var urlObject = new URL(window.location.href);
        urlObject.searchParams.set('order_by', $(this).val());
        window.location = urlObject.href;
    });

    $('#search-btn').on('click', function () {
        var urlObject = new URL(window.location.href);
        urlObject.searchParams.set('search', $('#search').val());
        window.location = urlObject.href;
    });

    $('#clear-search-btn').on('click', function () {
        $('#search').val('');
        $('#search-btn').trigger('click');
    })
    
</script>

<?= $this->endSection() ?>