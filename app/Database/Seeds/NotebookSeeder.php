<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class NotebookSeeder extends Seeder
{
    public function run()
    {
        $notebooks = [
      [
        'id' => 1,
        'name' => 'Just Ideas',
        'user_id' => 1,
        'metadata' => "funny thoughs, just me, adrian",
        'theme_color' => 'primary',
        'visibility' => 'public',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'id' => 2,
        'name' => 'Quick Thoughs',
        'user_id' => 1,
        'metadata' => "thingking, thoughts, funny thoughs",
        'theme_color' => 'success',
        'visibility' => 'public',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'id' => 3,
        'name' => "The Web Tech Guy's Notebook",
        'user_id' => 2,
        'metadata' => "tech notebook, computer notes, sample notes",
        'theme_color' => 'primary',
        'visibility' => 'public',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'id' => 4,
        'name' => 'A Demo Notebook',
        'user_id' => 3,
        'metadata' => "demo notebook, demo, demo notes",
        'theme_color' => 'primary',
        'visibility' => 'public',
        'created_at' =>  Time::yesterday(),
      ],
      [
        'id' => 5,
        'name' => 'What A thing',
        'user_id' => 4,
        'metadata' => "short stories, tales",
        'theme_color' => 'primary',
        'visibility' => 'public',
        'created_at' =>  Time::yesterday(),
      ],
    ];
    
    $this->db->table('notebooks')->insertBatch($notebooks);
    }
}
