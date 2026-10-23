<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;


class NoteImageSeeder extends Seeder {
    public function run() {
        $currentTime = Time::now()->toDateTimeString();

        $noteImagesData = [
            // User 4 "All The Cats Note Post"
            [
                'user_id' => 4, 
                'note_id' => 5, 
                'file_path' => 'uploads/gallery/all-the-catz/image_7f17c35d.png', 
                'file_name' => 'Post 1', 
                'file_size' => 0,
                'sort_order' => 1,
                'created_at' => $currentTime,
            ],
            [
                'user_id' => 4, 
                'note_id' => 5, 
                'file_path' => 'uploads/gallery/all-the-catz/image_8b393e1e.png', 
                'file_name' => 'Post 2', 
                'file_size' => 0,
                'sort_order' => 2,
                'created_at' => $currentTime,
            ],
            [
                'user_id' => 4, 
                'note_id' => 5, 
                'file_path' => 'uploads/gallery/all-the-catz/image_2ac0f337.png', 
                'file_name' => 'Post 3', 
                'file_size' => 0,
                'sort_order' => 3,
                'created_at' => $currentTime,
            ],
            // User 4 "Coffee Shope"
            [
                'user_id' => 4, 
                'note_id' => 6, 
                'file_path' => 'uploads/gallery/coffee-shop/image_4a59e7f8.png', 
                'file_name' => 'Post 1', 
                'file_size' => 0,
                'sort_order' => 1,
                'created_at' => $currentTime,
            ],
            [
                'user_id' => 4, 
                'note_id' => 6, 
                'file_path' => 'uploads/gallery/coffee-shop/image_9719d5fd.png', 
                'file_name' => 'Post 2', 
                'file_size' => 0,
                'sort_order' => 2,
                'created_at' => $currentTime,
            ],
            [
                'user_id' => 4, 
                'note_id' => 6, 
                'file_path' => 'uploads/gallery/coffee-shop/image_6fe09699.png', 
                'file_name' => 'Post 3', 
                'file_size' => 0,
                'sort_order' => 3,
                'created_at' => $currentTime,
            ],
            // User 4 "Watches Final Hour"
             [
                'user_id' => 4, 
                'note_id' => 7, 
                'file_path' => 'uploads/gallery/final-hour/image_f7669841.png', 
                'file_name' => 'Post 1', 
                'file_size' => 0,
                'sort_order' => 1,
                'created_at' => $currentTime,
            ],
            [
                'user_id' => 4, 
                'note_id' => 7, 
                'file_path' => 'uploads/gallery/final-hour/image_9bb4f838.png', 
                'file_name' => 'Post 2', 
                'file_size' => 0,
                'sort_order' => 2,
                'created_at' => $currentTime,
            ],
            // User 4 "Compass"
            [
                'user_id' => 4,
                'note_id' => 8, 
                'file_path' => 'uploads/gallery/compass/image_598740ee.png', 
                'file_name' => 'Post 3', 
                'file_size' => 0,
                'sort_order' => 1,
                'created_at' => $currentTime,
            ],
            [
                'user_id' => 4, 
                'note_id' => 8, 
                'file_path' => 'uploads/gallery/compass/image_8b26d94f.png', 
                'file_name' => 'Post 1', 
                'file_size' => 0,
                'sort_order' => 2,
                'created_at' => $currentTime,
            ],
            [
                'user_id' => 4, 
                'note_id' => 8, 
                'file_path' => 'uploads/gallery/compass/image_33f3c980.png', 
                'file_name' => 'Post 2', 
                'file_size' => 0,
                'sort_order' => 3,
                'created_at' => $currentTime,
            ],


        ];

        $this->db->table('note_image')->insertBatch($noteImagesData);
    }
}
