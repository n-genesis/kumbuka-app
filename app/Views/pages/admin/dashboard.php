<!-- app/Views/pages/admin/dashboard.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>
<!-- Main Right Side Content Area -->
<main class="main-content py-4 px-2">
    <div class="container-fluid">
        <!-- Header Component -->
        <header>
            <!-- Breadcrumbs -->
            <?php if (!empty($breadcrumbHtml)): ?>
                <?= $breadcrumbHtml ?>
            <?php endif; ?>
            <h2 class="h5 mb-4 text-dark border-bottom pb-2"><?= $pageHeader ?></h2>
        </header>

        <div class="row">
            <!-- Backend Content -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Dashboard</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Total Users</h5>
                                            <p class="display-4"><?= $totalUsers ?></p>
                                            <a href="<?= site_url('admin/users') ?>" class="btn btn-primary">Users Managment</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Active Users</h5>
                                            <p class="display-4"><?= $activeUsers ?></p>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: <?= ($activeUsers / max(1, $totalUsers)) * 100 ?>%"
                                                    aria-valuenow="<?= ($activeUsers / max(1, $totalUsers)) * 100 ?>"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Inactive Users</h5>
                                            <p class="display-4"><?= $inactiveUsers ?></p>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: <?= ($inactiveUsers / max(1, $totalUsers)) * 100 ?>%"
                                                    aria-valuenow="<?= ($inactiveUsers / max(1, $totalUsers)) * 100 ?>"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Quick Actions</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="list-group">
                                                <a href="<?= site_url('admin/users/create') ?>"
                                                    class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1">Create New User</h5>
                                                        <i class="bi bi-person-plus"></i>
                                                    </div>
                                                    <p class="mb-1">Add a new user to the system with specific
                                                        roles.</p>
                                                </a>
                                                <a href="<?= site_url('admin/users') ?>"
                                                    class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1">Manage Users</h5>
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                    <p class="mb-1">View, edit, or delete existing users.</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">System Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    CodeIgniter Version
                                                    <span
                                                        class="badge bg-primary rounded-pill"><?= \CodeIgniter\CodeIgniter::CI_VERSION ?></span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    PHP Version
                                                    <span class="badge bg-primary rounded-pill"><?= phpversion() ?></span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Environment
                                                    <span class="badge bg-primary rounded-pill"><?= ENVIRONMENT ?></span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Server
                                                    <span
                                                        class="badge bg-primary rounded-pill"><?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- END Backend Content-->
        </div>
    </div>
</main>

 
<?= $this->endSection(); ?>