<?php

namespace App\Cells;

use App\Models\PinnedItemModel;
use CodeIgniter\View\Cells\Cell;

class PinnedNotesCell extends Cell
{
    protected $pinnedNotes;
    protected $isPinned;
    public function mount()
    {
        // Assuming Shield auth is active:
        $userId = auth()->id(); 
        $pinnedModel = model(PinnedItemModel::class);

        $this->pinnedNotes = $pinnedModel->getPinnedItemsByUserId($userId, 'note', 3);


    }

    public function getPinnedNotesProperty()
    {
        return $this->pinnedNotes;
    }
    public function getIsPinnedProperty()
    {
        return $this->isPinned;
    }
}
