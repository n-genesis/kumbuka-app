<!-- app/Views/pages/home/index.php -->
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

            <!-- QuickPick Dashboard Heading -->
            <h2 class="h5 mb-4 text-dark border-bottom pb-2">Your QuickPicks</h2>
        </header>

        <!-- Content Grid -->
        <div class="row g-4">

            <!-- Top Left Seciton -->
            <section class="col-lg-8 col-sm-12">
                <!-- Widget: User Latest Notes Feed -->
                <?= view_cell('UserFeedSectionCell') ?>
            </section>

            <!-- Top aside -->
            <section class="col-lg-4 col-sm-12">
                <!-- Widget: Friends -->
                <?= view_cell('FriendListCell') ?>
                <div class="py-2"></div>
                <!-- Widget: Followers -->
                <?= view_cell('FollowerListCell') ?>
            </section>


            <section class="col-lg-4 col-sm-12">
                <!-- Widget: Pinned Notes -->
                <?= view_cell('PinnedNotesCell') ?>
            </section>
            
            <section class="col-lg-4 col-sm-12">
                <!-- Widget: Notifications -->
                <?= view_cell('NotificationSectionCell') ?>
            </section>

            <section class="col-lg-4 col-sm-12">
                <!-- Widget: Pinned Notebooks -->
                <?= view_cell('PinnedNotebooksCell') ?>
            </section>
            
        </div>
    </div>
</main>

<?= $this->endSection(); ?>