<!-- app/Views/pages/admin/users/edit.php -->

<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>

<div class="col-sm-12">

    <!-- Banned User Alert -->
    <?php if ($user->status !== null): ?>
        <div class="alert  bg-danger" role="alert">
            <div class="iq-alert-icon">
                <i class="bi bi-bookmark-x flex-shrink-0 me-2"></i>
            </div>
            <div class="iq-alert-text">This user is currently banned. They will not be able to log in or access their
                account until unbanned.</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="bi bi-x-circle"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- Email Activation ALERT -->
    <?php if ($pendingActivation): ?>
        <form action="<?= site_url('admin/users/activate/' . $user->id) ?>" method="post">
            <?= csrf_field() ?>
            <!-- Alert Box -->
            <div class="alert bg-white alert-danger" role="alert">
                <div class="iq-alert-icon">
                    <i class="bi bi-envelope-exclamation"></i>
                </div>
                <!-- Alert Text -->
                <div class="iq-alert-text">
                    <h4 class="alert-heading mb-1">Not Activated</h4>
                    <p class="mb-0">This user <b class="text-danger">HAS NOT</b> activated their account via Email. Do you
                        want
                        to force activate this user?
                    </p>
                </div>
                <!-- Custom Action Button -->
                <button type="submit" class="btn btn-ms btn-outline-success">
                    <i class="bi bi-envelope-exclamation"></i> Activate</button>
            </div>
        </form>
    <?php endif; ?>

    <div class="card">
        <!-- Edit User Form -->
        <form action="<?= base_url('admin/users/update/' . $user->id) ?>" method="post" data-km="form" class="needs-validation"
            novalidate>

            <?= csrf_field() ?>

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between">
                <div class="header-title flex-fill">
                    <h4 class="card-title">
                        User
                        <?php if (!$user->active): ?>
                            <span class="badge badge-danger">Inactive</span>
                        <?php else: ?>
                            <span class="badge badge-success">Active</span>
                        <?php endif; ?>
                    </h4>
                </div>
                <!-- User active status checkbox -->
                <div class="custom-control custom-checkbox mr-3">
                    <input type="checkbox" name="active" class="custom-control-input" id="activeCheckbox"
                        <?= $user->active ? 'checked' : '' ?>>
                    <label class="custom-control-label" for="activeCheckbox">Active</label>
                </div>
                <!-- Ban User -->
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-success active">
                        <input type="radio" name="status" id="activeBtn" value="active"> Unbanned
                    </label>
                    <label class="btn btn-danger">
                        <input type="radio" name="status" id="bannedBtn" value="banned" <?= $user->status !== null ? 'checked' : '' ?>> Banned
                    </label>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                <!-- Banned Status Message / Show if User status is NOT null -->
                <div class="collapse <?= $user->status !== null ? 'show' : '' ?>" id="collapseStatusMsg">
                    <div class="mb-3">
                        <label for="userStatus" class="form-lable">Status Message</label>
                        <textarea class="form-control is-invalid" name="status_message" id="userStatusMsg"
                            rows="3"><?= old('status_message', $user->status_message) ?></textarea>
                        <div class="invalid-feedback">A message to add to users account.</div>
                    </div>
                </div>

                <!-- User First and Last name -->
                 <div class="form-row mb-3">
                    <div class="col">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name"
                            value="<?= old('first_name', $user->first_name) ?>" readonly>
                        <div class="invalid-feedback">Please enter a First Name.</div>
                    </div>
                    <div class="col">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name"
                            value="<?= old('last_name', $user->last_name) ?>" readonly>
                        <div class="invalid-feedback">Please enter a First Name.</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="<?= old('username', $user->username) ?>" required>
                    <div class="invalid-feedback">Please enter a username.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= old('email', $user->email) ?>" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="form-text">Leave blank to keep current password. New password must be at least 8
                        characters long and contain a mix of letters, numbers, and symbols.</div>
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                    <div class="invalid-feedback">Passwords do not match.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">User Groups</label>
                    <div class="row">
                        <?php foreach ($groups as $group): ?>
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="groups[]"
                                        value="<?= $group['group'] ?>" id="group_<?= $group['group'] ?>"
                                        <?= in_array($group['group'], old('groups', $userGroups)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="group_<?= $group['group'] ?>">
                                        <?= esc(ucfirst($group['group'])) ?>
                                        <small class="d-block text-muted">
                                            <?= esc($group['group'] == 'admin' ? 'Administrator access' : 'Regular user access') ?>
                                        </small>
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
                <button type="submit" class="btn btn-primary">Update User</button>
            </footer>
            
        </form>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    // Form validation
    (function () {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                // Check if at least one group is selected
                var groupCheckboxes = form.querySelectorAll('input[name="groups[]"]:checked');
                if (groupCheckboxes.length === 0) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.querySelector('.invalid-feedback').style.display = 'block';
                }

                // Check if password and confirm password match
                var password = document.getElementById('password');
                var passwordConfirm = document.getElementById('password_confirm');
                if (password.value !== '' && password.value !== passwordConfirm.value) {
                    event.preventDefault();
                    event.stopPropagation();
                    passwordConfirm.setCustomValidity('Passwords do not match');
                } else {
                    passwordConfirm.setCustomValidity('');
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
<script>
    // Show/hide banned message
    $('#bannedBtn').on('change', function () {
        if ($(this).is(':checked')) {
            $('#collapseStatusMsg').collapse('show');
        }
    });

    $('#collapseStatusMsg').on('shown.bs.collapse', function () {
        $('#userStatusMsg').attr('disabled', false);
    });

    // When Closed
    $('#activeBtn').on('change', function () {
        if ($(this).is(':checked')) {
            $('#collapseStatusMsg').collapse('hide');
        }
    });
    $('#collapseStatusMsg').on('hidden.bs.collapse', function () {
        $('#userStatusMsg').attr('disabled', true);
    });
</script>
<?= $this->endSection() ?>