<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFollowersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'follower_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'followed_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['accepted','denied'], // Define the ENUM values here
                'default'    => 'accepted',
                'null'       => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey(['follower_id', 'followed_id']);
        $this->forge->addForeignKey('follower_id', 'users', 'id', 'CASCADE', 'CASCADE'); // Link to Shield's users table
        $this->forge->addForeignKey('followed_id', 'users', 'id', 'CASCADE', 'CASCADE'); // Link to Shield's users table
        $this->forge->createTable('followers');
    }

    public function down()
    {
        $this->forge->dropTable('followers');
    }
}
