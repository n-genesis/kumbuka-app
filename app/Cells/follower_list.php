<!-- Follower List Card Block -->
<div class="card shadow-sm">
    <!-- Card Header with Meta Totals -->
    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <div>
            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-person-fill-add text-primary"></i>Following Users
            </h6>
            <span class="text-muted small" style="font-size: 0.72rem;">List of Users following you</span>
        </div>
        <!-- Contextual Total Link Node -->
        <a href="network/following" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-medium"
            style="font-size: 0.8rem;">
            View All
        </a>
    </div>
    <div class="card-body d-flex flex-column">
        <!-- User -->
        <?php if (!empty($followers)): ?>
            <!-- Main Newest Posted Notes Card Wrapper -->
            <div class="w-100 mx-auto">
                <?php foreach ($followers as $follower): ?>
                    <a href="<?= site_url("profile/$follower->username") ?>" class="d-flex align-items-center p-2 mb-2 border rounded text-decoration-none">
                        <img src="<?= base_url($follower->avatar) ?>" alt="User avatar image" class="rounded-circle me-2 flex-shrink-0" style="width: 40px; height: 40px; object-fit: cover;">
                        <div>
                            <div class="fw-bold small">@<?= esc($follower->username) ?></div>
                            <div class="text-muted extra-small" style="font-size: 0.75rem;">Follower since
                                <?= $follower->created_at ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <div class="empty-component-box text-center">
                <i class="bi bi-code-slash mb-2 d-block"></i>
                <div class="fw-bold small text-dark">No component loaded.</div>
                <div class="extra-small style" style="font-size: 0.8rem;">Integrate dynamic content here.</div>
            </div>
        <?php endif ?>


    </div>
</div>