<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PinnedItemSeeder extends Seeder
{
    public function run()
    {
        $pinnedNotes = [
      [
        'user_id' => 1,
        'entity_id' => 1,
        'entity_type' => 'note',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 1,
        'entity_id' => 2,
        'entity_type' => 'note',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 1,
        'entity_id' => 1,
        'entity_type' => 'notebook',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 1,
        'entity_id' => 2,
        'entity_type' => 'notebook',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 1,
        'entity_id' => 5,
        'entity_type' => 'notebook',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 2,
        'entity_id' => 3,
        'entity_type' => 'note',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 2,
        'entity_id' => 4,
        'entity_type' => 'note',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 2,
        'entity_id' => 2,
        'entity_type' => 'notebook',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 3,
        'entity_id' => 5,
        'entity_type' => 'note',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 3,
        'entity_id' => 1,
        'entity_type' => 'notebook',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'user_id' => 3,
        'entity_id' => 2,
        'entity_type' => 'notebook',
        'created_at' =>  Time::yesterday(),
      ],
      
    ];
    
    $this->db->table('pinned_items')->insertBatch($pinnedNotes);
    }
}
