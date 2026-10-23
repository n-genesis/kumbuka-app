<!-- app/Views/pages/notes/new.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/slate.css'); ?>">
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
        <div class="row">
            <!-- Left Main Content Column -->
            <div class="col-12">
                <div class="p-4">
                    <header class="pb-2 mb-3 border-bottom gap-3">
                        <h4 class="mb-0"><i class="bi bi-journal-text text-primary"></i> Create A New Note</h4>
                    </header>
                    <form action="<?= site_url('notes') ?>" method="post" class="needs-validation" data-km="form" novalidate>
                        <?= csrf_field() ?>
                        <!-- Config Row (Title, Notebook, Color) -->
                        <div class="row g-3 mb-4">
                            <div class="col-lg-4 col-sm-12">
                                <label class="form-label text-secondary fw-semibold">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Note Title" value="<?= old('title') ?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <label class="form-label text-secondary fw-semibold">Notebook (folder)</label>
                                <select class="form-select" name="notebook_id" required>
                                    <option>Select a notebook</option>
                                    <?php foreach ($notebooks as $notebook): ?>
                                    <option value="<?= $notebook->notebook_id ?>"><?= $notebook->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <label class="form-label text-secondary fw-semibold" for="themeColor">Choose a Note Color</label>
                                <input type="color" name="color" class="form-control" id="themeColor" value="<?= old('color', '#00396B' ) ?>">
                            </div>
                        </div>

                        <!-- Body Text Editor Area -->
                        <div class="mb-2">
                            <textarea id="kumbukaEditor" name="content" rows="3" data-change="input" data-custom-target="#note-description" required><?= old('content') ?></textarea>
                        </div>
                        <p class="mt-0 text-mute small">Like the Editor? Checkout the project on 
                            <a href="https://github.com/n-genesis/slate" target="_blank">GitHub here <i class="bi bi-github ms-1"></i></a></p>
                        <!-- Status and Comments Visibility Row -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 col-sm-12">
                                <!-- Default Visibility Scope -->
                                <label for="noteVisibility" class="form-label fw-bold text-dark small mb-1">Initial Visibility</label>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="card shadow-sm p-2 bg-white">
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input flex-shrink-0" type="radio" name="visibility" id="visibilityPublic" value="public" <?= old('visibility') == 'public' ? 'checked' : '' ?> required>
                                                <label class="form-check-label ms-2 min-w-0" for="visibilityPublic">
                                                    <strong class="d-block small text-dark">Public Post</strong>
                                                    <span class="text-muted d-block text-truncate" style="font-size: 0.7rem;">Anyone on <?= $appName ?> can view</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow-sm p-2 bg-white">
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input flex-shrink-0" type="radio" name="visibility" id="visibilityPrivate" value="private" <?= old('visibility') == 'private' ? 'checked' : '' ?> required>
                                                <label class="form-check-label ms-2 min-w-0" for="visibilityPrivate">
                                                    <strong class="d-block small text-dark">Private Drawer</strong>
                                                    <span class="text-muted d-block text-truncate" style="font-size: 0.7rem;">Only visible to your profile</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label text-secondary fw-semibold">Allow Comments</label>
                                <select name="allow_comments" class="form-select text-secondary">
                                    <option value="1">Yes (Allow Comments)</option>
                                    <option value="0">No (Disable Comments)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="<?= site_url('home') ?>" class="btn btn-outline-secondary rounded-pill mr-auto">
                                <i class="bi bi-box-arrow-left"></i> Back Home
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill" data-km="submit"><i class="bi bi-floppy me-1"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>

<!-- Additional  JS Scripts -->
<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/slate.min.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
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
        // Generate a sticker
        new Slate(document.getElementById('kumbukaEditor'));
    });
</script>
<?= $this->endSection() ?>