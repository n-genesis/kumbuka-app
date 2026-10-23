<!-- app/Views/pages/admin/users/create.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>

<div class="col-sm-12">

    <div class="card">
        <!-- Edit User Form -->
        <form action="<?= site_url('admin/users/store') ?>" method="post" class="needs-validation" novalidate>

            <?= csrf_field() ?>

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between">
                <div class="header-title flex-fill">
                    <h4 class="card-title">Add User</h4>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" required>
                <div class="invalid-feedback">Please enter a username.</div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-text">Password must be at least 8 characters long and contain a mix of letters, numbers, and symbols.</div>
                <div class="invalid-feedback">Please enter a password.</div>
            </div>
            
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                <div class="invalid-feedback">Please confirm the password.</div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">User Groups</label>
                <div class="row">
                    <?php foreach ($groups as $group): ?>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="groups[]" value="<?= $group['group'] ?>" id="group_<?= $group['group'] ?>" <?= in_array($group['group'], old('groups', [])) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="group_<?= $group['group'] ?>">
                                    <?= esc(ucfirst($group['group'])) ?>
                                    <small class="d-block text-muted"><?= esc($group['group'] == 'admin' ? 'Administrator access' : 'Regular user access') ?></small>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="invalid-feedback">Please select at least one group.</div>
            </div>
            </div>

            <footer class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?= site_url('admin/users') ?>" class="btn btn-secondary mr-auto">
                    <i class="bi bi-box-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">Create User</button>
            </footer>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    // Form validation
    (function() {
        'use strict';
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                // Check if at least one group is selected
                var groupCheckboxes = form.querySelectorAll('input[name="groups[]"]:checked');
                if (groupCheckboxes.length === 0) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.querySelector('.invalid-feedback').style.display = 'block';
                }
                
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<?= $this->endSection() ?>