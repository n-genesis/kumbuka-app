<div class="container py-4">
    <h1 class="h3 mb-3">Delete Comment</h1>
    <div class="alert alert-warning">
        Are you sure you want to delete this comment?
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <p><?= esc($comment->content) ?></p>
        </div>
    </div>
    <form action="<?= site_url('comments/delete/' . $comment->id) ?>" method="post">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="<?= site_url('comments') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
