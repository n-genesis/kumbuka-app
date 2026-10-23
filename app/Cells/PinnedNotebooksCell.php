<?php

namespace App\Cells;

use App\Models\PinnedItemModel;
use CodeIgniter\View\Cells\Cell;

class PinnedNotebooksCell extends Cell
{
    protected $pinnedNotebooks;
    protected $isPinned;
    public function mount()
    {
        // Assuming Shield auth is active:
        $userId = auth()->id(); 
        $pinnedModel = model(PinnedItemModel::class);

        $this->pinnedNotebooks = $pinnedModel->getPinnedItemsByUserId($userId, 'notebook', 3);


    }

    public function getPinnedNotebooksProperty()
    {
        return $this->pinnedNotebooks;
    }
    public function getIsPinnedProperty()
    {
        return $this->isPinned;
    }
}
