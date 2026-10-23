<div class="container py-4">
    <h1 class="h3 mb-3">New Comment</h1>
    <form action="<?= site_url('comments/create') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="content" class="form-label">Comment</label>
            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="note_id" class="form-label">Note ID</label>
            <input type="number" name="note_id" id="note_id" class="form-control" value="<?= old('note_id') ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save Comment</button>
        <a href="<?= site_url('comments') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
