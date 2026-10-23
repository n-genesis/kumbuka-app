<!-- app/Views/pages/activity/comments/index.php -->
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

        <!-- Comment Section -->
        <div class="p-3 mb-4">
            <header class="pb-3 mb-3 border-bottom gap-3">
                <h1 class="h4 mb-1"><i class="bi bi-chat-left-text text-primary me-2"></i>Comments Activity</h1>
            </header>

            <!-- Comment Section -->
            <section class="card border rounded shadow-sm mx-auto">
                <!-- Card Header with Navigation Tabs -->
                <header class="card-header pt-3 pb-0 px-4 border-bottom">

                    <!-- Bootstrap 5 Navigation Tabs Toggle -->
                    <ul class="nav nav-tabs border-bottom-0 gap-1" id="commentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link active fw-semibold small py-2 px-3 border border-secondary-subtle border-bottom-0"
                                id="my-comments-tab" data-bs-toggle="tab" data-bs-target="#my-comments" type="button"
                                role="tab" aria-controls="my-comments" aria-selected="true"
                                style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                                My Comments <span
                                    class="badge bg-light text-secondary ms-1 border border-secondary-subtle"><?= count($comments) ?></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link fw-semibold text-secondary small py-2 px-3 border border-transparent border-bottom-0"
                                id="received-comments-tab" data-bs-toggle="tab" data-bs-target="#received-comments"
                                type="button" role="tab" aria-controls="received-comments" aria-selected="false"
                                style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                                On My Notes <span
                                    class="badge bg-light text-secondary ms-1 border border-secondary-subtle"><?= count($comments_received) ?></span>
                            </button>
                        </li>
                    </ul>
                </header>

                <!-- Card Body Containing the Switchable Tab Panes -->
                <div class="card-body p-3 tab-content" id="commentTabsContent">

                    <!-- Comments made BY the user -->
                    <div class="tab-pane fade show active" id="my-comments" role="tabpanel">
                        <?php if (!empty($comments)): ?>
                            <div class="list-group list-group-flush">
                                <?php foreach ($comments as $comment): ?>
                                    <!-- Comment Item 1 -->
                                    <div class="list-group-item border border-secondary-subtle rounded-3 my-1 p-3 bg-light-subtle hover-bg">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="small text-muted">
                                                You commented on <a href="<?= site_url("notes/show/$comment->note_id") ?>"
                                                    class="fw-semibold text-decoration-none text-dark"><?= esc($comment->note_title) ?></a>
                                            </span>
                                            <span class="text-muted flex-shrink-0 ms-2"
                                                style="font-size: 0.75rem;"><?= $comment->created_at ?></span>
                                        </div>
                                        <!-- Comment Content -->
                                        <p class="text-secondary small mb-2 ps-2 border-start border-primary border-2">
                                            <?= esc($comment->content) ?>
                                        </p>
                                        <div class="d-flex align-items-center">
                                        <!-- Delete -->
                                         <form method="POST" action="<?= site_url("activity/comments/delete/$comment->comment_id") ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-link text-decoration-none text-danger p-0 align-baseline" style="font-size: 0.75rem;">Delete</button>
                                        </form>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                            <div class="mt-2 text-center">
                            <h5>No Comment posted</h5>
                                <p>You haven't posted any comments.</p>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- Comments received ON the user's notes -->
                    <div class="tab-pane fade" id="received-comments" role="tabpanel">
                        <?php if ($comments_received): ?>
                            <div class="list-group list-group-flush">
                                <?php foreach ($comments_received as $comment): ?>
                                    <!-- Received Comments -->
                                    <div class="list-group-item border border-secondary-subtle rounded-3 my-1 p-3 hover-bg">
                                        <div class="d-flex align-items-start gap-3">
                                            <!-- Tiny User Profile Avatar Placeholder -->
                                            <div class="bg-secondary-subtle text-secondary border border-secondary-subtle rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                                style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                <?= ucfirst(substr($comment->first_name, 0, 1)) . ucfirst(substr($comment->last_name, 0, 1)) ?>
                                            </div>
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <span class="small text-dark">
                                                        <strong class="fw-semibold"><?= esc("$comment->first_name $comment->last_name") ?></strong>
                                                        left a reply on <a
                                                            href="<?= site_url("notes/show/$comment->note_id") ?>"
                                                            class="text-decoration-none fw-semibold"><?= esc($comment->note_title) ?></a>
                                                    </span>
                                                    <span class="text-muted small flex-shrink-0 ms-2" style="font-size: 0.75rem;"><?= $comment->created_at ?></span>
                                                </div>
                                                <p class="text-secondary small mb-2">
                                                    <?= esc($comment->content) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                        <!-- Enpty -->
                        <div class="mt-2 text-center">
                            <h5>No Comment posted</h5>
                            <p>There are no comment posted on your notes.</p>
                        </div>
                        <?php endif ?>
                    </div>
                    
                </div>
            </section>

        </div>
    </div>
</main>

<?= $this->endSection(); ?>