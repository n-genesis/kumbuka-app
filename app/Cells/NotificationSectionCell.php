<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
use App\Models\NotificationModel;

class NotificationSectionCell extends Cell
{
    protected $notifications;

    public function mount()
    {
        $noticeModel = model(NotificationModel::class);
        // Fetch users who follow the given userId
        $this->notifications = $noticeModel->getNotificationsByUserId(auth()->id());

    }

    // Properties/Methods are automatically available in the view
    public function getNotificationsProperty()
    {
        return $this->notifications;
    }
}

