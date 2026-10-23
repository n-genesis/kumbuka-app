<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNoteImagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'note_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true ],
            'file_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_size' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'default' => 0 ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('note_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('note_id', 'notes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('note_image');
    }

    public function down()
    {
        $this->forge->dropTable('note_image');
    }
}
