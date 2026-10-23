<!-- Outer wrapper with more defined border parameters -->
<div class="card bg-white border border-secondary-subtle rounded-3 shadow-sm mx-auto"
    style="max-width: 700px; --bs-border-opacity: 0.85;">
    <!-- Card Header with Navigation Tabs -->
    <div class="card-header bg-white pt-3 pb-0 px-4 border-bottom border-secondary-subtle">
        <h5 class="fw-bold text-dark mb-3">Comments Activity</h5>

        <!-- Bootstrap 5 Navigation Tabs Toggle -->
        <ul class="nav nav-tabs border-bottom-0 gap-1" id="commentTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link active fw-semibold small py-2 px-3 border border-secondary-subtle border-bottom-0"
                    id="my-comments-tab" data-bs-toggle="tab" data-bs-target="#my-comments" type="button" role="tab"
                    aria-controls="my-comments" aria-selected="true"
                    style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                    My Comments <span class="badge bg-light text-secondary ms-1 border border-secondary-subtle">4</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link fw-semibold text-secondary small py-2 px-3 border border-transparent border-bottom-0"
                    id="received-comments-tab" data-bs-toggle="tab" data-bs-target="#received-comments" type="button"
                    role="tab" aria-controls="received-comments" aria-selected="false"
                    style="border-radius: 6px 6px 0 0; margin-bottom: -1px;">
                    On My Notes <span
                        class="badge bg-primary-subtle text-primary ms-1 border border-primary-subtle">2</span>
                </button>
            </li>
        </ul>
    </div>

    <!-- Card Body Containing the Switchable Tab Panes -->
    <div class="card-body p-3 tab-content" id="commentTabsContent">

        <!-- STREAM 1: Comments made BY the user -->
        <div class="tab-pane fade show active" id="my-comments" role="tabpanel" aria-labelledby="my-comments-tab">
            <div class="list-group list-group-flush">

                <!-- Comment Item 1 -->
                <div class="list-group-item border border-secondary-subtle rounded-3 my-1 p-3 bg-light-subtle hover-bg">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="small text-muted">
                            You commented on <a href="#" class="fw-semibold text-decoration-none text-dark">Database
                                Migration Scripts</a>
                        </span>
                        <span class="text-muted flex-shrink-0 ms-2" style="font-size: 0.75rem;">2h ago</span>
                    </div>
                    <p class="text-secondary small mb-0 ps-2 border-start border-primary border-2">
                        "Make sure we add a fallback rollback configuration script to the schema just in case the
                        migration times out on production variables."
                    </p>
                </div>

                <!-- Comment Item 2 -->
                <div class="list-group-item border border-secondary-subtle rounded-3 my-1 p-3 hover-bg">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="small text-muted">
                            You commented on <a href="#" class="fw-semibold text-decoration-none text-dark">API Setup
                                Guide</a>
                        </span>
                        <span class="text-muted flex-shrink-0 ms-2" style="font-size: 0.75rem;">Yesterday</span>
                    </div>
                    <p class="text-secondary small mb-0 ps-2 border-start border-secondary-subtle border-2">
                        "The OAuth documentation update looks perfect. Tested it locally on the CodeIgniter controller
                        sandbox."
                    </p>
                </div>

            </div>
        </div>

        <!-- STREAM 2: Comments received ON the user's notes -->
        <div class="tab-pane fade" id="received-comments" role="tabpanel" aria-labelledby="received-comments-tab">
            <div class="list-group list-group-flush">

                <!-- Received Comment Item 1 -->
                <div class="list-group-item border border-secondary-subtle rounded-3 my-1 p-3 hover-bg">
                    <div class="d-flex align-items-start gap-3">
                        <!-- Tiny User Profile Avatar Placeholder -->
                        <div class="bg-secondary-subtle text-secondary border border-secondary-subtle rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                            style="width: 32px; height: 32px; font-size: 0.75rem;">
                            AM
                        </div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small text-dark">
                                    <strong class="fw-semibold">Alex Mercer</strong> left a reply on <a href="#"
                                        class="text-decoration-none fw-semibold">Accordion Refactoring</a>
                                </span>
                                <span class="text-muted small flex-shrink-0 ms-2" style="font-size: 0.75rem;">15m
                                    ago</span>
                            </div>
                            <p class="text-secondary small mb-2">
                                "This cleanly fixes the legacy Bootstrap 4 layout nesting conflict! The code is much
                                easier to scan now."
                            </p>
                            <!-- Mini context action nodes -->
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-sm btn-link text-decoration-none text-muted p-0 small"
                                    style="font-size: 0.75rem;"><i class="bi bi-reply-fill"></i> Reply</a>
                                <span class="text-muted-subtle small">•</span>
                                <a href="#" class="btn btn-sm btn-link text-decoration-none text-muted p-0 small"
                                    style="font-size: 0.75rem;"><i class="bi bi-check-circle"></i> Resolve</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
    /* Clean interactions matching custom high-contrast lists */
    .hover-bg {
        transition: background-color 0.15s ease-in-out;
    }

    .hover-bg:hover {
        background-color: #f8f9fa;
    }

    /* Fixed tab behavior to integrate seamlessly with the sharper bottom header border line */
    .nav-tabs .nav-link.active {
        background-color: #fff !important;
        border-color: #dee2e6 #dee2e6 #fff !important;
        color: #0d6efd !important;
    }
</style>