<!-- COMMENT ITEM 1 (Parent Comment) -->
<div class="d-flex align-items-start gap-3 mb-4">
    <!-- User Avatar Thumbnail Box -->
    <div class="logo-wrapper border border-defined rounded-circle shadow-sm flex-shrink-0"
        style="width: 36px; height: 36px; overflow: hidden;">
        <img src="https://placehold.co/200" alt="Sarah Jenkins" class="w-100 h-100 object-fit-cover">
    </div>

    <!-- Comment Content Block -->
    <div class="w-100">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="small text-dark"><strong class="fw-semibold">Sarah Jenkins</strong></span>
            <span class="text-muted small flex-shrink-0" style="font-size: 0.72rem;">2h ago</span>
        </div>
        <p class="text-secondary small line-height-relaxed mb-2">
            "Make sure we add a fallback rollback configuration script to the schema just in case the migration
            times out on production environmental variables."
        </p>
        <!-- Inline Micro Action Triggers -->
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-link text-decoration-none text-muted p-0 small hover-dark"
                style="font-size: 0.75rem;"><i class="bi bi-reply-fill"></i> Reply</button>
            <span class="text-muted-subtle small" style="font-size: 0.75rem;">•</span>
            <button class="btn btn-sm btn-link text-decoration-none text-muted p-0 small hover-dark"
                style="font-size: 0.75rem;"><i class="bi bi-heart"></i> Like (4)</button>
        </div>

        <!-- NESTED REPLY LOOP (Child Comment) -->
        <div class="d-flex align-items-start gap-3 mt-3 ps-3 border-start border-defined border-2">
            <!-- Child Avatar Box -->
            <div class="logo-wrapper border border-defined rounded-circle shadow-sm flex-shrink-0"
                style="width: 28px; height: 28px; overflow: hidden;">
                <img src="https://placehold.co/200" alt="Andrew Nite" class="w-100 h-100 object-fit-cover">
            </div>

            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small text-dark"><strong class="fw-semibold">Andrew Nite</strong> <span
                            class="badge text-bg-primary rounded-pill ms-1"
                            style="font-size: 0.65rem;">Author</span></span>
                    <span class="text-muted small flex-shrink-0" style="font-size: 0.72rem;">1h ago</span>
                </div>
                <p class="text-secondary small line-height-relaxed mb-2">
                    "Good catch, Sarah! I've appended the raw SQL queries into a drop transaction handler inside
                    the fallback array loop."
                </p>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-link text-decoration-none text-muted p-0 small hover-dark"
                        style="font-size: 0.75rem;"><i class="bi bi-reply-fill"></i> Reply</button>
                </div>
            </div>
        </div>
        <!-- END NESTED REPLY -->

    </div>
</div>


<!-- COMMENT ITEM 2 (Standalone Parent Comment) -->
<div class="d-flex align-items-start gap-3 border-top border-defined pt-3">
    <div class="logo-wrapper border border-defined rounded-circle shadow-sm flex-shrink-0"
        style="width: 36px; height: 36px; overflow: hidden;">
        <div
            class="bg-secondary-subtle text-secondary w-100 h-100 d-flex align-items-center justify-content-center fw-bold small">
            AM
        </div>
    </div>
    <div class="w-100">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="small text-dark"><strong class="fw-semibold">Alex Mercer</strong></span>
            <span class="text-muted small flex-shrink-0" style="font-size: 0.72rem;">Yesterday</span>
        </div>
        <p class="text-secondary small line-height-relaxed mb-2">
            "This cleanly fixes the legacy layout nesting conflicts we discussed. The migration syntax looks
            beautiful."
        </p>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-link text-decoration-none text-muted p-0 small hover-dark"
                style="font-size: 0.75rem;"><i class="bi bi-reply-fill"></i> Reply</button>
            <span class="text-muted-subtle small" style="font-size: 0.75rem;">•</span>
            <button class="btn btn-sm btn-link text-decoration-none text-muted p-0 small hover-dark"
                style="font-size: 0.75rem;"><i class="bi bi-heart-fill text-danger"></i> Liked (1)</button>
        </div>
    </div>
</div>