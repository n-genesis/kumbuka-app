<?php

namespace App\Cells;

use App\Models\FollowerModel;
use CodeIgniter\View\Cells\Cell;

class FriendListCell extends Cell
{
    protected $friends;

    public function mount()
    {
        $followerModel = model(FollowerModel::class);
        // Fetch users who follow the given userId
        $this->friends = $followerModel->getFollowing(auth()->id());

    }

    // Properties/Methods are automatically available in the view
    public function getfriendsProperty()
    {
        return $this->friends;
    }
}
