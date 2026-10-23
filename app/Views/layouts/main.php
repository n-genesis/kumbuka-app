<!DOCTYPE html>
<html lang="en">

<!-- Include head Tag -->
<?= $this->include('partials/head') ?>

<body>
    
    <!-- Main Document body content -->
    <?= $this->renderSection('main'); ?>


    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Include page specific scripts --> 
    <?= $this->renderSection('js') ?>

    <!-- Kumbuka Script -->
    <script src="<?= base_url('assets/js/kumbuka-script.js'); ?>"></script>

    <!-- Inlcude inline scritps -->
    <?= $this->renderSection('scripts') ?>
</body>

</html>