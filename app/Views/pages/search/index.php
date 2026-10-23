<!-- app/Views/pages/search/index.php -->
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
        </header>

        <!-- User Search Card Container -->
        <div class="card shadow-sm rounded-3">
            
            <!-- Card Header -->
            <div class="card-header border-0 border-bottom p-3">
                <h4 class="mb-0 d-flex align-items-center">
                    <i class="bi bi-search text-primary me-2"></i>User Search
                </h4>
            </div>

            <!-- Card Body Containing Search Form & Results -->
            <div class="card-body p-4">
                
                <!-- Search Input Form Block -->
                <form action="<?= base_url('network/search') ?>" method="GET" class="mb-4" autocomplete="off">
                    <div class="row g-2">
                        <div class="col-md-9 flex-grow-1">
                            <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" 
                                    class="form-control border-0 ps-2 py-2" 
                                    name="query" 
                                    id="userSearchQuery"
                                    placeholder="Search by email, name, or username..." 
                                    value="<?= esc($query ?? '') ?>"
                                    aria-label="Search developers"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-3 flex-shrink-0">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center" style="height: 41px;">
                                Search
                            </button>
                        </div>
                    </div>
                </form>

                <!-- SUB-SECTION: DYNAMIC SEARCH RESULTS -->
                <div>
                    <div class="d-flex align-items-center mb-3 px-1">
                        <small class="text-uppercase fw-bold text-secondary tracking-wider" style="font-size: 0.75rem;">Search Results</small>
                        <hr class="flex-grow-1 ms-2 my-0 opacity-25">
                    </div>

                    <!-- Flush List Group Container for Results Layout -->
                    <div class="list-group list-group-flush rounded-3 shadow-sm border" style="max-height: 380px; overflow-y: auto;">
                        <?php if($results): foreach($results as $user): ?>
                        <!-- Result Item 1 (Exact Match Case) -->
                        <div class="list-group-item p-3 w-100 d-flex align-items-center justify-content-between bg-white border-bottom">
                            <div class="d-flex align-items-center flex-grow-1 me-2">
                                <!-- Responsive User Avatar -->
                                <div class="bg-primary text-white rounded-circle d-none d-md-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                    <a href="<?= site_url("profile/$user->username") ?>" class="text-decoration-none">
                                        <img src="<?= base_url($user->avatar) ?>" class="img-fluid rounded-circle" alt="User avatar image" />
                                    </a>
                                </div>
                                <div>
                                    <a href="<?= site_url("profile/$user->username") ?>" class="text-decoration-none text-reset">
                                    <h6 class="mb-0 fw-bold text-dark text-truncate"><?= esc("$user->first_name $user->last_name") ?></h6>
                                    <small class="text-muted d-block text-truncate">@<?= esc($user->username) ?> &bull; <?= esc($user->email) ?></small>
                                    </a>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ps-2">
                                <!-- Show Follow/Unfollow Button based on the current follow status -->
                                <?php if ($followerModel->isFollowing(auth()->id(), $user->user_id)): ?>
                                    <form action="<?= base_url('follow/toggle/' . $user->user_id) ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="followed_id" value="<?= $user->user_id ?>">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill" style="border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                                            <i class="bi bi-person-check-fill me-1"></i>Following</button>
                                    </form>
                                <?php else: ?>
                                    <form action="<?= base_url('follow/toggle/' . $user->user_id) ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="followed_id" value="<?= $user->user_id ?>">
                                        <button type="submit" class="btn btn-sm btn-primary btn-sm rounded-pill" style="border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                                            <i class="bi bi-person-plus-fill me-1"></i>Follow</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; else: ?>
                        <!-- Empty State Block Placeholder (Hidden by default, toggle with CI4 conditionals) -->
                        <div class="empty-component-box text-center">
                            <i class="bi bi-person-x fs-3 d-block mb-2 text-secondary"></i>
                            <div class="extra-small text-secondary">No user accounts match your search query.</</div>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer bg-white">
                <?= $pager->links('default', 'km_pager_full') ?>
            </div>
        </div>


    </div>
</main>

<?= $this->endSection(); ?>