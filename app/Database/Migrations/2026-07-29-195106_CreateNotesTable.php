<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 128],
            'title' => ['type' => 'VARCHAR', 'constraint' => 128],
            'content' => ['type' => 'TEXT', null => false],
            'color' => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => true , 'default' => null],
            'allow_comments' => ['type' => 'BOOLEAN', 'null' => true, 'default' => 0],
            'visibility' => [
                'type'       => 'ENUM',
                'constraint' => ['private','public','unlisted'], // Define the ENUM values here
                'default'    => 'private',
                'null'       => false,
            ],
            'notebook_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true , 'default' => null],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE'); 
        $this->forge->addForeignKey('notebook_id', 'notebooks', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->createTable('notes');
    }

    public function down()
    {
        $this->forge->dropTable('notes');
    }
}
