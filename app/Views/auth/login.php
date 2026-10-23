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
    /* Minimal Login Card Custom Styles */
    .login-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 2.5rem 2rem;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    /* Custom form focus states matching theme */
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('main'); ?>

<div id="login-body" class="d-flex align-items-center justify-content-center h-100">
    
    <!-- Card Wrapper Container -->
    <div class="login-card mx-3">
        
        <!-- Minimal Logo / Top Icon Header -->
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                <a href="./">
                    <img src="<?=base_url('./assets/images/logo.png') ?>" alt="Kumbuka Logo" class="img-fluid">
                </a>
            </div>
            <h4 class="fw-bold text-dark mb-1">Sign in to Kumbuka</h4>
            <p class="text-secondary small">Enter your credentials below to access your account</p>
        </div>

        <!-- Alerts Errors -->
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger small" role="alert"><?= esc(session('error')) ?></div>
        <?php elseif (session('errors') !== null) : ?>
            <div class="alert alert-danger small" role="alert">
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
        
        <!-- Alert Messages -->
        <?php if (session('message') !== null) : ?>
            <div class="alert alert-success small" role="alert"><?= esc(session('message')) ?></div>
        <?php endif ?>

        <!-- Form Elements -->
        <form id="loginForm" action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>
            <!-- Email Input Group -->
            <div class="mb-3">
                <label for="emailInput" class="form-label text-secondary small fw-semibold"><?= lang('Auth.email') ?></label>
                <input type="email" class="form-control form-control-sm py-2" id="emailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
            </div>

            <!-- Password Input Group -->
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="passwordInput" class="form-label text-secondary small fw-semibold mb-0"><?= lang('Auth.password') ?></label>
                    <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                        <a href="<?= url_to('magic-link') ?>" class="text-decoration-none small text-muted" style="font-size: 0.75rem;"><?= lang('Auth.forgotPassword') ?></a>
                    <?php endif ?>
                </div>
                <input type="password" class="form-control form-control-sm py-2" id="passwordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
            </div>

            <!-- Keep me signed in Checkbox -->
            <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                <div class="form-check mb-4">
                    <input type="checkbox" id="rememberMeCheck" name="remember" class="form-check-input" <?php if (old('remember')): ?> checked<?php endif ?>>
                    <label class="form-check-label text-secondary small" for="rememberMeCheck">
                        <?= lang('Auth.rememberMe') ?>
                    </label>
                </div>
            <?php endif; ?>
            
            <!-- Button -->
            <button type="submit" class="btn btn-primary w-100 mb-3"><?= lang('Auth.login') ?></button>

            <!-- Alternative Account Switch Prompt -->
            <?php if (setting('Auth.allowRegistration')) : ?>
                <div class="text-center">
                    <span class="text-muted small"><?= lang('Auth.needAccount') ?> </span>
                    <a href="<?= base_url('register') ?>" class="text-decoration-none small fw-semibold"><?= lang('Auth.register') ?></a>
                </div>
            <?php endif ?>
        </form>

        <!-- Divider line -->
        <div class="position-relative text-center my-3">
            <hr class="text-muted">
            <span class="position-absolute top-50 start-50 translate-middle bg-white px-2 text-muted small">OR</span>
        </div>

            <!-- One-Click Demo Button -->
        <button type="button" id="demoBtn" class="btn btn-outline-success w-100">
            Instant Demo Access
        </button>

    </div>
</div>
<!-- Include footer tag -->
<?= $this->include('partials/footer') ?>
<!-- END Main -->
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>

    document.getElementById('demoBtn').addEventListener('click', function() {
      // 1. Target the input fields
      const emailField = document.getElementById('emailInput');
      const passwordField = document.getElementById('passwordInput');
      const form = document.getElementById('loginForm');

      // 2. Populate the dummy credentials
      emailField.value = 'guestuser@example.com';
      passwordField.value = 'Password123!';

      // 2. Intercept submission to trick the browser's password manager
        form.addEventListener('submit', function() {
            // Scramble the name attributes so the browser doesn't recognize them
            emailField.setAttribute('name', 'demo-scramble-email');
            passwordField.setAttribute('name', 'demo-scramble-password');
            
            // Optional: Strip the autocomplete tags
            emailField.removeAttribute('autocomplete');
            passwordField.removeAttribute('autocomplete');
        });

      // 3. Optional: Trigger the form submission automatically
      form.submit(); 
    });
</script>
<?= $this->endSection() ?>