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
        <div class=" p-4 mb-4">
            <header class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3 border-bottom gap-3">
                <div>
                    <h1 class="h4 mb-1">Comments</h1>
                    <p class="text-muted small mb-0">2 active notes found</p>
                </div>
                <div class="d-flex gap-2">
                    <select class="form-select" style="width: auto;">
                        <option>All Notes</option>
                    </select>
                </div>
            </header>

            <!-- Filter/Search Field inside -->
            <div class="mb-4">
                <input type="text" class="form-control" placeholder="Filter Notes...">
            </div>


            <!-- Comment Section -->
            <section class="card bg-white border border-secondary-subtle rounded-3 shadow-sm mx-auto">
                <!-- Card Header with Navigation Tabs -->
                <header class="card-header bg-white pt-3 pb-0 px-4 border-bottom border-secondary-subtle">
                    <h5 class="fw-bold text-dark mb-3">Comments Activity</h5>

                    <!-- Bootstrap 5 Navigation Tabs Toggle -->
                    <ul class="nav nav-tabs border-bottom-0 gap-1" id="commentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link active fw-semibold small py-2 px-3 border border-secondary-subtle border-bottom-0"
                                id="my-comments-tab" data-bs-toggle="tab" data-bs-target="#my-comments" type="button"
                                role="tab" aria-controls="my-comments" aria-selected="true"
                                style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                                My Comments <span
                                    class="badge bg-light text-secondary ms-1 border border-secondary-subtle">4</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link fw-semibold text-secondary small py-2 px-3 border border-transparent border-bottom-0"
                                id="received-comments-tab" data-bs-toggle="tab" data-bs-target="#received-comments"
                                type="button" role="tab" aria-controls="received-comments" aria-selected="false"
                                style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                                On My Notes <span
                                    class="badge bg-primary-subtle text-primary ms-1 border border-primary-subtle">2</span>
                            </button>
                        </li>
                    </ul>
                </header>

                <!-- Card Body Containing the Switchable Tab Panes -->
                <div class="card-body p-3 tab-content" id="commentTabsContent">

                    <!-- STREAM 1: Comments made BY the user -->
                    <div class="tab-pane fade show active" id="my-comments" role="tabpanel"
                        aria-labelledby="my-comments-tab">
                        <div class="list-group list-group-flush">
                            <?php if (!empty($comments)): ?>
                                <?php foreach ($comments as $comment): ?>
                                    <!-- Comment Item 1 -->
                                    <div
                                        class="list-group-item border border-secondary-subtle rounded-3 my-1 p-3 bg-light-subtle hover-bg">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="small text-muted">
                                                You commented on <a href="#"
                                                    class="fw-semibold text-decoration-none text-dark">Database Migration
                                                    Scripts</a>
                                            </span>
                                            <span class="text-muted flex-shrink-0 ms-2"
                                                style="font-size: 0.75rem;"><?php $comment->create_at ?></span>
                                        </div>
                                        <p class="text-secondary small mb-2 ps-2 border-start border-primary border-2">
                                            <?= esc($comment->content) ?></p>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= site_url('activity/comments/show/' . $comment->id) ?>"
                                                class="btn btn-outline-secondary">View</a>
                                            <a href="<?= site_url('activity/comments/edit/' . $comment->id) ?>"
                                                class="btn btn-outline-primary">Edit</a>
                                            <a href="<?= site_url('activity/comments/remove/' . $comment->id) ?>"
                                                class="btn btn-outline-danger">Delete</a>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>
                                <h1> There are not comments to list</h1>
                            <?php endif ?>

                        </div>
                    </div>

                    <!-- STREAM 2: Comments received ON the user's notes -->
                    <div class="tab-pane fade" id="received-comments" role="tabpanel"
                        aria-labelledby="received-comments-tab">
                        <div class="list-group list-group-flush">

                            <!-- Received Comment Item 1 -->
                            <div class="list-group-item border border-secondary-subtle rounded-3 my-1 p-3 hover-bg">
                                <div class="d-flex align-items-start gap-3">
                                    <!-- Tiny User Profile Avatar Placeholder -->
                                    <div class="bg-secondary-subtle text-secondary border border-secondary-subtle rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                        style="width: 32px; height: 32px; font-size: 0.75rem;">
                                        AM
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="small text-dark">
                                                <strong class="fw-semibold">Adrian Garber</strong> left a reply on <a
                                                    href="#" class="text-decoration-none fw-semibold">That One Note Post
                                                    Refactoring</a>
                                            </span>
                                            <span class="text-muted small flex-shrink-0 ms-2"
                                                style="font-size: 0.75rem;">15m ago</span>
                                        </div>
                                        <p class="text-secondary small mb-2">
                                            "Lorem ipsum dolor sit amet consectetur adipiscing elit. Lorem ipsum dolor
                                            sit amet consectetur adipiscing elit."
                                        </p>
                                        <!-- Mini context action nodes -->
                                        <div class="d-flex gap-2">
                                            <a href="#"
                                                class="btn btn-sm btn-link text-decoration-none text-muted p-0 small"
                                                style="font-size: 0.75rem;"><i class="bi bi-reply-fill"></i> Reply</a>
                                            <span class="text-muted-subtle small">•</span>
                                            <a href="#"
                                                class="btn btn-sm btn-link text-decoration-none text-muted p-0 small"
                                                style="font-size: 0.75rem;"><i class="bi bi-check-circle"></i>
                                                Resolve</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</main>

<?= $this->endSection(); ?>