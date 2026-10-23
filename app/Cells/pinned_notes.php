<!-- Inside app/Cells/pinned_notes.php -->
<?php use CodeIgniter\I18n\Time; ?>
<div class="card shadow-sm">
    <!-- Card Header with Meta Totals -->
    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <div>
            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-file-text text-primary"></i>Pinned Notes
            </h6>
            <span class="text-muted small" style="font-size: 0.72rem;">Showing the last pinned notes</span>
        </div>
        <!-- Contextual Total Link Node -->
        <a href="<?= site_url('activity/pinned#pinned-notes') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-medium">
            View All
        </a>
    </div>
    <div class="card-body d-flex flex-column">
        <?php if (!empty($pinnedNotes)): ?>

            <!-- Main Newest Pinned Notes Card Wrapper -->
            <div class="card rounded-3 shadow-sm w-100 mx-auto">

                <!-- Loop through the nested array of note objects -->
                <?php foreach ($pinnedNotes as $note): ?>

                    <!-- Flush List Group Container -->
                    <div class="list-group list-group-flush border-bottom">

                        <!-- NOTE ITEM 1: Most Recent Post (Standard text post with code markup snippet) -->
                        <div class="list-group-item rounded-3 my-1 p-3 hover-bg">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <h6 class="mb-0 fw-bold small">
                                        <a href="<?= site_url("notes/show/$note->note_id") ?>" class="text-decoration-none hover-blue"><?= esc($note->title) ?></a>
                                    </h6>
                                </div>
                                <span class="text-muted small flex-shrink-0 ms-auto" style="font-size: 0.72rem;">
                                    <?= Time::parse($note->pinned_created_at)->humanize() ?>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top text-muted small" style="font-size: 0.75rem;">
                                <div class="d-flex flex-column">
                                    <span>
                                       <i class="bi bi-folder2-open me-1"></i> <?= esc($note->notebook_name) ?>
                                    </span>
                                    <span>
                                        <i class="bi bi-person-fill me-1"></i> @<?= esc($note->username) ?>
                                    </span>
                                </div>
                                <a href="<?= site_url("notes/show/$note->note_id") ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-chat-square small m-0"></i> View
                                </a>
                            </div>
                        </div>

                    </div>

                <?php endforeach; ?>

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