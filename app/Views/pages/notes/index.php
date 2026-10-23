<!-- app/Views/pages/notes/index.php -->
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

        <!-- Notes Dashboard Section -->
        <div class="card">
            <header class="card-header border-0 border-bottom p-3 gap-3 d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h1 class="h4 mb-1"><i class="bi bi-journal-text text-primary"></i> Notes (<?= $notes_status ?>)</h1>
                    <p class="text-muted small mb-0"><?= count($notes) ?> notes found</p>
                </div>
                <a href="<?= site_url('notes/new') ?>" class="btn btn-sm btn-outline-primary d-flex align-items-center ms-auto">
                    <i class="bi bi-journal-plus"></i> Create New
                </a>
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-pill border px-3 d-flex align-items-center gap-1.5" 
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-filter text-muted"></i>
                        <span class="fw-semibold text-secondary" style="font-size: 0.8rem;">Filter List</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-light">
                        <li><a class="dropdown-item py-2 <?= url_is('notes/') && empty(service('request')->getGet('status')) ? 'active' : 'link-dark' ?>" href="<?= site_url('notes') ?>">Public Note</a></li>
                        <li><a class="dropdown-item py-2 <?= url_is('notes') && service('request')->getGet('status') === 'private' ? 'active' : 'link-dark' ?> " href="<?= site_url('notes?status=private') ?>">Private Note</a></li>
                    </ul>
                </div>
            </header>

            <div class="card-body p-3 bg-light">
            <!-- Filter/Search Field inside dashboard -->
            <div class="mb-4">
                <input type="text" class="form-control" placeholder="Filter Notes...">
            </div>

            <!-- Card Body -->
            
            <?php if ($notes): ?>
                <!-- Note Collection Stack -->
                <div class="d-flex flex-column gap-2">
                    <?php foreach ($notes as $note): ?>

                        <div class="card shadow-sm rounded-3 mb-2">
                            <div class="card-body p-4">
                                <!-- Card Header: User Info, Avatar, and Context Dropdown -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <!-- User Avatar -->
                                        <div class="bg-primary text-white rounded-circle d-none d-md-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                            <i class="bi bi-person-fill m-0 fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark"><?= esc("$note->first_name $note->last_name") ?></h6>
                                            <small class="text-muted">@<?= esc($note->username) ?> &bull; <?= esc($note->published_date) ?></small>
                                        </div>
                                    </div>
                                    <!-- Right-Side Options Dropdown Button -->
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-pill border px-3 d-flex align-items-center gap-1.5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots text-muted"></i>
                                            <span class="fw-semibold text-secondary" style="font-size: 0.8rem;">Manage</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item py-2 text-dark" href="<?= site_url("notes/edit/$note->note_id") ?>">
                                                    <i class="bi bi-pencil-square me-2 text-muted"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <!-- Delete Note -->
                                            <li>
                                                <form action="<?= site_url("notes/delete/$note->note_id") ?>" method="post" onsubmit="return confirm('Are you sure you want to permanently delete this document? This action cannot be undone.');">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="dropdown-item py-2 text-danger bg-transparent border-0 w-100 text-start">
                                                        <i class="bi bi-trash3 me-2"></i>Delete Note
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>     

                                <!-- Card Content -->
                                <a href="<?= site_url("notes/show/$note->note_id") ?>" class="text-decoration-none">
                                    <h5 class="fw-bold text-dark mb-0"><?= esc($note->note_title) ?></h5>
                                    <p class="text-secondary mb-3 text-truncate-2" style="font-size: 0.95rem; line-height: 1.5;">
                                        <?= esc($note->body_summary) ?>
                                    </p>
                                </a>

                                <!-- Card Footer: Metadata Indicators -->
                                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-2">
                                    <div class="text-muted small d-flex align-items-center">
                                        <?php if($note->pinned_count): ?>
                                        <i class="bi bi-pin-angle-fill text-primary me-1"></i> <span class="me-2"><?= $note->pinned_count ?> Pinned</span>
                                        <?php endif ?>
                                        <i class="bi bi-chat-left-text me-1"></i> <span><?= $note->comment_count ?> comments</span>
                                    </div>
                                    <span class="badge bg-secondary px-2 py-1"><?= $note->notebook_name ?></span>
                                </div>
                            </div>
                        </div>


                    <?php endforeach ?>
                </div>
            <?php else: ?>
                <!-- Parent container with centered alignments and defined spacing metrics -->
                <div class="d-flex flex-column gap-3 align-items-center justify-content-center text-center p-5 w-100" style="min-height: 350px;">

                    <!-- 1. Centered Empty State Image Wrapper -->
                    <div class="empty-image-container mb-2">
                        <img src="assets/images/kuma-be-kind.webp" alt="No notes found" class="img-fluid opacity-60" style="max-width: 260px; height: auto;">
                    </div>

                    <!-- 2. Centered Header Text & Context Description Block -->
                    <div class="text-center">
                        <h3 class="text-dark mb-1">There are no <?= $notes_status ?> notes</h3>
                        <p class="text-muted small mb-0 mx-auto" style="max-width: 360px;">
                            There are no notes saved you <?= $notes_status ?> collection yet. Click the button above to create one.
                        </p>
                    </div>

                </div>
            <?php endif ?>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>
