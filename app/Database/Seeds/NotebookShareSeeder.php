<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class NotebookShareSeeder extends Seeder
{
    public function run()
    {
         $notebookShare = [
      [
        'notebook_id' => 1,
        'user_id' => 2,
        'access_level' => 'view',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 1,
        'user_id' => 3,
        'access_level' => 'view',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 2,
        'user_id' => 2,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 2,
        'user_id' => 3,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 3,
        'user_id' => 1,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 3,
        'user_id' => 3,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 3,
        'user_id' => 4,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 4,
        'user_id' => 1,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 4,
        'user_id' => 2,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 4,
        'user_id' => 4,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 5,
        'user_id' => 1,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 5,
        'user_id' => 2,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],
      [
        'notebook_id' => 5,
        'user_id' => 3,
        'access_level' => 'edit',
        'created_at' =>  Time::now(),
      ],

    ];
    
    $this->db->table('notebook_shares')->insertBatch($notebookShare);
    }
}
