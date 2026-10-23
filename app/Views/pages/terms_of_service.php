<?= $this->extend('layouts/main'); ?>

<?= $this->section('main'); ?>
<!-- Navbar -->
<?= $this->include('partials/top-navbar') ?>
<div class="d-flex flex-column justify-content-between">
    <div class="landing-container">
        <main class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12 col-sm-12">
                    <h1 class="text-capitalize border-bottom pb-2 mb-3">Terms Of Service</h1>
                    <div class="alert bg-white alert-primary" role="alert">
                        <div class="iq-alert-text">
                            <h5>Please Note:</h5>
                            <p class="mb-0">
                                All content, features, functionality, and source code on this web application are owned
                                exclusively by Adrian Garber / N-Gen Design and are protected by international copyright, trademark, and
                                intellectual property laws. You are granted a limited, non-exclusive, non-transferable
                                license to view and use the live application solely for personal or portfolio evaluation
                                purposes. You may not copy, modify, distribute, or reverse-engineer any part of this
                                application.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <!-- Terms Of Service -->
                        <div class="accordion" id="faqAccordion">

                            <!-- Accordion Item 1 -->
                            <div class="card mb-2 border border-light-subtle rounded">
                                <!-- Header acting as trigger wrapper -->
                                <div class="card-header bg-white border-0 py-3" id="headingOne">
                                    <a role="button"
                                        class="d-flex justify-content-between align-items-center text-decoration-none fw-bold text-dark"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <span>1. Intellectual Property & Ownership</span>
                                        <i class="bi bi-chevron-down text-muted small"></i>
                                    </a>
                                </div>

                                <!-- Collapsible Content Panel -->
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="card-body pt-0 text-secondary small">
                                        <ul class="mb-0 ps-3">
                                            <li class="mb-2">
                                                <strong class="text-dark">Exclusive Rights:</strong> The Application,
                                                its
                                                entire
                                                source
                                                code, database
                                                architecture, visual interface, graphics, branding, logos, and
                                                underlying
                                                business concept are the sole and exclusive property of Adrian Garber /
                                                N-Gen
                                                Design.
                                            </li>
                                            <li class="mb-2">
                                                <strong class="text-dark">Usage Restrictions:</strong> This website is a
                                                public
                                                demonstration. You are
                                                strictly prohibited from copying, reproducing, modifying, distributing,
                                                reverse-engineering, or commercializing the source code or core business
                                                model
                                                of this application without explicit written consent.
                                            </li>
                                            <li>
                                                <strong class="text-dark">Evaluation Only:</strong> Access to the source
                                                code via
                                                public
                                                repositories (such
                                                as GitHub) is granted solely for educational review and hiring
                                                evaluation
                                                purposes.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 2 -->
                            <div class="card mb-2 border border-light-subtle rounded">
                                <!-- Header acting as trigger wrapper -->
                                <div class="card-header bg-white border-0 py-3" id="headingTwo">
                                    <a role="button"
                                        class="d-flex justify-content-between align-items-center text-decoration-none fw-bold text-dark collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <span>2. Acceptable Use & Live Demo Behavior</span>
                                        <i class="bi bi-chevron-down text-muted small"></i>
                                    </a>
                                </div>

                                <!-- Collapsible Content Panel -->
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#faqAccordion">
                                    <div class="card-body pt-0 text-secondary small">
                                        <ul class="mb-0 ps-3">
                                            <li class="mb-2">
                                                <strong class="text-dark">Mock Data Requirement:</strong> This is a
                                                demonstration
                                                application. You agree to
                                                interact with all forms, input fields, and user account systems using
                                                mock
                                                or
                                                dummy data only. Do not submit real personal or sensitive information.
                                            </li>
                                            <li>
                                                <strong class="text-dark">Prohibited Conduct:</strong> You agree not to
                                                attempt to
                                                disrupt, hack, overload,
                                                or compromise the security of the Application, its servers, or its
                                                underlying
                                                CodeIgniter framework infrastructure.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 3 -->
                            <div class="card mb-2 border border-light-subtle rounded">
                                <div class="card-header bg-white border-0 py-3" id="headingThree">
                                    <a role="button"
                                        class="d-flex justify-content-between align-items-center text-decoration-none fw-bold text-dark collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <span>3. Disclaimers and Limitation of Liability</span>
                                        <i class="bi bi-chevron-down text-muted small"></i>
                                    </a>
                                </div>

                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="card-body pt-0 text-secondary small">
                                        <ul class="mb-0 ps-3">
                                            <li class="mb-2">
                                                <strong class="text-dark">Provided "As-Is":</strong> This Application is
                                                provided on
                                                an
                                                "as-is" and
                                                "as-available" basis for display purposes. We make no guarantees
                                                regarding
                                                uptime, functionality, or data preservation.
                                            </li>
                                            <li class="mb-2">
                                                <strong class="text-dark">No Client Contract:</strong> Viewing or
                                                interacting with
                                                this
                                                portfolio
                                                application does not constitute a formal developer-client relationship
                                                or a
                                                contract for professional web development services.
                                            </li>
                                            <li>
                                                <strong class="text-dark">Limitation of Liability:</strong> In no event
                                                shall Adrian
                                                Garber / N-Gen Design
                                                be liable for any direct, indirect, incidental, or consequential damages
                                                resulting from your use or inability to use this demonstration site.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 4 -->
                            <div class="card mb-2 border border-light-subtle rounded">
                                <div class="card-header bg-white border-0 py-3" id="headingFour">
                                    <a role="button"
                                        class="d-flex justify-content-between align-items-center text-decoration-none fw-bold text-dark collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <span>4. Reservation of Rights</span>
                                        <i class="bi bi-chevron-down text-muted small"></i>
                                    </a>
                                </div>

                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#faqAccordion">
                                    <div class="card-body pt-0 text-secondary small">
                                        <p class="mb-2">We reserve the right, at our sole discretion and without prior
                                            notice, to:
                                        </p>
                                        <ul class="mb-0 ps-3">
                                            <li class="mb-2">
                                                Periodically wipe, clear, or reset the application database.
                                            </li>
                                            <li class="mb-2">
                                                Terminate, suspend, or delete dummy user accounts created for testing.
                                            </li>
                                            <li>
                                                Modify the source code, layout, or completely take down the live
                                                application.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 5 -->
                            <div class="card mb-2 border border-light-subtle rounded">
                                <div class="card-header bg-white border-0 py-3" id="headingFive">
                                    <a role="button"
                                        class="d-flex justify-content-between align-items-center text-decoration-none fw-bold text-dark collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                                        aria-controls="collapseFive">
                                        <span>5. Governing Law</span>
                                        <i class="bi bi-chevron-down text-muted small"></i>
                                    </a>
                                </div>

                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#faqAccordion">
                                    <div class="card-body pt-0 text-secondary small">
                                        <p class="mb-0">
                                            These Terms and Conditions are governed by and construed in accordance
                                            with the laws of United States, without regard to its conflict of law
                                            principles.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 6 -->
                            <div class="card mb-2 border border-light-subtle rounded">
                                <div class="card-header bg-white border-0 py-3" id="headingSix">
                                    <a role="button"
                                        class="d-flex justify-content-between align-items-center text-decoration-none fw-bold text-dark collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix">
                                        <span>6. Contact Information</span>
                                        <i class="bi bi-chevron-down text-muted small"></i>
                                    </a>
                                </div>

                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#faqAccordion">
                                    <div class="card-body pt-0 text-secondary small">
                                        <p class="mb-2">
                                            If you are a prospective client or employer interested in discussing the
                                            architecture of this application, or if you wish to request permission to
                                            build
                                            upon
                                            this concept, please reach out via our official business contact:
                                        </p>
                                        <ul class="mb-0 ps-3">
                                            <li class="mb-2">
                                                <strong class="text-dark">Company:</strong> N-Gen Design
                                            </li>
                                            <li class="mb-2">
                                                <strong class="text-dark">Website:</strong> <a
                                                    href="https://ngendesign.com"
                                                    class="text-decoration-none">https://ngendesign.com</a>
                                            </li>
                                            <li>
                                                <strong class="text-dark">Email:</strong> <a
                                                    href="mailto:ngendesign@email.com"
                                                    class="text-decoration-none">ngendesign@email.com</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Include footer tag -->
<?= $this->include('partials/footer') ?>
<!-- END Main -->
<?= $this->endSection(); ?>