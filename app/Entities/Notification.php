<?php
namespace App\Entities;

use App\Models\NotificationModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class Notification extends Entity
{
    protected $datamap = [
        'notification_id' => 'id',
        'notification_created_at' => 'created_at',
    ];
    protected $dates   = ['updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'integer',
    ];

    public function getCreatedAt(): string
    {
        // Access the raw datetime string from the database row
        $rawDate = $this->attributes['notification_created_at'];

        if (empty($rawDate)) {
            return 'Not Published Yet';
        }

        $time = Time::parse($rawDate);
        return $time->humanize();
    }

    public function getUnreadNotifications(){
        $mode = model(NotificationModel::class);

        return $mode->getUnreadCountbyUserId($this->attributes['id']);
    }
}
