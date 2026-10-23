<!-- app/Views/pages/activity/comments/comment-chat-layout.php -->
<?= $this->extend('layouts/backend'); ?>

<?= $this->section('backend'); ?>

<!-- Main Right Side Content Area -->
<main class="main-content py-4 px-2">
    <div class="container-fluid">
        <!-- Header Component -->
        <header>
            <!-- Breadcrumbs -->
            <?php if (!empty($breadcrumbHtml)): ?>
                <?= $breadcrumbHtml ?>
            <?php endif; ?>
        </header>
        
        <hr />

        <!-- Main Chat Module Dashboard Card -->
        <div class="card rounded w-100 overflow-hidden">
            <div class="row g-0">

                <!-- LEFT COLUMN: Users / Conversations List Pane (Takes 4 out of 12 columns) -->
                <div class="col-12 col-md-4 border-end border-defined d-flex flex-column bg-light-subtle" style="min-height: 500px; max-height: 600px;">
                    <!-- User Pane Search Header -->
                    <div class="p-3 border-bottom border-defined bg-white">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-defined text-muted py-1 px-2"
                                style="font-size: 0.85rem;"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control form-control-sm border-defined py-1"
                                placeholder="Search chats..." style="font-size: 0.85rem;">
                        </div>
                    </div>

                    <!-- Scrollable Conversations List Grid -->
                    <div class="list-group list-group-flush overflow-y-auto flex-grow-1 p-2">

                        <!-- Active User Item -->
                        <a href="#"
                            class="list-group-item list-group-item-action border-0 rounded-3 p-2.5 my-0.5 d-flex align-items-center gap-3 bg-white border-defined">
                            <div class="logo-wrapper position-relative flex-shrink-0"
                                style="width: 38px; height: 38px; border-radius: 50%; overflow: hidden;">
                                <img src="https://unsplash.com" alt="Sarah Jenkins"
                                    class="w-100 h-100 object-fit-cover">
                                <span
                                    class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1"
                                    title="Online"></span>
                            </div>
                            <div class="w-100 overflow-hidden">
                                <div class="d-flex justify-content-between align-items-center mb-0.5">
                                    <h6 class="mb-0 fw-bold text-dark small text-truncate">Sarah Jenkins</h6>
                                    <span class="text-muted" style="font-size: 0.68rem;">10:14 PM</span>
                                </div>
                                <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.75rem;">I've
                                    appended the raw SQL queries into...</p>
                            </div>
                        </a>

                        <!-- User Item 2 -->
                        <a href="#"
                            class="list-group-item list-group-item-action border-0 rounded-3 p-2.5 my-0.5 d-flex align-items-center gap-3">
                            <div class="logo-wrapper position-relative flex-shrink-0"
                                style="width: 38px; height: 38px; border-radius: 50%; overflow: hidden;">
                                <div class="bg-secondary-subtle text-secondary border border-defined w-100 h-100 d-flex align-items-center justify-content-center fw-bold small"
                                    style="font-size: 0.75rem;">AM</div>
                            </div>
                            <div class="w-100 overflow-hidden">
                                <div class="d-flex justify-content-between align-items-center mb-0.5">
                                    <h6 class="mb-0 fw-semibold text-dark small text-truncate">Alex Mercer</h6>
                                    <span class="text-muted" style="font-size: 0.68rem;">Yesterday</span>
                                </div>
                                <p class="text-muted small mb-0 text-truncate" style="font-size: 0.75rem;">This cleanly
                                    fixes the legacy layout conflicts...</p>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- RIGHT COLUMN: Active Chat Content Window Window Panel (Takes 8 out of 12 columns) -->
                <div class="col-12 col-md-8 d-flex flex-column bg-white" style="max-height: 600px;">

                    <!-- Active Target Top Meta Header -->
                    <div
                        class="p-3 border-bottom border-defined d-flex justify-content-between align-items-center bg-white">
                        <div class="d-flex align-items-center gap-2.5">
                            <div class="logo-wrapper rounded-circle border border-defined flex-shrink-0"
                                style="width: 34px; height: 34px; overflow: hidden;">
                                <img src="https://unsplash.com" alt="Sarah Jenkins"
                                    class="w-100 h-100 object-fit-cover">
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark small">Sarah Jenkins</h6>
                                <span class="text-muted small d-block" style="font-size: 0.68rem;"><i
                                        class="bi bi-circle-fill text-success" style="font-size: 0.5rem;"></i> Active
                                    now</span>
                            </div>
                        </div>
                        <!-- Inline Operational Settings -->
                        <button class="btn btn-link text-muted p-1 border-0" aria-label="Chat options"><i
                                class="bi bi-three-dots-vertical"></i></button>
                    </div>

                    <!-- Scrollable Conversation Bubble Timeline Feed -->
                    <div class="p-4 flex-grow-1 overflow-y-auto bg-light-subtle d-flex flex-column gap-3"
                        style="min-height: 380px;">

                        <!-- Received Message Card Bubble (Left Aligned) -->
                        <div class="d-flex align-items-end gap-2 max-w-75">
                            <div class="bg-white border-defined text-dark p-2.5 px-3 rounded-3 shadow-sm small">
                                "Make sure we add a fallback rollback configuration script to the schema just in case
                                the migration times out on production variables."
                                <span class="d-block text-muted text-end mt-1" style="font-size: 0.65rem;">10:12
                                    PM</span>
                            </div>
                        </div>

                        <!-- Sent Message Card Bubble (Right Aligned) -->
                        <div class="d-flex align-items-end gap-2 max-w-75 ms-auto">
                            <div class="text-white p-2.5 px-3 rounded-3 shadow-sm small"
                                style="background-color: #004085;">
                                "Good catch, Sarah! I've appended the raw SQL queries into a drop transaction handler
                                inside the fallback array loop."
                                <span class="d-block text-white-50 text-end mt-1" style="font-size: 0.65rem;">10:14
                                    PM</span>
                            </div>
                        </div>

                    </div>

                    <!-- Footer: Integrated Real-Time Message Input Field Box -->
                    <div class="p-3 bg-white border-top border-defined">
                        <form class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-link text-muted p-1 border-0 fs-5"
                                title="Attach file"><i class="bi bi-paperclip"></i></button>
                            <div class="w-100">
                                <label for="chatMessageInput" class="visually-hidden">Type a message</label>
                                <input type="text"
                                    class="form-control form-control-sm border-defined py-2 px-3 bg-light"
                                    id="chatMessageInput" placeholder="Type a message..."
                                    style="border-radius: 20px; font-size: 0.85rem;" required>
                            </div>
                            <button type="submit"
                                class="btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width: 36px; height: 36px; background-color: #004085; border-color: #004085;"
                                title="Send message">
                                <i class="bi bi-send-fill" style="font-size: 0.85rem;"></i>
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <style>
            /* High-contrast crisp border layout parameters matching previous templates */
            .border-defined {
                border: 1px solid rgba(108, 117, 125, 0.25) !important;
            }

            .max-w-75 {
                max-width: 75%;
            }

            /* Smooth custom scrolling adjustments for cleaner panels list */
            .overflow-y-auto {
                overflow-y: auto;
            }

            /* Smooth focus rings matching forms setup */
            .form-control:focus {
                background-color: #fff;
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            }
        </style>

    </div>
</main>

<?= $this->endSection(); ?>