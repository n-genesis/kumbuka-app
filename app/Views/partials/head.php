<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= esc($appDesc); ?>" />
    <meta name="author" content="<?= esc($appAuthor); ?>" />
    <title><?= esc($appTitle); ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('./favicon.ico'); ?>">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/kumbuka-theme.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XV6EJ3J5PN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-XV6EJ3J5PN');
    </script>
    <?= $this->renderSection('javascripts') ?>
    <?= $this->renderSection('styles') ?>
    <?= csrf_meta("csrf-meta") . "\n\n" ?>
</head>