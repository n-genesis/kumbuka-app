<div class="container py-4">
    <h1 class="h3 mb-3">Edit Comment</h1>
    <form action="<?= site_url('comments/update/' . $comment->id) ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="content" class="form-label">Comment</label>
            <textarea name="content" id="content" rows="5" class="form-control" required><?= esc($comment->content) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="note_id" class="form-label">Note ID</label>
            <input type="number" name="note_id" id="note_id" class="form-control" value="<?= esc($comment->note_id) ?>">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="published" <?= $comment->status === 'published' ? 'selected' : '' ?>>Published</option>
                <option value="draft" <?= $comment->status === 'draft' ? 'selected' : '' ?>>Draft</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Comment</button>
        <a href="<?= site_url('comments') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
