<!-- ADMIN Backend User List -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Settings</h4>
            </div>
            <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-primary">
                <i class="bi bi-box-arrow-left"></i> Cancel
            </a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
                <form action="<?= site_url('admin/settings/update') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="site_name" name="appName" value="<?= old('appName', $siteSettings['appName']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Description</label>
                        <textarea class="form-control" id="site_description" name="appDesc" rows="3"><?= old('appDesc', $siteSettings['appDesc']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="admin_email" name="appEmail" value="<?= old('appEmail', $siteSettings['appEmail']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Registration</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="allow_registration" name="allowRegistration" <?= $siteSettingsOpts['allowRegistration'] ?>>
                            <label class="form-check-label" for="allow_registration">
                                Allow new user registration
                            </label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Maintenance Mode</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode">
                            <label class="form-check-label" for="maintenance_mode">
                                Enable maintenance mode
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>
    </div>
</div>


<?= $this->endSection(); ?>

