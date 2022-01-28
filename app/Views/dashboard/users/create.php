<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Add User<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="page-title-box">
        <h4 class="page-title">Add User</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">HariK</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
            <li class="breadcrumb-item active">Blank page</li>
        </ol>
        <div class="state-information d-none d-sm-block">
            <div class="state-graph">
                <div id="header-chart-1"></div>
                <div class="info">Balance $ 2,317</div>
            </div>
            <div class="state-graph">
                <div id="header-chart-2"></div>
                <div class="info">Item Sold 1230</div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>