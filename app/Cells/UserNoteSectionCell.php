<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
use App\Models\NoteModel;

class UserNoteSectionCell extends Cell
{
    public $userId;
    protected $notes;

    public function mount()
    {
        $noteModel = model(NoteModel::class);
        // Fetch users who follow the given userId
        $this->notes = $noteModel->getNotesByUserId($this->userId);

    }

    // Properties/Methods are automatically available in the view
    public function getNotesProperty()
    {
        return $this->notes;
    }
}