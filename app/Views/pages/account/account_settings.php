<!-- app/Views/pages/account/settings.php -->
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

            <!-- Page Header Title -->
            <h2 class="h5 mb-4 text-dark border-bottom pb-2"><?= $pageHeader ?></h2>
        </header>
        <div class="row">
            <!-- Top nav -->
            <div class="col-lg-12">
                <ul class="nav nav-pills nav-fill mb-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= site_url('account') ?>">Edit
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= site_url('account/settings') ?>">Account Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('account/privacy') ?>">Privacy Settings</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-6 col-sm-12">

                <div class="card mb-3">

                    <!-- Username & Email FORM -->
                    <form action="<?= site_url('account/settings/update') ?>" method="post" class="needs-validation" data-km="form" novalidate>
                        <?= csrf_field() ?>
                        <div class="card-header py-3">
                                <h5 class="m-0"><i class="bi bi-person"></i> User Credentials</h5>
                        </div>

                        <div class="card-body">

                            <div class="row gy-2">

                                <div class="col-12">
                                    <label for="uname" class="form-label">Username:</label>
                                    <input type="text" class="form-control" name="username" id="uname"
                                        value="<?= old('username', $user->username) ?>" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="<?= old('email', $user->email) ?>" required>
                                </div>
                            </div>

                            <!-- Update Notice -->
                            <div class="alert bg-white alert-warning my-3 mb-0" role="alert">
                                <div class="iq-alert-icon">
                                    <i class="bi bi-exclamation-diamond"></i>
                                </div>
                                <div class="iq-alert-text">
                                    If you change your email, remember the new one when you sign back in. If you use the forget and and a Magick-Link send to your email, it will be send to the updated email. Make sure you have access to that email account. 
                                </div>
                            </div>
                        </div>
                        
                        <footer class="card-footer d-flex align-items-center justify-content-between">
                            <!-- Check if Demo user -->
                            <?php if(auth()->id() != 3):?>
                            <button type="submit" class="btn btn-primary me-auto" data-km="submit">
                                <i class="bi bi-person-square"></i> Update User</button>
                            <?php else: ?>
                                <div class="alert alert-primary mb-0" role="alert">
                                    Operation block on guest account
                                </div>
                            <?php endif ?>
                        </footer>
                        
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4><i class="bi bi-x-octagon"></i> Delete Account</h4>
                        </div>
                        <a href="<?= site_url('privacy_policy') ?>" class="btn btn-outline-primary"><i
                                class="bi bi-file-earmark-ruled"></i>Read Privacy
                            Policy</a>
                    </div>
                    <div class="card-body">
                        <!-- User form -->
                        <form action="<?= base_url('account/purge') ?>" data-km="delete-form" data-km-username="<?= esc($user->username) ?>" method="post">
                            <?= csrf_field() ?>
                            <!-- This "spoofs" the POST request as a DELETE request -->
                            <input type="hidden" name="_method" value="DELETE">
                            <p>
                                You can permanently delete your account at any time. If you would like to delete your account, click the button below and all will be erased.
                            </p>
                            <div class="alert alert-info">
                                This Kumuka does use any email account information for personal use in any way. To learn more please read the Privacy Policy for more information.
                            </div>
                            <!-- Check if Demo user -->
                            <?php if(auth()->id() != 3):?>
                            <button type="submit" class="btn btn-outline-danger" role="#" data-km="submit"
                                data-bs-toggle="tooltip" title="Delete Account">
                                <i class="bi bi-trash"></i>
                                I understand, delete my account
                            </button>
                            <?php else: ?>
                                <div class="alert alert-primary mb-0" role="alert">
                                    Operation block on guest account
                                </div>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>

            <!-- User Password -->
            <div class="col-lg-6 col-sm-12">
                <!-- Security Kuma -->
                <img src="<?= base_url('assets/images/kuma-security.webp') ?>" class="img-fluid mx-auto d-block"
                    alt="Centered Image" width="360">

                <div class="card">
                    <!-- Change Password FORM -->
                    <form id="password-form" action="<?= site_url('account/settings/change-password') ?>" method="post" class="needs-validation" data-km="form" novalidate>
                        <?= csrf_field() ?>

                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title m-0"><i class="bi bi-shield-lock"></i> Change Password</h4>
                            </div>
                        </div>

                        <div class="card-body">

                            <label for="current_password">Current Password:</label>
                            <div class="input-group mb-3">
                                <input id="current_password" type="password" class="form-control"
                                    name="current_password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="cp-btn-addon"
                                        data-km="show"><i class="bi bi-eye-slash-fill"></i></button>
                                </div>
                            </div>

                            <label for="current_password">New Password:</label>
                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="pass-btn-addon"
                                        data-km="show"><i class="bi bi-eye-slash-fill"></i></button>
                                </div>
                            </div>

                            <div class="alert bg-white alert-info" role="alert">
                                <div class="iq-alert-text">
                                    Password must be at least 8 characters long and contain a mix of letters, numbers, and symbols. 
                                </div>
                            </div>

                            <label for="current_password">Verify Password:</label>
                            <div class="input-group mb-3">
                                <input id="password_confirm" name="password_confirm" type="password"
                                    class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="pass-conf-btn-addon"
                                        data-km="show"><i class="bi bi-eye-slash-fill"></i></button>
                                </div>
                            </div>

                        </div>

                        <footer class="card-footer d-flex align-items-center justify-content-between">
                            <!-- Check if Demo user -->
                            <?php if(auth()->id() != 3):?>
                            <button type="submit" class="btn btn-primary ml-auto" data-km="submit">
                                <i class="bi bi-shield-lock"></i> Save</button>
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
    </div>
</main>

<!-- Delete Account Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Account Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/images/kuma-confirm-deletion.webp') ?>" class="img-fluid mx-auto d-block"
                    alt="Centered Image">
                Are you sure you want to delete the account for <span id="modalUsername" class="text-danger"></span>?
                This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalBtn" data-bs-dismiss="modal">Cancel</button>
                <buttom type="button" id="deleteUserBtn" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const showBtn = document.querySelectorAll('[data-km="show"]');

        showBtn.forEach(ele => {
            ele.addEventListener('click', (event) => {
                event.preventDefault();
                let btn = event.target.closest('button');
                btn.classList.toggle('btn-outline-secondary');
                btn.classList.toggle('btn-primary');
                btn.querySelector('i').classList.toggle('bi-eye-slash-fill');
                btn.querySelector('i').classList.toggle('bi-eye');
                const par = event.target.closest('.input-group');
                const input = par.querySelector('input');
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });




    document.querySelector('form[data-km="delete-form"]').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission
        
        const currentForm = event.currentTarget; // Properly reference the form

        // Initialize and show the Bootstrap modal using vanilla JS
        const deleteModalEl = document.getElementById('deleteModal');
        const deleteModal = new bootstrap.Modal(deleteModalEl, {
            backdrop: 'static',
            keyboard: false
        });
        deleteModal.show();

        // Get username from form dataset and set text content
        const username = currentForm.dataset.kmUsername;
        document.getElementById('modalUsername').textContent = username;

        // Handle the delete confirmation click using standard event delegation
        deleteModalEl.addEventListener('click', function (e) {
            if (e.target && e.target.id === 'deleteUserBtn') {
                const deleteUserBtn = e.target;
                
                deleteUserBtn.innerHTML = 'Loading...';
                document.getElementById('closeModalBtn').disabled = true; // Disable close button
                deleteUserBtn.disabled = true; // Disable confirm button
                
                currentForm.submit(); // Submit the form
            }
        });
    });

    });
</script>
<?= $this->endSection() ?>