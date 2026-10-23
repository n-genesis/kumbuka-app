<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InsertSeeder extends Seeder
{
    public function run()
    {
        // Users Inserts
        $this->call('AdminSeeder');
        // User Details Inserts
        $this->call('UserDetailSeeder');
        // Notebook Types Inserts
        // $this->call('NoteTypeSeeder');
        // Notebooks Inserts
        $this->call('NotebookSeeder');
        // Nootbook Images
        // $this->call('NotebookImagesSeeder');
        // Notes Inserts
        $this->call('NoteSeeder');
        // Note Images
        $this->call('NoteImageSeeder');
        // Followers Inserts
        $this->call('FollowerSeeder');
        // User share Inserts
        $this->call('NotebookShareSeeder');
        // User Pinned Notes & Notebooks
        $this->call('PinnedItemSeeder');
        // Note Comments Inserts
        $this->call('CommentSeeder');
        // Note Comments Inserts
        $this->call('NotificationsSeeder');
    }
}
