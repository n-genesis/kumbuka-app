<!-- app/Views/pages/notes/show.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>

<!-- Main Right Side Content Area -->
<main class="main-content py-4 px-2">

        <!-- Header Component -->
        <div>
            <!-- Breadcrumbs -->
            <?php if (!empty($breadcrumbHtml)): ?>
                <?= $breadcrumbHtml ?>
            <?php endif; ?>
        </div>

        <!-- Notes Post & Comment Cell -->
        <div class="mb-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3 gap-3">
                <div>
                    <div class="d-flex align-items-center gap-3">
                        <!-- User Profile Avatar Image Wrapper -->
                        <div class="logo-wrapper position-relative" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden;">
                            <img src="<?= base_url($note->avatar) ?>" alt="<?= esc($note->username) ?>"
                                class="w-100 h-100 object-fit-cover">
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-dark small"><?= esc("$note->first_name $note->last_name") ?>
                            </h6>
                            <p class="text-muted mb-0 small" style="font-size: 0.75rem;">Posted in
                                <a href="<?= site_url("notebooks/$note->notebook_id") ?>"
                                    class="text-decoration-none fw-semibold"><?= esc($note->notebook_name) ?></a> •
                                <?= $note->published_date ?? '-' ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Date and Publish Badge and Status -->
                <p class="text-muted mb-0 small">Updated: <span
                        class="badge bg-light text-secondary border border-secondary-subtle rounded-pill px-2.5 py-1"><?= esc($note->updated_date ?? '-') ?></span>
                </p>
            </div>

            <!-- Main Note Post Card -->
            <div class="card border border-secondary-subtle rounded-3 shadow-sm mx-auto mb-4">

                <!-- Card Header: User Info & Meta Metadata Actions -->
                <div class="card-header pt-3 pb-2 px-4 border-bottom border-secondary-subtle d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div class="">
                        <!-- Note Header Title Underneath Metadata -->
                        <h4 class="fw-light text-dark mb-2" style="letter-spacing: -0.3px;">
                            <?= esc($note->note_title ?? 'Note') ?></h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                    <?php if ($note->isPinned): ?>
                        <a href="<?= site_url("pin/notes/$note->id") ?>" class="btn btn-sm btn-primary ms-auto me-2">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="fw-semibold me-1">Pinned</span>
                        </a>
                    <?php else: ?>
                        <a href="<?= site_url("pin/notes/$note->id") ?>"
                            class="btn btn-sm btn-outline-primary me-2">
                            <i class="bi bi-check-circle"></i>
                            <span class="fw-semibold me-1">Pin</span>
                        </a>
                    <?php endif ?>
                    <!-- If Owner or admin -->
                    <?php if ($note->user_id == auth()->id() && auth()->loggedIn()): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" style="box-shadow: none;">
                                Options
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border border-secondary-subtle shadow-sm">
                                <li><a class="dropdown-item small" href="<?= site_url("notes/edit/$note->note_id") ?>">
                                    <i class="bi bi-pencil me-2"></i>Edit</a></li>
                                <li>
                                    <!-- Delete Note -->
                                    <form action="<?= site_url("notes/delete/$note->note_id") ?>" method="post" onsubmit="return confirm('Are you sure you want to permanently delete this document? This action cannot be undone.');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="dropdown-item py-2 text-danger bg-transparent border-0 w-100 text-start">
                                            <i class="bi bi-trash3 me-2"></i>Delete Note
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
                </div>


                <!-- Card Body: Main Content Block -->
                <div class="card-body p-4">

                    <?php if ($noteImages): ?>
                        <!-- Image Carousel -->
                        <div id="noteCarousel" class="carousel slide mb-3">
                            <div class="carousel-inner border rounded">
                                <?php foreach ($noteImages as $index => $image): ?>
                                    <div class="carousel-item <?= ($index == 0) ? 'active' : '' ?>">
                                        <img src="<?= base_url($image->file_path) ?>" class="d-block w-100" alt="First slide">
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#noteCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#noteCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    <?php endif ?>

                    <!-- Post Text Paragraphs -->
                    <?= nl2br($note->content ?? '') ?>
                </div>

                <!-- Card Footer: Interactive Social Action Counters -->
                <footer class="card-footer bg-white border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                    <!-- Interactive buttons -->
                    <div class="d-flex align-items-center gap-3">
                        <button
                            class="btn btn-link text-decoration-none text-secondary p-0 small hover-dark d-flex align-items-center">
                            <i class="bi bi-pin-angle-fill text-primary"></i>
                            <span class="fw-semibold me-1"><?= $note->pinned_count ?></span> Pins</button>
                        <button
                            class="btn btn-link text-decoration-none text-secondary p-0 small hover-dark d-flex align-items-center">
                            <i class="bi bi-chat-left-text"></i> <span
                                class="fw-semibold me-1"><?= $note->comment_count ?></span> Comments
                        </button>
                    </div>

                    <!-- Right align indicator element -->
                    <div class="text-muted small d-flex align-items-center gap-1">
                        
                    </div>
                </footer>

            </div>

            <?php if (auth()->loggedIn() && $note->allow_comments): ?>
                <!-- Main Comments Section Container Card -->
                <?= view_cell('CommentSectionCell', ['note_id' => $note->note_id]); ?>
            <?php endif ?>

        </div>

</main>

<?= $this->endSection(); ?>