<!-- app/Views/pages/profile/index.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>
<main class="main-content py-4 px-2">
    <div class="container-fluid">
        <!-- Header Component -->
        <header>
            <!-- Breadcrumbs -->
            <?php if (!empty($breadcrumbHtml)): ?>
                <?= $breadcrumbHtml ?>
            <?php endif; ?>
        </header>
        <!-- Main Help Page Container Card -->
        <div class="row">
            
            <div class="col-lg-12">
                <div class="card rounded-3">

                    <!-- Card Header -->
                    <div class="card-header border-bottom p-3">
                        <h4 class="mb-0 d-flex align-items-center">
                            <i class="bi bi-question-circle-fill text-primary me-2"></i>Documentation & Help Center
                        </h4>
                    </div>

                    <!-- Card Body using a 2-Column Responsive Layout -->
                    <div class="card-body p-4 bg-light">
                        <div class="row g-4">
                            
                            <!-- LEFT COLUMN: Navigation Links (Pills style) -->
                            <div class="col-lg-3">
                                <div class="nav flex-column nav-pills bg-white p-2 rounded-3 shadow-sm" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active fw-bold text-start p-2.5 mb-1 d-flex align-items-center" 
                                            id="v-pills-getting-started-tab" data-bs-toggle="pill" data-bs-target="#v-pills-getting-started" 
                                            type="button" role="tab" aria-controls="v-pills-getting-started" aria-selected="true">
                                        <i class="bi bi-rocket-takeoff me-2"></i>Getting Started
                                    </button>
                                    <button class="nav-link fw-bold text-start p-2.5 mb-1 d-flex align-items-center" 
                                            id="v-pills-notebooks-tab" data-bs-toggle="pill" data-bs-target="#v-pills-notebooks" 
                                            type="button" role="tab" aria-controls="v-pills-notebooks" aria-selected="false">
                                        <i class="bi bi-collection-fill me-2"></i>Managing Notebooks
                                    </button>
                                    <button class="nav-link fw-bold text-start p-2.5 mb-1 d-flex align-items-center" 
                                            id="v-pills-social-tab" data-bs-toggle="pill" data-bs-target="#v-pills-social" 
                                            type="button" role="tab" aria-controls="v-pills-social" aria-selected="false">
                                        <i class="bi bi-people-fill me-2"></i>Sharing & Following
                                    </button>
                                </div>
                            </div>

                            <!-- RIGHT COLUMN: Help Content Panels -->
                            <div class="col-lg-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    
                                    <!-- PANEL 1: GETTING STARTED -->
                                    <div class="tab-pane fade show active" id="v-pills-getting-started" role="tabpanel" aria-labelledby="v-pills-getting-started-tab">
                                        <div class="bg-white p-4 rounded-3 shadow-sm">
                                            <h4 class="fw-bold text-dark mb-2">Getting Started</h4>
                                            <p class="text-muted small mb-2">Well, welcome to the little portfolio project Kumbuka which is Swahili: 'to take note' or 'to remember'. Fun fact. Anyway, this is a web-based notebook application built to demonstrate: MVC architecture, RESTful routing, secure authentication, and relational database handling using CodeIgniter 4 (PHP8 framework) and Bootstrap to the front-end design.</p>
                                            <p class="text-muted small mb-2">Since it’s a sample app, the navigation is meant to be simplistic and with a minimalist style to be used as a showcase rather than an active or live web application.</p>
                                            <p class="text-muted small mb-4">With that being said, here’s a few tips on how to use Kumbuka if some of the features and navigation seem a little confusing.</p>
                                            
                                            <!-- Accordion Block for detailed answers -->
                                            <div class="accordion accordion-flush border rounded-3 overflow-hidden" id="accordionGettingStarted">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-gs-1">
                                                            What is a Note vs Notebook?
                                                        </button>
                                                    </h2>
                                                    <div id="flush-gs-1" class="accordion-collapse collapse show" data-bs-parent="#accordionGettingStarted">
                                                        <div class="accordion-body text-secondary small lh-base">
                                                            A <strong>Notebook</strong> acts the same as a physical one, containing a collection of your notes. A <strong>Note</strong> is an individual post entry that must live inside one of your initialized Notebook folders.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-gs-2">
                                                            How do I set up an account?
                                                        </button>
                                                    </h2>
                                                    <div id="flush-gs-2" class="accordion-collapse collapse" data-bs-parent="#accordionGettingStarted">
                                                        <div class="accordion-body text-secondary small lh-base">
                                                            To create an account and post some notes for yourself: Navigate to the register page. Fill out a few form fields, and you’ll be sent an email with an activation code. Once activated, you’re ready to go.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-gs-3">
                                                            Can I delete my account?
                                                        </button>
                                                    </h2>
                                                    <div id="flush-gs-3" class="accordion-collapse collapse" data-bs-parent="#accordionGettingStarted">
                                                        <div class="accordion-body text-secondary small lh-base">
                                                            Anything entered into this demonstration site should be considered temporary and may be deleted or reset at any time without notice. This app is meant to have fun and check out the kool mechanics of CodeIgniter 4.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PANEL 2: MANAGING NOTEBOOKS -->
                                    <div class="tab-pane fade" id="v-pills-notebooks" role="tabpanel" aria-labelledby="v-pills-notebooks-tab">
                                        <div class="bg-white p-4 rounded-3 shadow-sm">
                                            <h4 class="fw-bold text-dark mb-2">Managing Notebooks</h4>
                                            <p class="text-muted small mb-4">Learn how to catalog notes, and delete active notebooks.</p>
                                            
                                            <div class="accordion accordion-flush border rounded-3 overflow-hidden" id="accordionNotebooks">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-nb-1">
                                                            Can I move an individual Note to a different Notebook?
                                                        </button>
                                                    </h2>
                                                    <div id="flush-nb-1" class="accordion-collapse collapse" data-bs-parent="#accordionNotebooks">
                                                        <div class="accordion-body text-secondary small lh-base">
                                                            Yes. When editing an active <strong>Note</strong>, use the drop-down menu options to change the <strong>Notebook</strong> the <strong>Note</strong> is associated with. Once saved, the note will be listed under the new <strong>Notebook</strong>.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PANEL 3: SHARING & FOLLOWING -->
                                    <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                                        <div class="bg-white p-4 rounded-3 shadow-sm">
                                            <h4 class="fw-bold text-dark mb-2">Sharing & Following</h4>
                                            <p class="text-muted small mb-4">How to manage network interactions, and follow specific profiles.</p>
                                            
                                            <div class="accordion accordion-flush border rounded-3 overflow-hidden" id="accordionSocial">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-sc-1">
                                                            Where does activity show up when I follow someone?
                                                        </button>
                                                    </h2>
                                                    <div id="flush-sc-1" class="accordion-collapse collapse" data-bs-parent="#accordionSocial">
                                                        <div class="accordion-body text-secondary small lh-base">
                                                            Whenever an account you follow publishes a note as public, it populates onto your landing dashboard's Activity Feed automatically.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-center py-3">
                        <span class="text-muted small">Can't find what you need?</span>
                        <a href="mailto:ngendesign@email.com" class="small text-decoration-none fw-bold text-primary ms-1">
                            Contact me <i class="bi bi-envelope-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<?= $this->endSection(); ?>