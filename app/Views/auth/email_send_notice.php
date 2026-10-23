<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <!-- Simple, accessible system fonts for instant loading -->
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333333;
            line-height: 1.6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .card {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            max-width: 480px;
            width: 100%;
            text-align: center;
        }
        .icon-container {
            font-size: 64px;
            color: #4f46e5; /* Modern Indigo */
            margin-bottom: 24px;
            animation: float 3s ease-in-out infinite;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 12px;
            color: #111827;
            font-weight: 700;
        }
        p {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 24px;
        }
        .email-highlight {
            font-weight: 600;
            color: #1f2937;
            background-color: #f3f4f6;
            padding: 2px 8px;
            border-radius: 4px;
            word-break: break-all;
        }
        .divider {
            border: 0;
            height: 1px;
            background: #e5e7eb;
            margin: 32px 0 24px 0;
        }
        .footer-text {
            font-size: 14px;
            color: #6b7280;
        }
        .btn-link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            font-size: 14px;
        }
        .btn-link:hover {
            text-decoration: underline;
            color: #4338ca;
        }
        .alert {
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: left;
        }
        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>

    <div class="card">
        <!-- Floating Mail Icon (Visual Anchor) -->
        <div class="icon-container">📬</div>

        <h1>Confirm your email</h1>

        <!-- Check for dynamic flash message parameters -->
        <?php if (session('message')) : ?>
            <div class="alert alert-success">
                <?= esc(session('message')) ?>
            </div>
        <?php endif ?>

        <p>
            We have sent a verification link to your inbox. 
            Please check your email and click the link to activate your account.
        </p>

        <!-- Optional: Dynamically render the target user's email safely if authenticated -->
        <?php if (auth()->user()): ?>
            <p>Sent to: <span class="email-highlight"><?= esc(auth()->user()->email) ?></span></p>
        <?php endif; ?>

        <hr class="divider">

        <div class="footer-text">
            <span>Didn't receive the email? Check your spam folder or </span>
            <!-- Explicit action link generation passing back to your verification controller trigger -->
            <form action="<?= url_to('auth-action-show') ?>" method="get" style="display:inline;">
                <button type="submit" class="btn-link">request a new link</button>
            </form>
        </div>
    </div>

</body>
</html>
