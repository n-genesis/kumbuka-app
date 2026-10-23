<!-- app/Views/pages/account/privacy.php -->
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
            <!-- Page Header Title -->
            <h2 class="h5 mb-4 text-dark border-bottom pb-2"><?= $pageHeader ?></h2>
        </header>
        <section>
            <div class="row">
                <!-- Top nav -->
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-fill mb-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?= site_url('account') ?>">Edit
                                Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('account/settings') ?>">Account Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= site_url('account/privacy') ?>">Privacy Settings</a>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <!-- User Privacy Settings Card -->
                    <div class="card">
                        <form id="user-notification-form" action="<?= site_url('account/privacy/update') ?>" method="post" data-km="form">
                            <?= csrf_field() ?>
                            <!-- Card Body Form -->
                            <div class="card-body p-4 bg-light">
                                <!-- Setting Item 1: Account Visibility -->
                                <div class="card border-0 shadow-sm rounded-3 mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="me-3">
                                                <h4 class="text-dark mb-1 d-flex align-items-center">
                                                    <i class="bi bi-shield-shaded text-muted me-2"></i>Account Privacy
                                                </h4>
                                                <p class="text-muted mb-0" style="line-height: 1.4;">
                                                    Will <b>Hide</b> <i class="bi bi-eye-slash-fill"></i> your account contact
                                            information and social media links on you profile page.
                                                </p>
                                            </div>
                                            <div class="form-check form-switch pt-1">
                                                <input class="form-check-input" type="checkbox" role="switch" name="accountPrivacy" id="switchPrivate" value="1" <?= $accountPrivacy === '1' ? 'checked' : '' ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Setting Item 2: Default Note Visibility -->
                                <div class="card border-0 shadow-sm rounded-3 mb-3">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 mb-3 mb-md-0">
                                                <h4 class="text-dark mb-1 d-flex align-items-center">
                                                    <i class="bi bi-file-post text-muted me-2"></i>Your Profile
                                                </h4>
                                                <p class="text-muted mb-0" style="line-height: 1.4;">
                                                    Change the visablility of your Profile to where only you, your friends, or anyone can visit your profile.
                                                </p>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-select text-secondary" name="visibility">
                                                    <option value="public" <?= (isset($visibility) && $visibility == 'public') ? 'selected' : '' ?>>Public (Everyone can view)</option>
                                                    <option value="followers" <?= (isset($visibility) && $visibility == 'followers') ? 'selected' : '' ?>>Followers Only</option>
                                                    <option value="private" <?= (isset($visibility) && $visibility == 'private') ? 'selected' : '' ?>>Private (Just me)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Setting Item 3: Activity Feed Broadcaster -->
                                <div class="card border-0 shadow-sm rounded-3 mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="me-3">
                                                <h4 class="text-dark mb-1 d-flex align-items-center">
                                                    <i class="bi bi-postage-fill text-muted me-2"></i>Follower(s)
                                                </h4>
                                                <p class="text-muted mb-0 small" style="line-height: 1.4;">
                                                    Allow other Users to <b class="text-primary">"Follow"</b> your account an get notifications post &amp; share new notes. <i class="text-primary"><b>Note:</b> To follow other users you must allow others to follow your account. </i>
                                                </p>
                                            </div>
                                            <div class="form-check form-switch pt-1">
                                                <input class="form-check-input" type="checkbox" role="switch" name="allowFollowers" value="1" id="switchBroadcast"
                                                    <?= $allowFollowers === '1' ? 'checked' : '' ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Footer Info Row -->
                            <footer class="card-footer d-flex align-items-center justify-content-between">
                                <a href="<?= site_url('home') ?>" class="btn btn-outline-secondary mr-auto">
                                    <i class="bi bi-box-arrow-left"></i> Back Home
                                </a>
                                <!-- Check if Demo user -->
                                <?php if(auth()->id() != 3):?>
                                <button type="submit" class="btn btn-primary mr-2" data-km="submit">
                                    <i class="bi bi-floppy" id="new-note-save"></i>
                                    Save Settings
                                </button>
                                <?php else: ?>
                                    <div class="alert alert-primary mb-0" role="alert">
                                        Operation block on guest account
                                    </div>
                                <?php endif ?>
                            </footer>
                        </form>
                    </div>
                </div>

            </div>
        </section>

    </div>
</main>

<?= $this->endSection(); ?>