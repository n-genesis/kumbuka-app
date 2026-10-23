<div class="card shadow-sm">
    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <div>
            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-rss-fill text-primary me-1"></i>Activity Feed
            </h6>
            <span class="text-muted small" style="font-size: 0.72rem;">Latest poste (user your following)</span>
        </div>
        <!-- Contextual Total Link Node -->
        <a href="<?= site_url('network/feed') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-medium" style="font-size: 0.8rem;">
            View All
        </a>
    </div>

    <!-- Feed Content Panel -->
    <div class="card-body">
        <?php if(!empty($latestNotes)): ?>
            <?php foreach ($latestNotes as $note): ?>
                <!-- Post Entry 1 (Matching Image) -->
                <div class="card border rounded-3 mb-3">
                    <div class="card-body p-3">
                        <!-- User Info Block -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary text-white border border-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 48px; height: 48px; font-size: 0.75rem;">
                                <?= ucfirst(substr($note->first_name, 0, 1)) . ucfirst(substr($note->last_name, 0, 1)) ?>
                            </div>
                            <a href="<?= site_url("profile/$note->username") ?>" class="text-decoration-none link-body-emphasis">
                                <h6 class="mb-0 fw-bold text-dark">
                                    <?= esc("$note->first_name $note->last_name") ?>
                                </h6>
                                <small class="text-muted">@<?= esc($note->username) ?> &bull; Following</small>
                            
                            </a>
                        </div>
                        <!-- Note Content Block -->
                        <a href="<?= site_url("notes/show/$note->note_id") ?>" class="text-decoration-none link-body-emphasis">
                            <h6 class="fw-bold text-dark mb-0"><?= esc($note->title) ?></h6>
                            <p class="text-secondary text-truncate mb-0" style="font-size: 0.85rem;">
                                <?= esc($note->body_summary) ?>
                            </p>
                        </a>
                        <!-- Card Footer: Metadata Indicators -->
                        <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-3">
                            <span class="text-muted small me-2"><i class="bi bi-pin-angle-fill text-primary me-1"></i> <?= $note->pinned_count ?>
                                Pines</span>
                                <span class="text-muted small"><i class="bi bi-chat-left-text text-secondary me-1"></i> <?= $note->comment_count ?>
                                Comments</span>
                            <span class="badge bg-secondary btn-sm ms-auto text-truncate"><?= esc($note->notebook_name) ?></span>
                        </div>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-component-box text-center">
                <i class="bi bi-code-slash mb-2 d-block"></i>
                <div class="fw-bold small text-dark">No component loaded.</div>
                <div class="extra-small style" style="font-size: 0.8rem;">Integrate dynamic content here.</div>
            </div>
        <?php endif; ?>
        

    </div>
</div>