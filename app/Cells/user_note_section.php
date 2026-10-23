<!-- Note Card Block -->
<?php if($notes): ?>
<?php foreach ($notes as $note): ?>
<article class="card border-defined rounded-3 mb-3">
    <div class="card-header pt-3 pb-2 px-3 border-bottom border-defined d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="logo-wrapper rounded-circle border border-defined"
                style="width: 32px; height: 32px; overflow: hidden;">
                <img src="https://placehold.co/200" alt="<?= esc("$note->first_name $note->last_name") ?> Avatar" class="w-100 h-100">
            </div>
            <div>
                <h6 class="mb-0 fw-bold small">
                    <a href="<?= site_url("notes/show/$note->id") ?>" class="text-decoration-none link-body-emphasis"><?= esc($note->title) ?></a></h6>
                <p class="text-muted mb-0" style="font-size: 0.72rem;">Posted in 
                    <a href="<?= site_url("notebooks/$note->notebook_id") ?>" class="text-decoration-none fw-semibold link-body-emphasis">Notebooks / <?= esc($note->notebook_name) ?></a> • <?= $note->published_date ?></p>
            </div>
        </div>
        <!-- Card Inline Menu Actions -->
         <?php if($note->isPinned): ?>
            <span class="ms-auto me-2"><i class="bi bi-pin-angle-fill text-primary me-2"></i></span>
        <?php endif ?>
        <div class="dropdown">
            <button class="btn btn-link text-muted p-0 border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots-vertical"></i></button>
                <ul class="dropdown-menu dropdown-menu-end border border shadow-sm">
                    <li><a class="dropdown-item small" href="<?= site_url("pin/notes/$note->id") ?>">
                        <?php if($note->isPinned): ?>
                            <i class="bi bi-pin text-primary me-2"></i>Unpin Note</a>
                        <?php else: ?>
                            <i class="bi bi-pin-angle-fill me-2"></i>Pin Note</a>
                        <?php endif ?>
                    </li>
                </ul>
        </div>
        
    </div>
    <div class="card-body p-3">
        <a href="<?= site_url("notes/show/$note->id") ?>" class="text-decoration-none link-body-emphasis ">
        <?= esc($note->body_summary) ?>
        </a>
    </div>
</article>
<?php endforeach ?>
<?php else: ?>
<div class="card empty-component-box shadow-sm">
    <div class="card-body">
        <div class="text-center">
            <i class="bi bi-journal-x mb-2 d-block"></i>
            <div class="fw-bold small text-dark">No notes posted.</div>
        </div>
    </div>
</div>
<?php endif?>
