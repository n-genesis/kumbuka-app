<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class NotificationsSeeder extends Seeder
{
    public function run()
    {
        $noticesData = [
            [
                'recipient_id' => 1, 
                'actor_id'=> 2,
                'source_id'=> 1,
                'source_type' => 'share',
                'message' => 'Wow someone shared your note.',
                'is_read' => 0,
                'created_at' => Time::now(),
            ],
            [
                'recipient_id' => 1, 
                'actor_id'=> 3,
                'source_id'=> 2,
                'source_type' => 'share',
                'message' => 'Way to go, someone shared your note.',
                'is_read' => 0,
                'created_at' => Time::now(),
            ],
            [
                'recipient_id' => 1, 
                'actor_id'=> 4,
                'source_id'=> 1,
                'source_type' => 'comment',
                'message' => 'I guess someone might think....',
                'is_read' => 0,
                'created_at' => Time::now(),
            ],
            [
                'recipient_id' => 2, 
                'actor_id'=> 1,
                'source_id'=> 0,
                'source_type' => 'welcome',
                'message' => "Welcome To Kumbuka, thanks for Signing up. You're now ready to start posting notes.",
                'is_read' => 0,
                'created_at'=> Time::now(),
            ],
            [
                'recipient_id' => 2, 
                'actor_id'=> 1,
                'source_id'=> 3,
                'source_type' => 'share',
                'message' => 'Cool, I guess. Ha!',
                'is_read' => 0,
                'created_at' => Time::now(),
            ],
            [
                'recipient_id' => 2, 
                'actor_id'=> 3,
                'source_id'=> 4,
                'source_type' => 'comment',
                'message' => 'Well, I guess someone had something to say.',
                'is_read' => 0,
                'created_at' => Time::now(),
            ],
            [
                'recipient_id' => 2, 
                'actor_id'=> 4,
                'source_id'=> 3,
                'source_type' => 'share',
                'message' => 'Someone shared your note.',
                'is_read' => 0,
                'created_at'=> Time::now(),
            ],
            [
                'recipient_id' => 3, 
                'actor_id'=> 1,
                'source_id'=> 0,
                'source_type' => 'welcome',
                'message' => "Welcome To Kumbuka, thanks for Signing up. You're now ready to start posting notes.",
                'is_read' => 0,
                'created_at'=> Time::now(),
            ],
            [
                'recipient_id' => 3, 
                'actor_id'=> 1,
                'source_id'=> 0,
                'source_type' => 'comment',
                'message' => 'Well, I guess someone had something to say. Someone left a comment.',
                'is_read' => 0,
                'created_at' => Time::now(),
            ],
            [
                'recipient_id' => 3, 
                'actor_id'=> 1,
                'source_id'=> 0,
                'source_type' => 'share',
                'message' => 'Way to go, someone shared your note.',
                'is_read' => 0,
                'created_at' => Time::now(),
            ],
            [
                'recipient_id' => 4, 
                'actor_id'=> 1,
                'source_id'=> 0,
                'source_type' => 'welcome',
                'message' => "Welcome To Kumbuka, thanks for Signing up. You're now ready to start posting notes.",
                'is_read' => 0,
                'created_at'=> Time::now(),
            ],
            
        ];

        $this->db->table('notifications')->insertBatch($noticesData);
    }
}
