<!-- app/Views/pages/activity/pinned/index.php -->
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

        <!-- Pinned Section -->
        <div class="p-3 mb-4">
            <header class="pb-3 mb-3 border-bottom gap-3">
                <h1 class="h4 mb-0"><i class="bi bi-pin-angle-fill text-primary me-2"></i>Pinned Collection</h1>
            </header>

            <!-- Pinned Items Card Container with Tabs -->
            <div class="card">
                
                <!-- Card Header containing the Navigation Tabs -->
                <div class="card-header border-bottom p-3 pb-0 gap-3">                
                    <!-- Bootstrap Tab Navigation Links -->
                    <ul class="nav nav-tabs border-0" id="pinnedTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold px-3 py-2 text-secondary" 
                                    id="notes-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#pinned-notes" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="pinned-notes" 
                                    aria-selected="true"
                                    style="font-size: 0.85rem; border: none; border-bottom: 2px solid transparent;">
                                <i class="bi bi-file-earmark-text me-1.5"></i>Notes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold px-3 py-2 text-secondary" 
                                    id="notebooks-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#pinned-notebooks" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="pinned-notebooks" 
                                    aria-selected="false"
                                    style="font-size: 0.85rem; border: none; border-bottom: 2px solid transparent;">
                                <i class="bi bi-collection-fill me-1.5"></i>Notebooks
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Card Body Containing Tab Content Panels -->
                <div class="card-body p-3 bg-light">
                    <div class="tab-content" id="pinnedTabsContent">

                        <!-- PANEL 1: PINNED INDIVIDUAL NOTES -->
                        <div class="tab-pane fade show active" id="pinned-notes" role="tabpanel" aria-labelledby="notes-tab">
                            <!-- Note Entry 1 -->
                            <?php if($pinnedNotes): foreach ($pinnedNotes as $note):?>
                            <div class="card mb-2">
                                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-secondary border rounded d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px; flex-shrink: 0;">
                                            <i class="bi bi-file-earmark-text m-0 fs-5"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <h6 class="mb-0 fw-bold text-dark text-truncate">
                                                <a href="<?= site_url("notes/show/$note->note_id") ?>" class="text-decoration-none text-reset"><?= esc($note->title)?></a>
                                            </h6>
                                            <small class="text-muted"><span class="d-none d-md-inline-flex">In "<?= esc($note->notebook_name)?>" &bull;</span> 
                                            Posted by <a href="<?= site_url("profile/$note->username") ?>" class="text-decoration-none text-reset">@<?= esc($note->username) ?></a>
                                        </small>
                                        </div>
                                    </div>
                                    <a href="<?= site_url("pin/notes/$note->note_id#pinned-notes") ?>" class="btn btn-link text-primary p-1 border-0" title="Unpin Notebook">
                                        <i class="bi bi-pin-angle-fill fs-5 m-0"></i>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; else: ?>
                            <div class="card empty-component-box shadow-sm">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="bi bi-pin mb-2 d-block"></i>
                                        <div class="fw-bold small text-dark">No notes pinned.</div>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>

                        </div>
                        
                        <!-- PANEL 2: PINNED NOTEBOOKS -->
                        <div class="tab-pane fade" id="pinned-notebooks" role="tabpanel" aria-labelledby="notebooks-tab">
                            <!-- Notebook Entry 1 -->
                            <?php if($pinnedNotebooks): foreach ($pinnedNotebooks as $notebook):?>
                            <div class="card mb-2">
                                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary-subtle text-primary rounded d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px; flex-shrink: 0;">
                                            <i class="bi bi-collection-fill fs-5"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <h6 class="mb-0 fw-bold text-dark text-truncate">
                                                <a href="<?= site_url("notebooks/show/$notebook->notebook_id") ?>" class="text-decoration-none text-reset">
                                                <?= esc($notebook->notebook_name) ?></a>
                                            </h6>
                                            <small class="text-muted">Created by <a href="<?= site_url("profile/$notebook->username") ?>" class="text-decoration-none text-reset">@<?=$notebook->username ?></a></small>
                                        </div>
                                    </div>
                                    <a href="<?= site_url("pin/notebooks/$notebook->notebook_id#pinned-notebooks") ?>" class="btn btn-link text-primary p-1 border-0" title="Unpin Notebook">
                                        <i class="bi bi-pin-angle-fill fs-5 m-0"></i>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; else: ?>
                            <div class="card empty-component-box shadow-sm">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="bi bi-pin-angle mb-2 d-block"></i>
                                        <div class="fw-bold small text-dark">No notebooks pinned.</div>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                            
                        </div>

                    </div>
                </div>

                <style>
                    #pinnedTabs .nav-link.active {
                        color: var(--bs-primary) !important;
                        border-bottom: 2px solid var(--bs-primary) !important;
                        background: transparent !important;
                    }
                    #pinnedTabs .nav-link:hover:not(.active) {
                        border-bottom: 2px solid #e9ecef !important;
                    }
                </style>

            </div>

        </div>
    </div>
</main>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
  var hash = window.location.hash;
  if (hash) {
    // Find the tab trigger that points to the hash ID
    var triggerEl = document.querySelector(`button[data-bs-target="${hash}"], a[href="${hash}"]`);
    if (triggerEl) {
      var tab = new bootstrap.Tab(triggerEl);
      tab.show();
    }
  }
});

</script>
<?= $this->endSection(); ?>