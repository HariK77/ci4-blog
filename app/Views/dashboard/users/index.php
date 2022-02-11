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
    <div>

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
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <th scope="row"><?= $user->id ?></th>
                                <td><?= $user->name ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->phone ?></td>
                                <td><?= formatDate($user->created_at) ?></td>
                                <td class="text-center"><?= $user->email_verified == 0 ? '<span class="badge badge-pill badge-warning">No</span>' : '<span class="badge badge-pill badge-success">Yes</span>' ?></td>
                                <td class="text-center">
                                    <a class="ml-auto" href="<?= base_url('dashboard/users/edit/' . $user->id)  ?>">
                                        <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                                    </a>
                                    <button class="btn btn-danger ml-auto delete-btn" data-id="<?= $user->id ?>"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                <div>
                    <p class="p-1">Showing <?= $per_page ?> of <?= $total_records ?> records</p>
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
        <input type="hidden" id="delete_id" name="id" value="">
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).ready(function() {

    });

    $('.delete-btn').on('click', function() {
        if (!confirm('Are you sure !')) return;
        $('#delete-user-form').attr('action', '<?= base_url('dashboard/users') ?>')
        $('#delete_id').val($(this).data('id'));
        $('#delete-user-form').submit();
    });
</script>

<?= $this->endSection() ?>