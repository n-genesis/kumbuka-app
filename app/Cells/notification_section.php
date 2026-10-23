<!-- app/Cells/notification_section.php -->
<div class="card shadow-sm">
    <!-- Card Header with Meta Totals -->
    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <div>
            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-bell-fill text-primary"></i>Notifications
            </h6>
            <?php if(!empty($notifications)): ?>
            <span class="text-muted small" style="font-size: 0.8rem;">Your have 
                <span class="badge text-bg-primary">new <?= count($notifications) ?></span> notifications</span>
            <?php else: ?>
            <span class="text-muted">No new notifications</span>
            <?php endif ?>
        </div>
        <!-- Contextual Total Link Node -->
        <a href="<?= site_url('activity/notifications') ?>"
            class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-medium" style="font-size: 0.8rem;">
            View All
        </a>
    </div>
    <div class="card-body">
        <!-- Scrollable Mini List Group Box -->
        <?php if (!empty($notifications)): ?>
            <div class="list-group list-group-flush px-2 py-1 overflow-y-auto" style="max-height: 320px;">
                <!-- Item (Muted / Transparent) -->
                <?php foreach ($notifications as $notice): ?>
                    <a href="<?= site_url('activity/notifications') ?>" class="list-group-item list-group-item-action border rounded p-2.5 my-1 d-flex align-items-start gap-2.5 opacity-75">
                        <div class="bg-primary-subtle text-primary border border-primary-subtle rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-2" style="width: 34px; height: 34px;">
                            <i class="bi bi-info-circle-fill fs-5 m-0"></i>
                        </div>
                        <div class="w-100 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-0.5">
                                <span class="fw-medium text-dark" style="font-size: 0.825rem;"><?= ucfirst($notice->source_type) ?></span>
                                <span class="text-muted" style="font-size: 0.68rem;"><?= $notice->create_at ?></span>
                            </div>
                            <p class="text-muted small mb-0 text-truncate" style="font-size: 0.75rem;"><?= esc($notice->message) ?></p>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <div class="mt-0 text-center">
                <h4>No new notifications</h4>
            </div>
        <?php endif ?>
    </div>
</div>