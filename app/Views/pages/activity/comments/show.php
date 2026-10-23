<div class="container py-4">
    <h1 class="h3 mb-3">View Comment</h1>
    <div class="card">
        <div class="card-body">
            <p><?= esc($comment->content) ?></p>
            <p class="mb-0 small text-muted">Status: <?= esc($comment->status ?? 'published') ?></p>
        </div>
    </div>
</div>
