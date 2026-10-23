<!-- High-content alert with integrated collapse trigger layout -->
<div class="alert alert-danger bg-white border border-danger-subtle text-dark p-3 rounded-3 shadow-sm w-100 mb-3"
    role="alert" data-bs-theme="light">

    <div class="d-flex align-items-start justify-content-between gap-3 mb-2">
        <div class="d-flex align-items-start gap-3">
            <div class="bg-danger-subtle text-danger border border-danger-subtle rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                style="width: 34px; height: 34px;">
                <i class="bi bi-exclamation-triangle-fill fs-5 m-0"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">API Connection Lifecycle Failure</h6>
                <p class="mb-0 text-secondary small">The production system environment was unable to authorize your
                    application's requested OAuth token array handshake parameters.</p>
            </div>
        </div>

        <!-- Toggle button to display extra hidden log variables content -->
        <button class="btn btn-sm btn-outline-danger py-1 px-2 flex-shrink-0 small fw-medium text-decoration-none"
            type="button" data-bs-toggle="collapse" data-bs-target="#alertLogsCollapse" aria-expanded="false"
            aria-controls="alertLogsCollapse" style="font-size: 0.75rem;">
            <i class="bi bi-code-square me-1"></i> View Logs
        </button>
    </div>

    <!-- Nested Hidden Extra Content Area Block -->
    <div class="collapse" id="alertLogsCollapse">
        <div class="mt-3 p-3 bg-light border border-secondary-subtle rounded-3 font-monospace small text-dark position-relative"
            style="font-size: 0.8rem; line-height: 1.45;">
            <div class="text-danger-emphasis fw-bold mb-1">Error Stream Log Stack [500 Server Error]:</div>
            AuthenticationException: Invalid signature array signature payload validation failed.<br>
            at controller/AuthSandbox.php:142 -> verify_token_lifecycle()<br>
            at core/CodeIgniterFramework.php:28 -> boot_router()
        </div>
    </div>

</div>