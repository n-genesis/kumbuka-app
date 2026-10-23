<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
use App\Models\CommentModel;

class CommentSectionCell extends Cell
{
    public $note_id; // This property is automatically filled from the view_cell() call
    protected $comments;

    public function mount()
    {
        $model = model(CommentModel::class);
        // Fetch users who follow the given userId
        $this->comments = $model->getCommentsByNoteId($this->note_id);

    }

    // Properties/Methods are automatically available in the view
    public function getCommentsProperty()
    {
        return $this->comments;
    }
}
