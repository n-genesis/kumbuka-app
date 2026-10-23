<!-- app/Views/pages/notebooks/new.php -->
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

        <div class="row">
            <!-- Left Main Content Column -->
            <div class="col-12">
            <!-- Create New Notebook Card -->
            <div class="card border-0 shadow-sm rounded-3">

                <!-- Card Header -->
                <div class="card-header border-bottom p-3 d-flex align-items-center">
                    <h4 class="mb-0 text-dark d-flex align-items-center">
                        <i class="bi bi-folder-plus text-primary me-2"></i>Create New Notebook
                    </h4>
                </div>
                
                 <!-- Route configured for a RESTful CodeIgniter 4 Model controller -->
                <form action="<?= base_url('notebooks/create') ?>" method="POST" class="needs-validation" data-km="form" novalidate>
                <?= csrf_field() ?>

                <!-- Card Body Containing Form Inputs -->
                <div class="card-body p-4">
                    

                        <!-- Notebook Name -->
                        <div class="mb-3">
                            <label for="notebookName" class="form-label text-dark small mb-1">Name</label>
                            <input type="text" 
                                class="form-control shadow-sm" 
                                id="notebookName" 
                                name="name" 
                                placeholder="Notebook(folder) title" 
                                value="<?= old('name') ?>" 
                                required 
                                maxlength="100">
                        </div>

                        <!-- Notebook Metadata -->
                        <div class="mb-3">
                            <label for="notebookMetadata" class="form-label text-dark small mb-1">Keywords</label>
                            <input type="text" 
                                class="form-control shadow-sm" 
                                id="notebookMetadata" 
                                name="metadata" 
                                placeholder="e.g., my-notebook, short-shtories, funny" 
                                value="<?= old('metadata') ?>" 
                                maxlength="255">
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label for="notebookDescription" class="form-label text-dark small mb-1">Description (Optional)</label>
                            <textarea class="form-control shadow-sm" 
                                    id="notebookDescription" 
                                    name="description" 
                                    rows="5" 
                                    placeholder="Briefly description for the notebook..." 
                                    maxlength="500"><?= old('description') ?></textarea>
                            <div class="form-text text-muted small" style="font-size: 0.75rem;">Max 500 characters. Keep it brief for feed summaries.</div>
                        </div>

                        <!-- Accent Color Category Label (Improves your dashboard layouts) -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark small mb-1">Accent Theme Color</label>
                            <div class="d-flex flex-wrap gap-2 pt-1">
                                <input type="radio" class="btn-check" name="theme_color" id="colorPrimary" value="primary" checked>
                                <label class="btn btn-outline-primary btn-sm rounded-pill px-3" for="colorPrimary">Blue (Kool)</label>

                                <input type="radio" class="btn-check" name="theme_color" id="colorSuccess" value="success">
                                <label class="btn btn-outline-success btn-sm rounded-pill px-3" for="colorSuccess">Green (Noice)</label>

                                <input type="radio" class="btn-check" name="theme_color" id="colorWarning" value="warning">
                                <label class="btn btn-outline-warning btn-sm rounded-pill px-3" for="colorWarning">Yellow (Nifty)</label>

                                <input type="radio" class="btn-check" name="theme_color" id="colorDanger" value="danger">
                                <label class="btn btn-outline-danger btn-sm rounded-pill px-3" for="colorDanger">Red (Radical)</label>
                            </div>
                        </div>

                        <!-- Default Visibility Scope -->
                        <div class="mb-4">
                            <label for="notebookVisibility" class="form-label fw-bold text-dark small mb-1">Initial Visibility</label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm p-2 bg-white">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input flex-shrink-0" type="radio" name="visibility" id="visibilityPublic" value="public" checked>
                                            <label class="form-check-label ms-2 min-w-0" for="visibilityPublic">
                                                <strong class="d-block small text-dark">Public Collection</strong>
                                                <span class="text-muted d-block text-truncate" style="font-size: 0.7rem;">Anyone can view</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm p-2 bg-white">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input flex-shrink-0" type="radio" name="visibility" id="visibilityPrivate" value="private">
                                            <label class="form-check-label ms-2 min-w-0" for="visibilityPrivate">
                                                <strong class="d-block small text-dark">Private Drawer</strong>
                                                <span class="text-muted d-block text-truncate" style="font-size: 0.7rem;">Only visible to your profile</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                
                <!-- Card Footer -->
                <footer class="card-footer">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= site_url('home') ?>" class="btn btn-outline-secondary rounded-pill mr-auto">
                            <i class="bi bi-box-arrow-left"></i> Back Home
                        </a>
                        <button type="submit" class="btn btn-primary" data-km="submit" data-km="submit"><i class="bi bi-floppy me-1"></i> Save</button>
                    </div>
                </footer>

                </form>

            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
});
</script>
<?= $this->endSection(); ?>