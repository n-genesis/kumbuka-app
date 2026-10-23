<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sent - Kumbuka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
        .btn-action {
            border-radius: 20px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

    <div class="container">
        <!-- Centering Row Container -->
        <div class="row justify-content-center mx-1">
            
            <!-- 6-Column Width Guard Container (Takes 6 of 12 blocks on desktop, full width on mobile) -->
            <div class="col-12 col-md-6 card bg-white border-defined rounded-3 shadow-sm p-4 p-sm-5 text-center">
                
                <!-- Graphic Image / Icon Header Wrapper -->
                <div class="mb-4">
                    <div class="bg-success-subtle text-success d-inline-flex align-items-center justify-content-center rounded-circle animate-pulse" style="width: 72px; height: 72px;">
                        <i class="bi bi-send-check fs-2"></i>
                    </div>
                </div>

                <!-- Messaging Titles -->
                <h3 class="fw-bold text-dark mb-2">Check Your Inbox</h3>
                <p class="text-secondary small mx-auto mb-4" style="max-width: 380px;">
                    We have sent a secure password reset link to your registered email address at <strong class="text-dark">user@example.com</strong>.
                </p>

                <!-- Informational Help Box (Instead of form input) -->
                <div class="bg-light border-defined rounded-3 p-3 text-start mb-4">
                    <h6 class="fw-bold text-dark small mb-1"><i class="bi bi-info-circle me-1"></i> What should I do next?</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li class="mb-1">Click the verification link contained within the message.</li>
                        <li class="mb-1">Check your <strong>Spam or Junk</strong> folders if it does not arrive within a minute.</li>
                        <li>The tracking link will safely expire after 1 hour.</li>
                    </ul>
                </div>

                <!-- Main CTA Action Trigger (Directs user to mail or landing) -->
                <a href="https://google.com" target="_blank" class="btn btn-primary btn-action w-100 mb-3">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Open Mail Application
                </a>

                <!-- Alternate Option Control Link Nodes -->
                <div class="border-top border-defined pt-3 mt-2 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <span class="text-muted small">Made a mistake?</span>
                    <a href="#" class="text-decoration-none small fw-semibold" style="font-size: 0.85rem;">
                        <i class="bi bi-arrow-left"></i> Change email address
                    </a>
                </div>

            </div>
            
        </div>
    </div>

    <!-- Bootstrap 5 Compiled Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
