<?php

namespace App\Cells;

use App\Models\FollowerModel;
use CodeIgniter\View\Cells\Cell;

class UserFeedSectionCell extends Cell
{
    protected $latestNotes;
    public function mount()
    {
        // Assuming Shield auth is active:
        $userId = auth()->id() ?? 1; 
        $noteModel = model(FollowerModel::class);

        // Fetch the latest notes for the user
        $this->latestNotes = $noteModel->getFollowingUsersLatestNotes($userId, 3); // Fetch 5 latest notes
    }

    public function getLatestNotesProperty()
    {
        return $this->latestNotes;
    }
}
