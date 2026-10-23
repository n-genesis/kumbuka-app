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
            <div class="col-lg-8">
                <div class=" p-4">
                    <header class="pb-2 mb-3 border-bottom gap-3">
                        <h4 class="mb-0">Edit Note: <small><?= esc($note->title) ?></small></h4>
                    </header>
                    <form action="<?= site_url("notes/update/$note->note_id") ?>" method="post" class="needs-validation" data-km="form" novalidate>
                        <?= csrf_field() ?>
                        <!-- Config Row (Title, Notebook, Color) -->
                        <div class="row g-3 mb-4">
                            <div class="col-lg-4 col-sm-12">
                                <label class="form-label text-secondary fw-semibold">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Note Title" value="<?= old('title',$note->title) ?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <label class="form-label text-secondary fw-semibold">Notebook (folder)</label>
                                <select class="form-select" name="notebook_id" required>
                                    <?php foreach ($notebooks as $notebook): ?>
                                    <option value="<?= $notebook->notebook_id ?>" <?= $note->notebook_id == $notebook->notebook_id ? 'selected' : '' ?>><?= $notebook->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <label class="form-label text-secondary fw-semibold" for="themeColor">Choose a Note Color</label>
                                <input type="color" name="color" class="form-control" id="themeColor" value="<?= old('color', $note->color) ?>">
                            </div>
                        </div>

                        <!-- Body Text Editor Area -->
                        <div class="mb-2">
                            <textarea id="kumbukaEditor" name="content" rows="3" data-change="input" data-custom-target="#note-description" required><?= old('content',$note->content) ?></textarea>
                        </div>
                        <p class="mt-0 text-mute small">Like the Editor? Checkout the project on 
                            <a href="https://github.com/n-genesis/slate" target="_blank">GitHub here <i class="bi bi-github ms-1"></i></a></p>

                        <!-- Status and Comments Visibility Row -->
                        <div class="row g-3 mb-4">
                            <div class="col-lg-12">
                                <!-- Default Visibility Scope -->
                                <label for="noteVisibility" class="form-label fw-bold text-dark small mb-1">Initial Visibility</label>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="card shadow-sm p-2 bg-white">
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input flex-shrink-0" type="radio" name="visibility" id="visibilityPublic" value="public" <?= $note->note_visibility == 'public' ? 'checked' : '' ?> required>
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
                                                <input class="form-check-input flex-shrink-0" type="radio" name="visibility" id="visibilityPrivate" value="private" <?= $note->note_visibility == 'private' ? 'checked' : '' ?> required>
                                                <label class="form-check-label ms-2 min-w-0" for="visibilityPrivate">
                                                    <strong class="d-block small text-dark">Private Drawer</strong>
                                                    <span class="text-muted d-block text-truncate" style="font-size: 0.7rem;">Only visible to your profile</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary fw-semibold">Allow Comments</label>
                                <select name="allow_comments" class="form-select text-secondary">
                                    <option value="1" <?= $note->allow_comments == true ? 'selected': '' ?>>Yes (Allow Comments)</option>
                                    <option value="0"<?= $note->allow_comments == false ? 'selected' : '' ?>>No (Disable Comments)</option>
                                </select>
                            </div>
                        </div>
                        
                        

                        <!-- Footer -->
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="<?= site_url('home') ?>" class="btn btn-outline-secondary mr-auto">
                                <i class="bi bi-box-arrow-left"></i> Back Home
                            </a>
                            <button type="submit" class="btn btn-primary" data-km="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Content Section -->
             <aside class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                
                <!-- Inside app/Views/gallery.php -->
                <div class="image-gallery mb-3" style="display: flex; gap: 15px; flex-wrap: wrap;">
                    
                    <?php if (!empty($note_images)): ?>
                        <?php foreach ($note_images as $image): ?>
                            <div class="image-item">
                                <!-- Anchor tags link to full image, img tags show the thumbnail -->
                                <a href="<?= base_url($image->file_path) ?>" target="_blank">
                                    <img src="<?= base_url($image->file_path) ?>"  alt="Thumbnail" style="border-radius: 8px; object-fit: cover; width: 150px; height: 150px;">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No images uploaded yet.</p>
                    <?php endif; ?>

                </div>
                <form action="<?= site_url('notes/upload') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <!-- Added id="image-input" -->
                     <div class="mb-3">
                    <input class="form-control" type="file" id="image-input" name="note_images[]" multiple accept="image/*">
                    <input type="hidden" name="note_id" value="<?=$note->note_id ?>">
                    </div>
                    <!-- Container where Javascript will render thumbnails -->
                    <div id="preview-container" class="my-3" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">upload</button>
                    </div>
                </form>
                </div>
            </div>
             </aside>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>

<!-- Additional  JS Scripts -->
<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@4.0.0/dist/jquery.min.js"></script>
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
        // Using slate.js
        new Slate(document.getElementById('kumbukaEditor'));
        
    });
</script>
<script>
document.getElementById('image-input').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('preview-container');
    
    // Clear any previous previews from the last selection
    previewContainer.innerHTML = '';

    const files = event.target.files;

    if (files) {
        // Loop through all selected files
        Array.from(files).forEach(file => {
            // Check if the file is genuinely an image
            if (file.type.startsWith('image/')) {
                
                // 1. Create a temporary local URL for the image file
                const blobUrl = URL.createObjectURL(file);

                // 2. Create a wrapper div for styling
                const wrapper = document.createElement('div');
                wrapper.style.position = 'relative';

                // 3. Create the image element
                const img = document.createElement('img');
                img.src = blobUrl;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '6px';
                img.style.border = '1px solid #ddd';

                // 4. Free up memory when the image loads
                img.onload = function() {
                    URL.revokeObjectURL(blobUrl);
                };

                // Append image to wrapper, and wrapper to container
                wrapper.appendChild(img);
                previewContainer.appendChild(wrapper);
            }
        });
    }
});
</script>
<?= $this->endSection() ?>