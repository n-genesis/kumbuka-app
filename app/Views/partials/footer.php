<!-- 4. Sticky Footer -->
<footer class="footer-content py-3 bg-light border-top mt-auto">
    <div class="container-fluid px-4">
        <!-- Direction set to vertical stack on mobile, horizontal row on medium screens (768px+) and up -->
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between small text-muted text-center text-md-start gap-2 gap-md-0">
            <div class="text-secondary ">
                <span>
                    <span class="copy">&copy;</span>
                    <script>document.write(new Date().getFullYear())</script>
                </span>
                &amp; developed w/ <i class="bi bi-heart-fill text-danger"></i> by <a href="<?= config('App')->appAuthWebsite ?>" class="text-decoration-none"><?= config('App')->appAuthor ?></a>
            </div>
            <div>
                <a href="<?= site_url('privacy_policy') ?>" class="link-secondary text-decoration-none me-3">Privacy Policy</a>
                <a href="<?= site_url('terms_of_service') ?>" class="link-secondary text-decoration-none">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
