<!-- app/Views/pages/network/following.php -->
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

        <!-- Following Users List -->
        <div class="card rounded-3">

        <header class="card-header border-0 border-bottom p-3 gap-3 d-flex flex-wrap align-items-center justify-content-between">
            <div>
                <h1 class="h4 mb-1"><i class="bi bi-people-fill text-primary me-2"></i> <?= $pageHeader ?></h1>
                <p class="text-muted small mb-0"><?= $subHeader ?></p>
            </div>
            <div class="dropdown">
                <button class="btn btn-light btn-sm rounded-pill border px-3 d-flex align-items-center gap-1.5" 
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter text-muted"></i>
                    <span class="fw-semibold text-secondary" style="font-size: 0.8rem;">Filter List</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-light">
                    <li><a class="dropdown-item py-2 <?= url_is('network/following') ? 'active' : 'link-dark' ?>" href="<?= site_url('network/following') ?>">Followers</a></li>
                    <li><a class="dropdown-item py-2 <?= url_is('network/friends') ? 'active' : 'link-dark' ?> " href="<?= site_url('network/friends') ?>">Friends</a></li>
                </ul>
            </div>
        </header>

            <!-- Card Body -->
            <div class="card-body p-3 bg-light" style="max-height: 480px; overflow-y: auto;">
                <!-- Filter/Search Field -->
                <div class="mb-4">
                    <form action="<?= site_url('network/search') ?>" action="get">
                        <input type="text" class="form-control" name="query" placeholder="Find Friends..."  autocomplete="off">
                    </form>
                </div>

                <?php if ($followers): foreach ($followers as $follower): ?>
                <div class="card border-0 shadow-sm rounded-3 mb-2">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <!-- User Avatar matching Alex Rivera's style -->
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center p-1 me-3">
                                <a href="<?= site_url("profile/$follower->username") ?>" class="text-decoration-none">
                                <img src="<?= base_url($follower->avatar) ?>" class="rounded-circle" alt="<?= esc($follower->username) ?>'s Avatar" style="width: 40px; height: 40px; object-fit: cover;">
                                </a>
                            </div>
                            <div>
                                <a href="<?= site_url("profile/$follower->username") ?>" class="text-decoration-none">
                                <h6 class="mb-0 fw-bold text-dark"><?= esc("$follower->first_name $follower->last_name") ?></h6>
                                </a>
                                <small class="text-muted d-block">@<?= esc($follower->username) ?> &bull; <?= $follower->notes_count ?> notes</small>
                            </div>
                        </div>
                        <!-- Show Follow/Unfollow Button based on the current follow status -->
                        <?php if ($followerModel->isFollowing(auth()->id(), $follower->user_id)): ?>
                            <form action="<?= base_url('follow/toggle/' . $follower->user_id) ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="followed_id" value="<?= $follower->user_id ?>">
                                <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill" style="border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                                    <i class="bi bi-person-check-fill me-1"></i>Following</button>
                            </form>
                        <?php else: ?>
                            <form action="<?= base_url('follow/toggle/' . $follower->user_id) ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="followed_id" value="<?= $follower->user_id ?>">
                                <button type="submit" class="btn btn-sm btn-primary btn-sm rounded-pill" style="border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                                    <i class="bi bi-person-plus-fill me-1"></i>Follow</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; else: ?>
                <!-- Parent container with centered alignments and defined spacing metrics -->
                <div class="d-flex flex-column gap-3 align-items-center justify-content-center text-center p-5 w-100"
                    style="min-height: 350px;">

                    <!-- 1. Centered Empty State Image Wrapper -->
                    <div class="empty-image-container mb-2">
                        <img src="<?= base_url('assets/images/kuma-be-kind.webp')?>" alt="No notes found" class="img-fluid opacity-60"
                            style="max-width: 260px; height: auto;">
                    </div>

                    <!-- 2. Centered Header Text & Context Description Block -->
                    <div>
                        <h3 class="text-dark mb-1">Oh, no. Nothing Yet.</h3>
                        <p class="text-muted small mb-0 mx-auto" style="max-width: 360px;">
                            You can search for a User to follow above.
                        </p>
                    </div>

                </div>
            <?php endif ?>
            </div>

            <!-- Card Footer -->
            <footer class="card-footer">
                <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
                </nav>
                </footer>
        </div>

    </div>
</main>

<?= $this->endSection(); ?>