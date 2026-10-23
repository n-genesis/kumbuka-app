<!-- Comment fomr Section Container Cards -->

<!-- Comment Form Card Wrapper -->
<div class="card border rounded">

    <!-- Card Header -->
    <div class="card-header border-bottom">
        <h6 class="my-3"><i class="bi bi-pencil-square text-primary"></i> Leave a Comment</h6>
    </div>

    <!-- Card Body Form Entry Panel -->
    <div class="card-body">
        <form id="comment-form" method="post" action="<?= site_url('comments/store') ?>">
            <input type="hidden" name="note_id" value="<?= $note_id ?>">
            <!-- Comment Textarea Field -->
            <div class="mb-3">
                <label for="comment-input" class="form-label">Your Message</label>
                <textarea id="comment-input" class="form-control border-defined py-2 px-3 bg-light-subtle"
                    name="content" rows="4"
                    placeholder="What are you thinking? Share your thoughts or feedback about this note."
                    style="resize: vertical; font-size: 0.875rem;" required></textarea>
            </div>

            <!-- Action Control Buttons Matrix Split -->
            <div class="d-flex justify-content-between align-items-center pt-2 border-top border-light-subtle">
                <!-- User Profile Context Indicator Hint -->
                <div class="small" style="font-size: 0.78rem;">
                    <span>Posting as <strong><?= esc(auth()->user()->username) ?></strong></span>
                </div>

                <!-- Submit CTA Button Triggers -->
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-action" onclick="document.getElementById('comment-form').reset()">Clear</button>
                    <button type="submit" class="btn btn-sm btn-primary btn-action">
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
    <div id="comment-list" class="card-body p-0">
        <?php if ($comments): ?>
            <!-- Comment Item -->
            <?php foreach ($comments as $comment): ?>
                <div id="km-comment-<?= $comment->comment_id ?>"
                    class="feed-card d-flex align-items-start justify-content-between">
                    <div class="d-flex align-items-start gap-3">
                        <div>
                            <h6 class="mb-1 text-uppercase fw-bold text-dark small" style="letter-spacing: 0.5px;">
                                <?= esc($comment->username) ?></h6>
                            <p class="text-dark small mb-2"><?= esc($comment->content) ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="card-meta"><?= $comment->published_date ?></span>
                        <!-- Delete Option if Comment Owner -->
                        <?php if ($comment->user_id === auth()->id()): ?>
                            <form class="input-group" method="post"
                                action="<?= site_url("activity/comments/delete/$comment->comment_id") ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $comment->comment_id ?>">
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-0 border-0 dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <button class="dropdown-menu-item dropdown-item small text-danger" type="submit">
                                                <i class="bi bi-trash me-2"></i>Delete</button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="text-center">
                <h3 class="text-dark mb-1">There are no comment.</h3>
                <p class="text-muted small mb-0 mx-auto" style="max-width: 360px;">
                    Be the first to post one.
                </p>
            </div>
        <?php endif ?>
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
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': token
                    },
                    body: formData,
                });

                const result = await response.json();

                // CRITICAL: Always update the token field instantly if it exists in the payload
                if (result && result.csrf_token) {
                    csrfMeta.setAttribute('content', result.csrf_token);
                }

                if (response.ok && result.status === 'success') {

                    // Handle Success
                    const noCommentsMsg = document.getElementById('no-comments');
                    if (noCommentsMsg) noCommentsMsg.remove();

                    const commentList = document.getElementById('comment-list');

                    const newComment = document.createElement('div');
                    newComment.classList.add('feed-card', 'd-flex', 'align-items-start', 'justify-content-between')

                    const container = document.createElement('div');
                    container.classList.add('d-flex', 'align-items-start', 'gap-3')
                    newComment.append(container);

                    const div = document.createElement('div');
                    container.append(div);

                    const header = document.createElement('h6');
                    header.classList.add('mb-1', 'text-uppercase', 'fw-bold', 'text-dark', 'small');
                    header.innerText = result.username;

                    const para = document.createElement('p');
                    para.classList.add('small', 'mr-2', 'text-dark');
                    para.innerText = result.content;

                    div.append(header, para);

                    newComment.append(container);

                    commentList.insertAdjacentElement('afterbegin', newComment);

                    form.querySelector('textarea[name="content"]').value = '';
                    // Reload For Now
                    location.reload();
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
        commentInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                fetchComments();
            }
        });

    });

</script>