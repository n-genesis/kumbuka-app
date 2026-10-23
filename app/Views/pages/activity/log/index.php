<!-- app/Views/pages/activity/log/index.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>
<main class="main-content py-4 px-2">
    
<div class="container-fluid">

    <!-- Header Component -->
    <header>
        <!-- Breadcrumbs -->
        <?php if (!empty($breadcrumbHtml)): ?>
            <?= $breadcrumbHtml ?>
        <?php endif; ?>
    </header>

<!-- Activity Log Card Container -->
<div class="card shadow-sm rounded-3">
    
    <!-- Card Header -->
    <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
            <i class="bi bi-clock-history text-primary me-2"></i>Activity Log
        </h5>
    </div>

    <!-- Flush List Group Container Wrapper -->
    <div style="max-height: 440px; overflow-y: auto;">
        <div class="list-group list-group-flush">
            
            <!-- LOG ITEM -->
            <?php foreach ($activities as $log): ?>
            <!-- LIST ITEM 1: SECURITY / AUTHENTICATION -->
            <div class="list-group-item p-3 w-100 d-flex align-items-center justify-content-between bg-white">
                <div class="d-flex align-items-center min-w-0 flex-grow-1 me-2">
                    <!-- Distinct Visual Icon Callouts -->
                    <div class="bg-<?= $log->severity ?>-subtle text-<?= $log->severity ?> rounded d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 36px; height: 36px;">
                        <i class="bi bi-shield-lock-fill fs-5"></i>
                    </div>
                    <div class="min-w-0">
                        <h6 class="mb-0 fw-bold text-dark text-truncate"><?= esc($log->description) ?></h6>
                        <small class="text-muted d-block text-truncate">IP: <?= esc($log->ip_address) ?> &bull; <?= ucfirst($log->category) ?></small>
                    </div>
                </div>
                <div class="text-end flex-shrink-0 ps-2">
                    <span class="text-muted small" style="font-size: 0.8rem;"><?= \CodeIgniter\I18n\Time::parse($log->created_at)->humanize() ?></span>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Card Footer -->
    <div class="card-header bg-white text-center border-top">
        <?= $pager->links('default', 'km_pager_full') ?>
    </div>
</div>


</div>
</main>
<?= $this->endSection(); ?>