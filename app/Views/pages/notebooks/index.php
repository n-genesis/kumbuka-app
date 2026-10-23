<!-- app/Views/pages/notebooks/index.php -->
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
            <header class="card-header border-0 border-bottom p-3 gap-3 d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Notebooks</h4>
                    <p class="text-muted small mb-0"><?= count($notebooks) ?> Notebooks / <?= array_sum(array_column($notebooks, 'notes_count')) ?> total notes</p>
                </div>
                <a href="<?= site_url('notebooks/new') ?>"
                    class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2">
                    <i class="bi bi-folder-plus"></i> Create New
                </a>
            </header>
            
            <div class="card-body p-3 bg-light">
            <!-- Inline Filter Input Search Component -->
            <div class="input-group mb-4 shadow-sm rounded-3 overflow-hidden bg-white border">
                <span class="input-group-text bg-white border-0 text-muted"><i class="bi bi-filter"></i></span>
                <input type="text" class="form-control border-0 py-2 small" placeholder="Filter Notebooks...">
            </div>

            <?php if ($notebooks): ?>
                <!-- Notebook Cards Stack Container -->
                <div class="d-flex flex-column gap-3">
                    <?php foreach ($notebooks as $notebook): ?>
                    <div class="notebook-card bg-white d-flex">
                        <div class="notebook-accent-line bg-<?= $notebook->theme_color ?>"></div>
                        <div class="p-3 w-100 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <!-- Text content wrapper with defensive layout classes -->
                            <div class="min-w-0 flex-grow-1">
                                <a href="<?= site_url("notebooks/show/$notebook->notebook_id") ?>" class="text-decoration-none">
                                    <h5 class="h6 mb-1 fw-bold text-primary"><?= esc($notebook->name) ?></h5>
                                    <div class="d-flex gap-2 text-muted mb-2" style="font-size: 0.8rem;">
                                        <span><i class="bi bi-file-text me-1"></i><?= $notebook->notes_count ?> notes</span>
                                        <span>•</span>
                                        <span><?= esc($notebook->published) ?></span>
                                        <?php if($notebook->visibility == 'private'): ?>
                                        <span>•</span>
                                        <i class="bi bi-eye-slash-fill text-primary"></i>
                                        <?php endif ?>
                                    </div>
                                    <p class="text-secondary mb-0 small"><?= esc($notebook->metadata) ?></p>
                                </a>
                            </div>
                            
                            <!-- Right-Aligned Dropdown Action Block -->
                            <!-- align-self utilities ensure perfect positioning across small screens -->
                            <div class="dropdown flex-shrink-0 align-self-end align-self-md-center ps-md-2">
                                <button class="btn btn-light btn-sm rounded-pill border px-3 d-flex align-items-center gap-1.5" 
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots text-muted"></i>
                                    <span class="fw-semibold text-secondary" style="font-size: 0.8rem;">Manage</span>
                                </button>
                                
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item py-2 text-dark" href="<?= site_url("notebooks/show/$notebook->notebook_id") ?>">
                                            <i class="bi bi-eye me-2 text-muted"></i>View Content
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2 text-dark" href="<?= site_url("notebooks/edit/$notebook->notebook_id") ?>">
                                            <i class="bi bi-pencil-square me-2 text-muted"></i>Edit Details
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <!-- Secure Method-Spoofed CodeIgniter Delete Action Form -->
                                        <form action="<?= site_url("notebooks/delete/$notebook->notebook_id") ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this notebook?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="dropdown-item py-2 text-danger bg-transparent border-0 w-100 text-start">
                                                <i class="bi bi-trash3 me-2"></i>Delete Notebook
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>                        
                    <?php endforeach ?>

                </div>

            <?php else: ?>
                <!-- Parent container with centered alignments and defined spacing metrics -->
                <div class="d-flex flex-column gap-3 align-items-center justify-content-center text-center p-5 w-100"
                    style="min-height: 350px;">

                    <!-- 1. Centered Empty State Image Wrapper -->
                    <div class="empty-image-container mb-2">
                        <img src="assets/images/kuma-be-kind.webp" alt="No notes found" class="img-fluid opacity-60"
                            style="max-width: 260px; height: auto;">
                    </div>

                    <!-- 2. Centered Header Text & Context Description Block -->
                    <div>
                        <h3 class="text-dark mb-1">Notebook is empty</h3>
                        <p class="text-muted small mb-0 mx-auto" style="max-width: 360px;">
                            This Notebooks is currently empty. Click the button above to create one.
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