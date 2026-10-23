<!-- app/Views/pages/network/community_feed.php -->
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

        <!-- Pinned Section -->
        <div class="p-3 mb-4">
            <header class="pb-3 mb-3 border-bottom gap-3 d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-1 text-truncate"><i class="bi bi-rss-fill text-primary me-1"></i><?= esc($pageHeader ?? 'Community Feed') ?></h1>
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-pill border px-3 d-flex align-items-center gap-1.5" 
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-filter text-muted"></i>
                        <span class="fw-semibold text-secondary" style="font-size: 0.8rem;">All Activity</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-light">
                        <li><a class="dropdown-item py-2 <?= url_is('network/feed') ? 'active' : 'link-dark' ?>" href="<?= site_url('network/feed') ?>">Recent Activity</a></li>
                        <li><a class="dropdown-item py-2 <?= url_is('network/notes') ? 'active' : 'link-dark' ?> " href="<?= site_url('network/notes') ?>">Community Notes</a></li>
                        <li><a class="dropdown-item py-2 <?= url_is('network/notebooks') ? 'active' : 'link-dark' ?> " href="<?= site_url('network/notebooks') ?>">Community Notebook</a></li>
                    </ul>
                </div>
            </header>

            <!-- Global Feed Card Container -->
            <div class="card rounded-3" style="max-height: 100vh;">
                
                <!-- Feed Content Body -->
                <div class="card-body p-3 bg-light" style="overflow-y: auto;">

                    <?php if (!empty($activities)): ?>
                        <?php foreach ($activities as $activity): ?>
                            <?php $isNote = $activity->activity_type === 'note'; ?>
                            <article class="card rounded-3 mb-3">
                                <div class="card-body p-3 w-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <?php if (!empty($activity->avatar)): ?>
                                            <img src="<?= base_url($activity->avatar) ?>" alt="" class="rounded-circle me-3 flex-shrink-0" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="min-w-0">
                                            <h6 class="mb-0 fw-bold text-dark text-truncate">
                                                <a href="<?= site_url("profile/$activity->username") ?>" class="text-decoration-none text-reset">
                                                <?= esc(trim(($activity->first_name ?? '') . ' ' . ($activity->last_name ?? '')) ?: ($activity->username ?? 'User')) ?>
                                                </a>
                                            </h6>
                                            <small class="text-muted d-block text-truncate">
                                                <?= $isNote ? 'Published a new note' : 'Created a new notebook' ?> &bull; <?= esc((string) $activity->created_date) ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="ps-0 ps-md-5">
                                        <?php if (!$isNote): ?>
                                            <a href="<?= site_url("notebooks/show/$activity->notebook_id") ?>" class="text-decoration-none text-reset">
                                                <h5 class="fw-bold text-dark mb-1 text-break"><?= esc($activity->title) ?></h5>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= site_url("notes/show/$activity->note_id") ?>" class="text-decoration-none text-reset">
                                            <h5 class="fw-bold text-dark mb-1 text-break"><?= esc($activity->title) ?></h5>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($isNote): ?>
                                            <p class="text-secondary small text-break mb-2"><?= esc($activity->getSummary()) ?></p>
                                            <?php if (!empty($activity->notebook_name)): ?>
                                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded"><?= esc($activity->notebook_name) ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                    
                    <!-- Add empty Element -->

                    <?php endif; ?>
                    
                </div>
                <!-- Pagination Footer -->
                <footer class="card-footer">
                    <?= $pager_links ?>
                </footer>
            </div>

        </div>
    </div>
</main>

<?= $this->endSection(); ?>