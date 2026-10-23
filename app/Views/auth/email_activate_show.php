<?php $this->setVar('appTitle', lang(line: 'Auth.login')); ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('styles') ?>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }
        /* High-Contrast Design Framework */
        .border-defined {
            border: 1px solid rgba(108, 117, 125, 0.25) !important;
        }
        /* Custom form focus glow */
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('main'); ?>
<div class="d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <!-- Centering Row Container -->
        <div class="row justify-content-center mx-1">
            
            <!-- 6-Column Width Guard Container (Takes 6 of 12 blocks on desktop, full width on mobile) -->
            <div class="col-12 col-md-6 card bg-white border-defined rounded-3 shadow-sm p-4 p-sm-5 text-center">
                
                <!-- Graphic Image / Icon Header Wrapper -->
                <div class="mb-4">
                    <div class="bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 72px; height: 72px;">
                        <i class="bi bi-envelope-check fs-2"></i>
                    </div>
                </div>

                <!-- Messaging Titles -->
                <h3 class="fw-bold text-dark mb-2">Verify Your Email</h3>
                <p class="small mx-auto mb-4" style="max-width: 380px;"><?= lang('Auth.emailActivateBody') ?></p>

                <?php if (session('error')) : ?>
                    <div class="alert alert-danger"><?= esc(session('error')) ?></div>
                <?php endif ?>

                <!-- Interactive Verification Form -->
                <form action="<?= url_to('auth-action-verify') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <!-- Code Entry Inputs Block -->
                    <div class="mb-4">
                        <label for="activationCode" class="visually-hidden">Activation Code</label>
                        <input type="text" 
                                name="token"
                               class="form-control form-control-lg text-center fw-bold letter-spacing-lg border-defined font-monospace bg-light py-2" 
                               id="activationCode" 
                               placeholder="000000" 
                               inputmode="numeric"
                               autocomplete="one-time-code"
                               maxlength="6" 
                               pattern="[0-9]{6}" 
                               style="font-size: 1.75rem; letter-spacing: 0.5rem;" 
                               value="<?= old('token') ?>"
                               required>
                    </div>

                    <!-- Call To Action Submission Trigger -->
                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        Activate Account
                    </button>
                    
                </form>

            </div>
            
        </div>
    </div>
</div>
<!-- END Main -->
<?= $this->endSection(); ?>