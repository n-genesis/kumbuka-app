<?php $this->setVar('appTitle', lang(line: 'Auth.login')); ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('styles') ?>
<style>
    body {
        background-color: #f4f6f9;
        font-family: system-ui, -apple-system, sans-serif;
    }

    #login-body {
        min-height: 100vh;
    }
    /* Minimal Registration Card Custom Styles */
    .register-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 2.5rem 2rem;
        max-width: 480px;
        width: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    /* Custom form focus states matching theme */
    .form-control:focus, .form-check-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('main'); ?>

<div id="login-body" class="d-flex align-items-center justify-content-center h-100">
    <!-- Card Wrapper Container -->
    <div class="register-card mx-3">
        <!-- Alert Messages -->
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
        <?php elseif (session('errors') !== null) : ?>
            <div class="alert alert-danger" role="alert">
                <?php if (is_array(session('errors'))) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <?= esc($error) ?>
                        <br>
                    <?php endforeach ?>
                <?php else : ?>
                    <?= esc(session('errors')) ?>
                <?php endif ?>
            </div>
        <?php endif ?>

        <!-- Minimal Logo / Top Icon Header -->
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center mb-3"
                style="width: 56px; height: 56px;">
                <a href="./">
                    <img src="./assets/images/logo.png" alt="Kumbuka Logo" class="img-fluid">
                </a>
            </div>
            <h4 class="fw-bold text-dark mb-1">Create your account</h4>
            <p class="text-secondary small">Join Kumbuka to start creating your notes</p>
        </div>

        <!-- Form Elements -->
        <form action="<?= site_url('register') ?>" method="post">
            <?= csrf_field() ?>

            <!-- First Name and Last Name Row Split -->
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="firstNameInput" class="form-label text-secondary small fw-semibold">First name</label>
                    <input type="text" class="form-control form-control-sm py-2" id="firstNameInput" name="first_name" inputmode="text" autocomplete="lastname" value="<?= old('first_name') ?>" required>
                </div>
                <div class="col-12 col-sm-6">
                    <label for="lastNameInput" class="form-label text-secondary small fw-semibold">Last name</label>
                    <input type="text" class="form-control form-control-sm py-2" id="lastNameInput" name="last_name" inputmode="text" autocomplete="lastname" value="<?= old('last_name') ?>" required>
                </div>
            </div>

            <!-- Username & Email Input Group -->
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="usernameInput" class="form-label text-secondary small fw-semibold"><?= lang('Auth.username') ?></label>
                    <input type="text" class="form-control form-control-sm py-2" id="usernameInput" name="username" inputmode="text" value="<?= old('username') ?>" required>
                </div>
                <div class="col-12 col-sm-6">
                    <label for="emailInput" class="form-label text-secondary small fw-semibold">Email address</label>
                    <input type="email" class="form-control form-control-sm py-2" id="emailInput" name="email" inputmode="email" value="<?= old('email') ?>" required>
                </div>
            </div>

            <!-- Password Input Group -->
            <div class="mb-3">
                <label for="passwordInput" class="form-label text-secondary small fw-semibold"><?= lang('Auth.password') ?></label>
                <input type="password" class="form-control form-control-sm py-2" id="passwordInput" name="password" inputmode="text" required>
            </div>


            <!-- Terms of Service Checkbox -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="checkboxTermsOfUse" required>
                <label class="form-check-label text-secondary small" for="checkboxTermsOfUse">
                    I agree to the <a href="<?= site_url('terms_of_service') ?>" target="_blank" class="text-decoration-none fw-semibold"><?= lang('Auth.termsOfService') ?></a> 
                    and 
                    <a href="<?= site_url('privacy_policy') ?>" target="_blank" class="text-decoration-none fw-semibold">Privacy Policy</a>
                </label>
            </div>

            <!-- Main CTA Action Trigger -->
            <button type="submit" class="btn btn-primary w-100 mb-3"><?= lang('Auth.signup') ?></button>

            <!-- Alternative Account Switch Prompt -->
            <div class="text-center">
                <span class="text-muted small">Already have an account? </span>
                <a href="<?= base_url('login') ?>" class="text-decoration-none small fw-semibold">Sign in</a>
            </div>
        </form>

    </div>
</div>
<!-- Include footer tag -->
<?= $this->include('partials/footer') ?>
<!-- END Main -->
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    /**
 * Registration Agree to Terms Of Service for the User Registration Form
 */
const checkboxTermsOfUse = document.getElementById('checkboxTermsOfUse');
const registerForm = document.getElementById('user-register-form');

if (registerForm !== null) {
    registerForm.addEventListener('submit', function (event) {
        // Prevent the default form submission
        event.preventDefault();
        const form = event.target;

        if (!checkboxTermsOfUse.checked) {
            Swal.fire({
                title: 'Accept Terms',
                input: 'checkbox',
                inputValue: 1, // default checked
                inputPlaceholder: 'I agree to the terms and conditions',
                inputValidator: (result) => {
                    return !result && 'You need to agree with T&C'
                }
            }).then((result) => {
                if (result.value) {
                    checkboxTermsOfUse.checked = true;
                    form.submit();
                }
            });
        } else {
            form.submit();
        }
    });
}
</script>
<?= $this->endSection() ?>