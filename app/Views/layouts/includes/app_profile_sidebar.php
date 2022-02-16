<div class="col-md-3">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
        <a href="javascript:void(0)" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto profile-heading">
            <span class="fs-4">Hi, <?= session('name') ?></span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="<?= base_url('profile') ?>" class="nav-link">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('profile/change-password') ?>" class="nav-link">
                    Change Password
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('posts') ?>" class="nav-link">
                    Posts
                </a>
            </li>
        </ul>
        <!-- <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div> -->
    </div>
</div>