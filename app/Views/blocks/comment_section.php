<!-- Comment fomr Section Container Cards -->

<!-- Comment Form Card Wrapper -->
<div class="card border rounded">
    
    <!-- Card Header -->
    <div class="card-header border-bottom">
        <h6 class="my-3"><i class="bi bi-pencil-square text-primary"></i> Leave a Comment</h6>
    </div>

    <!-- Card Body Form Entry Panel -->
    <div class="card-body ">
        <form action="#" method="POST">
            
            <!-- Comment Textarea Field -->
            <div class="mb-3">
                <label for="commentTextArea" class="form-label">Your Message</label>
                <textarea class="form-control border-defined py-2 px-3 bg-light-subtle" 
                          id="commentTextArea" 
                          rows="4" 
                          placeholder="Join the discussion... Share your thoughts or feedback about this note." 
                          style="resize: vertical; font-size: 0.875rem;" 
                          required></textarea>
                <div class="form-text text-muted" style="font-size: 0.72rem;">
                    Basic markdown tags or code blocks are supported.
                </div>
            </div>

            <!-- Action Control Buttons Matrix Split -->
            <div class="d-flex justify-content-between align-items-center pt-2 border-top border-light-subtle">
                <!-- User Profile Context Indicator Hint -->
                <div class="d-flex align-items-center gap-2 text-muted small" style="font-size: 0.78rem;">
                    <div class="bg-secondary-subtle text-secondary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 24px; height: 24px; font-size: 0.65rem;">
                        AN
                    </div>
                    <span>Posting as <strong>Andrew Nite</strong></span>
                </div>

                <!-- Submit CTA Button Triggers -->
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-action">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary btn-action" style="background-color: #004085; border-color: #004085;">
                        <i class="bi bi-send me-1"></i> Submit Comment
                    </button>
                </div>
            </div>

        </form>
    </div>

</div>


<div class="card p-4 my-3">
    <!-- Section Title: Recent -->
    <h5 class="card-title mb-3">Comments</h5>

    <!-- Card Style 1: Text Post with Image and Dropdown Menu -->
    <div class="feed-card d-flex align-items-start justify-content-between">
        <div class="d-flex align-items-start gap-3">
            <img src="https://placehold.co/400" alt="Rundown" class="card-img-thumb">
            <div>
                <h6 class="mb-1 text-uppercase fw-bold text-dark small" style="letter-spacing: 0.5px;">Daily Rundown:
                    Wednesday</h6>
                <p class="text-muted small mb-0">Income tax sops on the cards, The bias in VC
                    funding, and other top news for you</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="card-meta">3d</span>
            <div class="dropdown">
                <button class="btn btn-link text-muted p-0 border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots-vertical"></i></button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-menu-item dropdown-item small" href="#"><i
                                class="bi bi-bookmark me-2"></i>Save post</a></li>
                    <li><a class="dropdown-menu-item dropdown-item small" href="#"><i
                                class="bi bi-eye-slash me-2"></i>Hide this</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-menu-item dropdown-item small text-danger" href="#"><i
                                class="bi bi-flag me-2"></i>Report</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Card Style 2: Job Listing with Image and Dropdown Menu -->
    <div class="feed-card d-flex align-items-start justify-content-between">
        <div class="d-flex align-items-start gap-3">
            <div class="card-thumbnail bg-danger text-white">DRM</div>
            <div>
                <h6 class="mb-1 text-uppercase fw-bold text-dark small" style="letter-spacing: 0.5px;">Daily Rundown:
                    Monday</h6>
                <p class="text-dark small mb-2">Congratulate <strong>Alaxander Jankins</strong>
                    (imthedudegeez) for 5 years at <strong>Askbootsrap Pvt.</strong></p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="card-meta">4d</span>
            <div class="dropdown">
                <button class="btn btn-link text-muted p-0 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item small" href="#"><i class="bi bi-envelope me-2"></i>Apply directly</a>
                    </li>
                    <li><a class="dropdown-item small" href="#"><i class="bi bi-share me-2"></i>Share Job</a></li>
                </ul>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('comment-form');
        if (!form) return;

        async function fetchComments() {
            // Grab the token from the meta tag
            const csrfMeta = document.querySelector('meta[name="X-CSRF-TOKEN"]');
            let token = csrfMeta.getAttribute('content');

            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token
                        },
                    body: formData,
                });

                const result = await response.json();

                // CRITICAL: Always update the token field instantly if it exists in the payload
                if (result && result.token) {
                    const csrfInput = form.querySelector('input[type="hidden"][name^="csrf_"]');
                    if (csrfInput) csrfInput.value = result.token;
                }

                if (response.ok && result.status === 'success') {

                    // Update the meta tag CSRF token on success
                    if (result.csrf_token) {
                        csrfMeta.setAttribute('content', result.csrf_token);
                    }

                    // Handle Success
                    const noCommentsMsg = document.getElementById('no-comments');
                    if (noCommentsMsg) noCommentsMsg.remove();

                    const commentList = document.getElementById('comment-list');

                    const newComment = document.createElement('div');
                    newComment.classList.add('d-flex', 'align-items-center', 'pb-2')

                    const img = document.createElement('img');
                    img.classList.add('rounded-circle', 'avatar-50', 'mr-2')
                    img.src = result.avatar;
                    newComment.append(img);

                    const comment = document.createElement('div');
                    comment.classList.add('comment-content');

                    const span = document.createElement('span');
                    span.classList.add('font-weight-bold', 'mr-2', 'text-dark');
                    span.innerText = result.fullname;

                    const spanTwo = document.createElement('span');
                    spanTwo.classList.add('text-secondary');
                    spanTwo.innerText = result.body;

                    comment.append(span, spanTwo);

                    newComment.append(comment);

                    commentList.insertAdjacentElement('afterbegin', newComment);

                    // New Comment count
                    document.getElementById('comment-count').innerHTML = result.commentCount;

                    form.querySelector('input[name="body"]').value = '';
                } else {
                    // Handle Failure (Validation error / Server error)
                    // The token has already updated above, so the form is ready for a retry
                    alert(result.message || 'An unexpected error occurred.');
                }
            } catch (error) {
                console.error('Submission Error:', error);
                alert('Network communication error. Please try again.');
            } finally {
                submitBtn.disabled = false;
            }
        }

        // On Form submit
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            fetchComments();
        });

        // On Enter input
        const commentInput = document.getElementById('comment-input');
        commentInput.addEventListener('click', (event) => {
            event.preventDefault();
            if (event.key === 'Enter') {
                fetchComments();
            }
        });

    });

</script>