<?= $this->extend('layouts/main'); ?>

<?= $this->section('styles') ?>
<style>
    .hero-section {
        background: linear-gradient(135deg, #00396B 0%, #0d6efd 100%);
    }

    .feature-icon {
        width: 3rem;
        height: 3rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.75rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('main'); ?>
<!-- Navbar -->
<?= $this->include('partials/top-navbar') ?>

<!-- Hero Section -->
<header id="top" class="hero-section text-white py-5 mt-5 text-center text-md-start">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span
                    class="badge bg-light text-primary mb-3 fw-semibold px-3 py-2 text-uppercase tracking-wider">Portfolio
                    Project</span>
                <h1 class="display-4 fw-bold mb-3">Write notes. Share ideas. Follow Friends.</h1>
                <p class="lead mb-4 opacity-75">A notebook web application built to demonstrate robust backend
                    development using the CodeIgniter 4 PHP framework.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-md-start mb-3 mb-sm-0">
                    <a href="<?= site_url('login') ?>" class="btn btn-light btn-lg px-4 fw-bold text-primary">Explore
                        Live App</a>
                    <a href="<?= site_url('register') ?>" class="btn btn-outline-light btn-lg px-4"></i>Create an account</a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="bg-white text-dark p-4 rounded-3 shadow-lg text-start mx-auto" style="max-width: 450px;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white border border-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; overflow: hidden;">
                            <img src="<?= base_url("assets/images/logo.png") ?>" alt="Kumbuka Logo" class="img-fluid">
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Adrian G.</h6>
                            <small class="text-muted">@ag_user • Following</small>
                        </div>
                    </div>
                    <h5 class="fw-bold card-title">A kool new dive</h5>
                    <p class="text-muted small">I was just thinking. I never thought that I was going to eat a hamburger
                        with jalapeno and cheddar cheese...</p>
                    <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-3">
                        <span class="text-muted small me-2"><i class="bi bi-pin-angle-fill text-primary me-1"></i> 5
                            Pines</span>
                            <span class="text-muted small"><i class="bi bi-chat-left-text text-secondary me-1"></i> 9
                            comments</span>
                        <span class="badge bg-secondary btn-sm ms-auto">My Notebook</span>
                    </div>
                </div>
                <p class="my-2"><a href="<?= site_url('profile/adriangarber') ?>" class="btn btn-outline-light">Click here to checkout more!</a></p>
            </div>
        </div>
    </div>
</header>

<!-- Project Context Alert -->
<section class="bg-light border-bottom py-3">
    <div class="container text-center">
        <p class="mb-0 text-muted">
            <i class="bi bi-info-circle-fill text-primary me-2"></i>
            <strong>Developer Note:</strong> This application demonstrates MVC architecture, RESTful routing, secure
            authentication, and relational database handling in PHP.
        </p>
    </div>
</section>

<!-- Core Features Section -->
<section id="features" class="border-bottom py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Application Features</h2>
            <p class="text-muted lead">It's nothing complex, just a simple app to write and share notes with your friends.</p>
        </div>
        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-3">
                    <div class="card-body">
                        <div class="feature-icon bg-primary-subtle text-primary mb-3">
                            <i class="bi bi-journal-text fs-4 m-0"></i>
                        </div>
                        <h4 class="fw-bold">Just Notes</h4>
                        <p class="text-muted">Create, edit, organize and share notes with other users. A fun place to post ideas, stories and random thoughts.</p>
                    </div>
                </div>
            </div>
            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-3">
                    <div class="card-body">
                        <div class="feature-icon bg-success-subtle text-success mb-3">
                            <i class="bi bi-people fs-4 m-0"></i>
                        </div>
                        <h4 class="fw-bold">Follow System</h4>
                        <p class="text-muted">Follow other and see latest notes other are posting in your network right from the dashboard HomeStop Page.</p>
                    </div>
                </div>
            </div>
            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-3">
                    <div class="card-body">
                        <div class="feature-icon bg-info-subtle text-info mb-3">
                            <i class="bi bi-chat-left-dots fs-4 m-0"></i>
                        </div>
                        <h4 class="fw-bold">Activity Feeds</h4>
                        <p class="text-muted">Find a note you like? Pin it as a favorite to quickly find it again. Get notifications when someone comments or pins a notebook or posts.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Architecture & Framework Highlights -->
<section id="architecture" class="py-5 bg-light">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Powered by CodeIgniter 4</h2>
                <p class="text-muted">This portfolio project showcases a clean structural codebase built around
                    production-grade PHP standards.</p>

                <ul class="list-unstyled mt-4">
                    <li class="d-flex mb-3">
                        <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                        <div>
                            <strong>MVC Architecture:</strong> Distinct separation of data validation models, control
                            layers, and clean UI templates.
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                        <div>
                            <strong>Secure Database Handling:</strong> Utilizes CI4 Query Builder and automated entity
                            migrations to protect against SQL injections.
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                        <div>
                            <strong>RESTful Routes & Filtering:</strong> Clean URL endpoints with secure middleware
                            filters regulating unauthorized access.
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-dark text-white rounded-3 shadow font-monospace small">
                    <span class="text-secondary">// app/Controllers/Notes.php</span><br>
                    <span class="text-info">namespace</span> App\Controllers;<br><br>
                    <span class="text-warning">class</span> <span class="text-info">Notes</span> <span
                        class="text-warning">extends</span> BaseController {<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-warning">public function</span> <span
                        class="text-info">index</span>() {<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-success">$model</span> = <span
                        class="text-warning">new</span> NoteModel();<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-success">$data</span>['notes'] =
                    <span class="text-success">$model</span>->getFollowingNotes(auth()->id());<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-warning">return</span>
                    view('notes/dashboard', <span class="text-success">$data</span>);<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                    }
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include footer tag -->
<?= $this->include('partials/footer') ?>
<!-- END Main -->
<?= $this->endSection(); ?>