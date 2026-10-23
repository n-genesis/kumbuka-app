<!-- app/Views/pages/notebooks/shares/index.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('styles'); ?>
<style>
    /* Spacing & Custom Aesthetic Extensions */
    .border-defined {
        border: 1px solid rgba(108, 117, 125, 0.25) !important;
    }

    .hover-bg {
        transition: background-color 0.15s ease-in-out;
    }

    .hover-bg:hover {
        background-color: #f8f9fa;
    }

    /* Smooth framework focus ring tracking matching application forms */
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    /* Dynamic dropdown caret remover utility wrapper */
    .dropdown-toggle::after {
        display: none !important;
    }
</style>
<?php $this->endSection(); ?>

<?= $this->section('backend'); ?>

<!-- Main Right Side Content Area -->
<main class="main-content py-4 px-2">
    <div class="container-fluid">
        <div class="col-12">
            <!-- Header Component -->
            <header>
                <!-- Breadcrumbs -->
                <?php if (!empty($breadcrumbHtml)): ?>
                    <?= $breadcrumbHtml ?>
                <?php endif; ?>
            </header>

            <!-- Notebook Share User List Card -->
            <div class="card bg-white border-defined rounded-3 shadow-sm w-100 mx-auto">

                <!-- Card Header -->
                <div class="card-header bg-white pt-3 pb-2 px-4 border-bottom border-defined d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-people text-primary"></i> <?= $pageHeader ?>
                        </h4>
                        <span class="text-muted small" style="font-size: 0.72rem;"><?= count($notebook_shares) ?> members have access to this
                            notebook</span>
                    </div>
                    <!--  Invite Quick Action Button Trigger -->
                    <a href="<?= site_url("notebooks/$notebook->notebook_id/shares/new") ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-medium" style="font-size: 0.8rem;" onclick="openInviteModal()">
                        <i class="bi bi-person-plus-fill me-1"></i> Add User
                </a>
                </div>

                <!-- Search Field -->
                <div class="m-2">
                    <form action="<?= site_url('network/search') ?>" action="get">
                        <input type="text" class="form-control" name="query" placeholder="Find Friends..."  autocomplete="off">
                    </form>
                </div>

                <!-- Flush List Group Container with Island Border Items Matrix -->
                <div class="list-group list-group-flush px-3 py-2">

                    <!-- USER ENTRY -->
                    <?php if($notebook_shares):?>
                    <?php foreach ($notebook_shares as $share):?>
                    <div class="list-group-item border-defined rounded-3 my-1 p-3 d-flex align-items-center justify-content-between hover-bg">
                        <a href="<?= site_url("profile/$share->username") ?>" class="text-decoration-none">
                            <div class="d-flex align-items-center gap-3">
                                <div class="logo-wrapper border border-defined rounded-circle shadow-sm flex-shrink-0"
                                    style="width: 38px; height: 38px; overflow: hidden;">
                                    <img src="<?= base_url($share->avatar) ?>" alt="Sarah Jenkins Avatar"
                                        class="w-100 h-100 object-fit-cover">
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold text-dark small">
                                        <?= esc("$share->first_name $share->last_name") ?>
                                    </h6>
                                    <p class="text-muted mb-0" style="font-size: 0.75rem;"><?= $share->created_date ?></p>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex align-items-center gap-2">
                            <span
                                class="badge <?= $share->access_level == 'edit' ? 'bg-success-subtle text-success border-success-subtle': 'bg-light text-secondary' ?> border rounded-pill px-2.5 py-1 me-1"
                                style="font-size: 0.65rem; font-weight: 500;"><?= strtoupper($share->access_level) ?></span>
                            <!-- Inline Operational Management Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-1 border-0 dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-label="Manage permissions" style="box-shadow: none;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border border-defined shadow-sm">
                                    <li>
                                        <form action="<?= site_url("notebooks/$notebook->notebook_id/shares/$share->notebook_share_id/toggle") ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="dropdown-item py-2 bg-transparent border-0 w-100 text-start">
                                                <i class="bi bi-pencil me-2"></i>Change to <?= $share->access_level == 'edit' ? 'View': 'Editor' ?>
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider border-defined">
                                    </li>
                                    <li>
                                        <!-- Secure Method-Spoofed CodeIgniter Delete Action Form -->
                                        <form action="<?= site_url("notebooks/$notebook->notebook_id/shares/$share->notebook_share_id/delete") ?>" method="POST" onsubmit="return confirm('Revoke access for this user?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="dropdown-item py-2 text-danger bg-transparent border-0 w-100 text-start">
                                                <i class="bi bi-person-x me-2"></i>Remove Access
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                    <div class="my-2 mb-5">
                        <div class="alert alert-info d-flex align-items-center gap-2 mb-0" role="alert">
                            <i class="bi bi-info-circle-fill"></i>
                            <div class="small">No users have been granted access to this notebook yet.</div>
                        </div>
                    </div>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>