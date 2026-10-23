<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $db = db_connect();

        $comments = [
            [
                'user_id' => 1,
                'note_id' => 1,
                'content' => 'Great note! This is a helpful example comment for development testing.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 1,
                'note_id' => 2,
                'content' => 'I like how this note is structured. It makes reviewing content much easier.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 1,
                'note_id' => 3,
                'content' => 'This is a draft-style sample comment to test the edit flow.',
                'status' => 'draft',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 2,
                'note_id' => 2,
                'content' => 'I like how this note is structured. It makes reviewing content much easier.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 3,
                'note_id' => 3,
                'content' => 'This is a draft-style sample comment to test the edit flow.',
                'status' => 'draft',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 4,
                'note_id' => 4,
                'content' => 'Another sample comment for the CRUD interface and UI development.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 2,
                'note_id' => 1,
                'content' => 'I like how this note is structured. It makes reviewing content much easier.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 3,
                'note_id' => 1,
                'content' => 'This is a draft-style sample comment to test the edit flow.',
                'status' => 'draft',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 4,
                'note_id' => 1,
                'content' => 'Another sample comment for the CRUD interface and UI development.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 2,
                'note_id' => 3,
                'content' => 'I like how this note is structured. It makes reviewing content much easier.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 3,
                'note_id' => 3,
                'content' => 'This is a draft-style sample comment to test the edit flow.',
                'status' => 'draft',
                'created_at' => Time::yesterday(),
            ],
            [
                'user_id' => 4,
                'note_id' => 2,
                'content' => 'Another sample comment for the CRUD interface and UI development.',
                'status' => 'published',
                'created_at' => Time::yesterday(),
            ],
        ];

        foreach ($comments as $comment) {
            $db->table('comments')->insert($comment);
        }
    }
}
