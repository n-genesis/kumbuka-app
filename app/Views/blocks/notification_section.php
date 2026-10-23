<!-- app/Cells/notification_section.php -->
 <div class="card  shadow-sm">
    <div class="card-body">
        <!-- Card Header with Meta Totals -->
        <div class="card-header d-flex justify-content-between align-items-center mb-3">
            <div>
                <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-journal-text text-primary"></i>Notifications
                </h6>
                <span class="text-muted small" style="font-size: 0.72rem;">Your most recent notifications</span>
            </div>
            <!-- Contextual Total Link Node -->
            <a href="<?= site_url('activity/notifications') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-medium"
                style="font-size: 0.8rem;">
                View All
            </a>
        </div>

        <!-- Scrollable Mini List Group Box -->
        <div class="list-group list-group-flush px-2 py-1 overflow-y-auto" style="max-height: 320px;">
            
            <!-- ITEM 1: Unread Comment Activity (High Contrast) -->
            <a href="#" class="list-group-item list-group-item-action border rounded p-2.5 my-1 d-flex align-items-start gap-2.5 bg-light-subtle position-relative">
                <!-- Floating Unread Blue Dot Indicator -->
                <span class="position-absolute top-50 start-0 translate-middle p-1 bg-primary border border-white rounded-circle ms-1.5" title="Unread"></span>
                
                <!-- Icon Indicator Bubble -->
                <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 0.95rem;">
                    <i class="bi bi-chat-left-text-fill"></i>
                </div>
                <!-- Alert Context Meta Text -->
                <div class="w-100 overflow-hidden ps-1">
                    <div class="d-flex justify-content-between align-items-center mb-0.5">
                        <span class="fw-bold text-dark" style="font-size: 0.825rem;">Sarah Jenkins</span>
                        <span class="text-muted" style="font-size: 0.68rem;">2h ago</span>
                    </div>
                    <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.75rem;">Replied to your Database Migration note...</p>
                </div>
            </a>

            <!-- ITEM 2: Unread Access System Alert -->
            <a href="#" class="list-group-item list-group-item-action border rounded p-2.5 my-1 d-flex align-items-start gap-2.5 bg-light-subtle position-relative">
                <span class="position-absolute top-50 start-0 translate-middle p-1 bg-primary border border-white rounded-circle ms-1.5" title="Unread"></span>
                
                <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 0.95rem;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="w-100 overflow-hidden ps-1">
                    <div class="d-flex justify-content-between align-items-center mb-0.5">
                        <span class="fw-semibold text-dark" style="font-size: 0.825rem;">Permissions Granted</span>
                        <span class="text-muted" style="font-size: 0.68rem;">5h ago</span>
                    </div>
                    <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.75rem;">You are now an Editor on Production Tasks.</p>
                </div>
            </a>

            <!-- ITEM 3: Read Historical Item (Muted / Transparent) -->
            <a href="#" class="list-group-item list-group-item-action border rounded p-2.5 my-1 d-flex align-items-start gap-2.5 opacity-75">
                <div class="bg-secondary-subtle text-secondary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 0.95rem;">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="w-100 overflow-hidden">
                    <div class="d-flex justify-content-between align-items-center mb-0.5">
                        <span class="fw-medium text-dark" style="font-size: 0.825rem;">New Follower</span>
                        <span class="text-muted" style="font-size: 0.68rem;">Yesterday</span>
                    </div>
                    <p class="text-muted small mb-0 text-truncate" style="font-size: 0.75rem;">Alex Mercer followed your public portfolio.</p>
                </div>
            </a>

        </div>

    
    </div>
</div>