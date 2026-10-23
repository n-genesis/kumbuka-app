<!-- app/Views/pages/activity/notifications/index.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('styles') ?>
<style>
    .not-read:last-child {
    border-bottom: 1px solid var(--bs-primary) !important;
    }
</style>
<?= $this->endSection() ?>

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

        <!-- Notifications Card Container -->
        <div class="card shadow-sm">
            
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <div>
                <h4 class="mb-0 text-dark d-flex align-items-center">
                    <i class="bi bi-bell-fill text-primary me-2"></i>Notifications
                </h4>
                <span class="text-muted small" style="font-size: 0.72rem;">You have
                    <?php if (service('request')->getGet('category')): ?>
                        <span id="notice-count" class="fw-bold"><?= count($notifications) ?></span> read notifications
                    <?php else: ?>
                        <span id="notice-count" class="fw-bold"><?= count($notifications) ?></span> unread notifications
                    <?php endif ?>
                </span>
                </div>
                
                <!-- Mark All Read Post Action Form -->
                <form action="<?= site_url("activity/notifications/markread") ?>" method="POST" class="m-0">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-link text-decoration-none text-primary fw-semibold p-0 small" style="font-size: 0.85rem;">
                        Mark all as read
                    </button>
                </form>
            </div>

            <!-- High-Density Notification List Group Container -->
            <div style="max-height: 480px; overflow-y: auto;">
                <div class="list-group list-group-flush">
                    
                    <!-- NOTIFICATION ITEM 1: UNREAD COMMENT -->
                    <!-- "bg-light-subtle" combined with custom blue border indicates unread status -->
                    <?php foreach ($notifications as $notice): ?>
                    <div class="list-group-item p-3 w-100 d-flex align-items-start justify-content-between <?= $notice->is_read ? 'bg-white' : 'not-read position-relative border-start border-primary border-1 border-bottom-0' ?>" style="background-color: #f4f7fe;">
                        <div class="d-flex align-items-start flex-grow-1 me-2">
                            <!-- Icon Indicator -->
                            <div class="<?= $notice->is_read ? 'bg-info-subtle text-info-emphasis' : 'bg-primary-subtle text-primary' ?> rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 38px; height: 38px;">
                                <i class="bi bi-info-circle-fill fs-5 m-0"></i>
                            </div>
                            <!-- Notification Context Message -->
                            <div>
                                <p class="mb-1 text-dark small lh-sm"><?= $notice->message ?></p>
                                <span class="text-muted" style="font-size: 0.75rem;"><?= $notice->created_at ?></span>
                            </div>
                        </div>
                        <!-- Inline Unread Dot Indicator -->
                        <?php if (!$notice->is_read): ?>
                        <!-- <div class="flex-shrink-0 ps-2 pt-1">
                            <span class="p-1 bg-primary border border-light rounded-circle d-block" title="Unread"></span>
                        </div> -->
                        <?php endif ?>
                        <!-- Dropdown Container -->
                        <div class="dropdown">
                            <!-- Main Trigger Button -->
                            <button class="btn btn-sm btn-outline-secondary" type="button" id="<?=$notice->id?>-amb" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical m-0"></i>
                            </button>
                            <!-- Dropdown Menu containing Form Action Buttons -->
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="<?=$notice->id?>-amb">
                                <form method="POST"
                                    action="<?= site_url("activity/notifications/markread/$notice->id") ?>">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="dropdown-item"><i class="bi bi-trash3"></i>
                                        Dismiss</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <?php endforeach ?>


                </div>
            </div>

            <!-- Card Footer -->
            <!-- <div class="card-footer bg-white text-center">
                <a href="#" class="small text-decoration-none fw-bold text-primary">
                    View All Historical Notifications <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div> -->
        </div>

    </div>
</main>

<?= $this->endSection(); ?>