<!-- app/Views/pages/notebooks/show.php -->
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

        <!-- Notebooks Section -->
        <div class="card">
            <!-- Wrapper changed to stack vertically on mobile, row layout on small screens and up -->
            <header class="card-header border-0 border-bottom p-3 gap-3 d-flex flex-wrap align-items-center justify-content-between">
                <div class="flex-grow-1">
                    <h4 class="mb-1"><?= esc($notebook->name) ?>
                        <?php if ($access_level === 'admin' || $access_level === 'edit'): ?>
                            <span class="badge text-bg-primary">Editor</span>
                        <?php endif; ?>
                    </h4>
                    <p class="mb-0">Author: <?= esc("$notebook->first_name $notebook->last_name") ?></p>
                    <p class="text-muted small mb-0 fw-bold"><?= $notebook->notes_count ?> total notes</p>
                </div>

                <!-- Buttons Container: Stacks as a full-width column on mobile, changes to horizontal row with auto-margin on desktop -->
                <div class="d-flex flex-column flex-sm-row gap-2 w-sm-auto ms-sm-auto">

                    <!-- Only show the "Add Note" button if they are the owner or an editor -->
                    <?php if ($access_level === 'admin' || $access_level === 'edit'): ?>
                        <a href="<?= site_url("notebooks/edit/$notebook->id") ?>"
                            class="btn btn-sm btn-primary rounded-pill fw-bold">
                            <i class="bi bi-pencil-square"></i> Edit Notebook</a>
                    <?php endif; ?>

                    <!-- Only show "Share Settings" to the true owner -->
                    <?php if ($access_level === 'admin'): ?>
                        <a href="<?= site_url("notebooks/$notebook_id/shares") ?>" class="btn btn-sm btn-primary rounded-pill fw-bold">
                            <i class="bi bi-share"></i> Share Settings</a>
                    <?php endif; ?>
                </div>
            </header>

            <div class="card-body p-3 bg-light">
                <!-- Inline Filter Input Search Component -->
                <div class="input-group mb-4 shadow-sm border rounded-3 overflow-hidden border">
                    <span class="input-group-text bg-white border-0 text-muted"><i class="bi bi-filter"></i></span>
                    <input type="text" class="form-control border-0 py-2 small" placeholder="Filter Notebooks...">
                </div>
                <!-- Note Items -->
                <?php if($notes): foreach ($notes as $note):  ?>
                <div class="list-group list-group-flush px-2s">
                    <!-- Active / Featured Note Link -->
                    <a href="<?= site_url("notes/show/$note->note_id") ?>" class="list-group-item list-group-item-action border rounded-3 my-1 p-3 d-flex justify-content-between align-items-start <?= $note->note_visibility == 'public' ? '' : 'bg-body-secondary' ?>">
                        <div class="d-flex gap-3 align-items-start">
                            <div class="<?= $note->note_visibility == 'public' ? 'text-primary' : 'text-muted' ?> pt-1">
                                <i class="bi bi-file-text<?= $note->note_visibility == 'public' ? '-fill' : '' ?> fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark" style="font-size: 0.9375rem;">
                                    <?= esc($note->title) ?> by <span class="fw-lighter"><?= esc($note->username) ?></span>
                                </h6>
                                <p class="text-secondary small mb-0"><?= esc($note->body_summary) ?></p>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end flex-shrink-0">
                            <span class="text-muted mb-2" style="font-size: 0.75rem;"><?= esc($note->published_date) ?></span>
                            <?php if($note->note_visibility == 'private'): ?>
                                <i class="bi bi-eye-slash-fill text-primary small"></i>
                            <?php endif; ?>
                        </div>
                    </a>
                </div> 
                <?php endforeach; else: ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="empty-component-box text-center">
                                <i class="bi bi-journal-x mb-2 d-block"></i>
                                <div class="fw-bold small text-dark">No notes found in this notebook</div>
                                <div class="extra-small" style="font-size: 0.8rem;">You can create a new note by clicking the "Create New Note" button above.</div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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