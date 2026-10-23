<!-- app/Views/pages/profile/index.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>
<main class="main-content py-4 px-2">
    
<div class="container-fluid">

    <!-- Header Component -->
    <header>
        <!-- Breadcrumbs -->
        <?php if (!empty($breadcrumbHtml)): ?>
            <?= $breadcrumbHtml ?>
        <?php endif; ?>
    </header>

    <!-- Thumbnail tile wrapper -->
    <div class="card border-defined rounded-3 shadow-sm mx-auto w-100 mb-3" style="max-height: 460px;">
        <!-- Bounded Cover Image Container (4:3 Landscape Ratio) -->
        <div class="ratio ratio-4x3 rounded overflow-hidden bg-light border-bottom border-defined">
            <img src="<?= base_url($user->cover_image) ?>" alt="Notebook Cover Asset" class="object-fit-cover">
        </div>
    </div>

    <!-- SECTION 1: Public Profile Banner Summary Component Card -->
    <section class="card border-defined rounded-3 shadow-sm p-4 mb-3" aria-label="User Profile Summary">
        
        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start text-center text-sm-start gap-4">

            <!-- Profile Avatar Circular Box Wrapper -->
            <div class="logo-wrapper border border-defined rounded-circle shadow-sm flex-shrink-0" style="width: 96px; height: 96px; overflow: hidden;">
                <img src="<?= base_url($user->avatar) ?>" alt="<?= esc("$user->first_name $user->last_name") ?> Profile Avatar" class="w-100 h-100">
            </div>

            <!-- Core Description Fields -->
            <div class="w-100">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center align-items-sm-start gap-3 mb-2">
                    <div>
                        <h3 class="fw-bold mb-1"><?= esc("$user->first_name $user->last_name") ?> <i
                                class="bi bi-patch-check-fill text-primary small" style="font-size: 1.1rem;"
                                title="Verified Account"></i></h3>
                        <p class="small mb-0 fw-medium">@<?= esc($user->username) ?>
                        </p>
                    </div>
                    <!-- Actions Stacking Management: Full-width on mobile, auto width on desktop -->
                    <div class="d-flex gap-2">
                        <!-- Show if User is logged in or not viewing their own profile -->
                        <?php if ($user->user_id != auth()->id() && auth()->loggedIn()): ?>
                            <!-- Show Follow/Unfollow Button based on the current follow status -->
                            <?php if ($followerModel->isFollowing(auth()->id(), $user->user_id)): ?>
                                <form action="<?= base_url('follow/toggle/' . $user->user_id) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="followed_id" value="<?= $user->user_id ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 w-100 w-sm-auto">
                                        Following <i class="bi bi-person-fill-check"></i>
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="<?= base_url('follow/toggle/' . $user->user_id) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="followed_id" value="<?= $user->user_id ?>">
                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 py-2 w-100 w-sm-auto">Follow <i
                                        class="bi bi-person-plus-fill"></i></button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <p class="text-muted small line-height-relaxed mb-3">
                    <?= esc($user->bio) ?>
                </p>

                <!-- Stats Analytics Subbar Counters Matrix -->
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start gap-3 small border-bottom pb-2">
                    <div><strong class="text-emphasis"><?= $user->note_count ?></strong> Notes Posted</div>
                    <div class="link-body-emphasis" aria-hidden="true">•</div>
                    <div><strong class="text-emphasis"><?= $user->comment_count ?></strong> Comments Left</div>
                    <div class="link-body-emphasis" aria-hidden="true">•</div>
                    <div><strong class="text-emphasis"><?= count($user->followers) ?></strong> Followers</div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 2: Dynamic Content Area (Filter Nav Tabs Switch) -->
    <section class="card border-defined rounded-3 shadow-sm" aria-label="User Activity Matrix">

        <!-- Structural Switch Tab Headers -->
        <div class="card-header pt-3 pb-0 px-4 border-bottom border-defined">
            <ul class="nav nav-tabs border-bottom-0 gap-1" id="profileTabs" role="tablist">
                <!-- Note Tab -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-semibold small py-2 px-3 border border-defined border-bottom-0" id="notes-tab" data-bs-toggle="tab" data-bs-target="#user-notes" type="button" role="tab" aria-controls="user-notes" aria-selected="true"
                        style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                        Notes Feed
                    </button>
                </li>
                <!-- Comment Tab -->
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link fw-semibold small py-2 px-3 border border-transparent border-bottom-0"
                        id="comments-tab" data-bs-toggle="tab" data-bs-target="#user-comments" type="button" role="tab"
                        aria-controls="user-comments" aria-selected="false"
                        style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                        Comments Activity
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Canvas Content Panel Wrapper -->
        <div class="card-body p-3 p-sm-4 tab-content" id="profileTabsContent">

            <!-- User's Note Posts Collection -->
            <div class="tab-pane fade show active" id="user-notes" role="tabpanel" aria-labelledby="notes-tab">
                <!-- User Notes -->
                <?= view_cell('UserNoteSectionCell', ['userId' => $user->user_id]) ?>
            </div>

            <!-- User's Comment Panel  Collection -->
            <div class="tab-pane fade" id="user-comments" role="tabpanel">
                <div class="list-group list-group-flush">
                    <?php if($comments):?>
                        <?php foreach ($comments as $comment): ?>
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
                                            <strong class="fw-semibold"><?= esc("$comment->first_name $comment->last_name") ?></strong> left a reply on <a
                                                href="<?= site_url("notes/show/$comment->note_id") ?>" class="text-decoration-none fw-semibold"><?= esc($comment->note_title) ?></a>
                                        </span>
                                        <span class="text-muted small flex-shrink-0 ms-2"
                                            style="font-size: 0.75rem;"><?= $comment->created_at ?></span>
                                    </div>
                                    <p class="text-secondary small mb-2">
                                        <?= esc($comment->content) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    <?php else: ?>
                    <div class="card empty-component-box shadow-sm">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="bi bi-chat-left-text mb-2 d-block"></i>
                                <div class="fw-bold small text-dark">No comments left.</div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
            </div>

        </div>
    </section>
</div>
</main>
<?= $this->endSection(); ?>