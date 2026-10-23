<?php
namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
use App\Models\FollowerModel;

class FollowerListCell extends Cell
{
    protected $followers;

    public function mount()
    {
        $model = model(FollowerModel::class);
        $userId = auth()->user()->id;
        // Fetch users who follow the given userId
        $this->followers = $model->getFollowers($userId);
    }

    // Properties/Methods are automatically available in the view
    public function getFollowersProperty()
    {
        return $this->followers;
    }
}