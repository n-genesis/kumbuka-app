<?= $this->extend('layouts/main'); ?>

<!-- Head stylesheets -->
<?= $this->section('styles') ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>

<!-- Navbar -->
<?= $this->include('partials/top-navbar') ?>

<!-- Wrapper for Sidebar and Content -->
<div class="app-container">

    <!-- Main Sidebar -->
    <?= view_cell('LeftAsideCell') ?>

    <!-- Right Side Container (Houses Main Content + Pinned Footer) -->
    <div class="content-wrapper">
        <!-- Show session message & errors -->
        <?php if (session('error') !== null || session('errors') !== null || session('message') !== null): ?>
        <div id="alerts" class="container">
            <div class="row d-flex justify-content-center pt-4">
                <div class="col-8">
                    
                    <!-- Single Error String Alert -->
                    <?php if (session('error') !== null): ?>
                        <div class="alert alert-danger small" role="alert">
                            <?= esc(session('error')) ?>
                        </div>
                    <?php endif ?>

                    <!-- Validation Array / Multiple Errors Alert -->
                    <?php if (session('errors') !== null): ?>
                        <div class="alert alert-danger small" role="alert">
                            <?php if (is_array(session('errors'))): ?>
                                <?php foreach (session('errors') as $error): ?>
                                    <?= esc($error) ?><br>
                                <?php endforeach ?>
                            <?php else: ?>
                                <?= esc(session('errors')) ?>
                            <?php endif ?>
                        </div>
                    <?php endif ?>

                    <!-- Success Messages Alert -->
                    <?php if (session('message') !== null): ?>
                        <div class="alert alert-success small" role="alert">
                            <?= esc(session('message')) ?>
                        </div>
                    <?php endif ?>
                    
                </div>
            </div>
        </div>
        <?php endif ?>

        <!--Render Section backend -->
        <?= $this->renderSection('backend'); ?>

        <!-- Include footer tag -->
        <?= $this->include('partials/footer') ?>
    </div>
</div>

<!-- END Main -->
<?= $this->endSection(); ?>

<!-- Additional  JS Scripts -->
<?= $this->section('js') ?>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<!-- Toggle light and dark themes -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            toggleThemeMenu();
        });
    </script>
<?= $this->endSection() ?>