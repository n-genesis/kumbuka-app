<!-- app/Views/pages/notebooks/shares/new.php -->
<?= $this->extend('layouts/backend'); ?>


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

            <!-- Notebook Permissions Access Management Card -->
            <div class="card shadow-sm rounded-3">
                
                <!-- Card Header -->
                <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-dark d-flex align-items-center">
                        <i class="bi bi-shield-lock-fill text-primary me-2"></i><?= $pageHeader ?>
                    </h4>
                    <span class="badge bg-primary-subtle text-primary rounded-pill fw-semibold px-2.5 py-1">Share Access</span>
                </div>

                <!-- Card Body Containing the Add User Form -->
                <div class="card-body p-4 bg-light">
                    <!-- Route target pointing to your CodeIgniter 4 access controller mapping -->
                    <form action="<?= site_url("notebooks/$notebook->notebook_id/shares/create") ?>" method="POST" autocomplete="off" class="mb-4">
                        <!-- CodeIgniter 4 Cross-Site Request Forgery Protection -->
                        <?= csrf_field() ?>

                        <div class="row g-3 align-items-end">
                            <!-- User Selector (Database Input query matching following) -->
                            <div class="col-md-5">
                                <label for="userSelect" class="form-label fw-bold text-dark small mb-1">Select Follower</label>
                                <select class="form-select form-select-md fw-semibold text-secondary shadow-sm" id="userSelect" name="user_id" required>
                                    <option value="" disabled selected>Choose a connection...</option>
                                    <!-- Dynamic template loop placeholder for follower accounts -->
                                    <?php if(!empty($following)): foreach($following as $user): ?>
                                        <option value="<?= $user->user_id ?>">@<?= esc($user->username) ?> (<?= esc("$user->first_name $user->last_name") ?>)</option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>

                            <!-- Access Permission Level -->
                            <div class="col-md-4">
                                <label id="accessLabel" for="accessRole" class="form-label fw-bold text-dark small mb-1">Access Role</label>
                                <select class="form-select form-select-md fw-semibold text-secondary shadow-sm" id="accessRole" name="access_level" aria-describedby="accessLabel" required>
                                    <option value="view" selected>Viewer (Read-only access)</option>
                                    <option value="edit">Edit (Can add notes)</option>
                                </select>
                            </div>

                            <!-- Action Confirmation Add Trigger -->
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-md w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-1.5" style="height: 41px;">
                                    <i class="bi bi-person-plus-fill"></i> Update Access
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- SUB-SECTION: ACTIVE ACCESS LISTING RECORD TRACKS -->
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-3 px-1">
                            <small class="text-uppercase fw-bold text-secondary tracking-wider" style="font-size: 0.75rem;">Users with Shared Access</small>
                            <hr class="flex-grow-1 ms-2 my-0 opacity-25">
                        </div>

                        <?php if(!empty($user_shares)): foreach($user_shares as $user): ?>
                        <!-- Access Record Member Row 1 -->
                        <div class="card border-0 shadow-sm rounded-3 mb-2">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex align-items-center min-w-0 flex-grow-1 me-2">
                                    <!-- Responsive avatar hides on smallest screens to maximize mobile real estate -->
                                    <div class="bg-primary text-white rounded-circle d-none d-md-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 38px; height: 38px;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h6 class="mb-0 fw-bold text-dark text-truncate"><?= esc("$user->first_name $user->last_name") ?></h6>
                                        <small class="text-muted d-block text-truncate d-none d-sm-block">@<?= esc($user->username) ?> &bull; Access granted <?= $user->created_date ?></small>
                                    </div>
                                </div>
                                <!-- Right-Aligned Context Controls Status Badge and Revoke Options Form -->
                                <div class="d-flex align-items-center gap-3 flex-shrink-0">
                                    <?php if($user->access_level == 'edit'):?>
                                    <span class="badge bg-success-subtle text-success rounded-pill fw-semibold small px-2.5 py-1">Access</span>
                                    <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill fw-semibold small px-2.5 py-1">Viewer</span>
                                    <?php endif ?>
                                    <form action="<?= site_url("notebooks/$notebook->notebook_id/shares/$user->notebook_share_id/delete") ?>" method="POST" onsubmit="return confirm('Revoke access for this user?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-link text-danger p-1 border-0" title="Revoke Permission">
                                            <i class="bi bi-x-circle-fill fs-5"></i>
                                        </button>
                                    </form>
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
    </div>
</main>

<?= $this->endSection(); ?>