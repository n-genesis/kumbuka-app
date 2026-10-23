<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePinnedItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'entity_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true , 'default' => null],
            'entity_type' => ['type' => 'VARCHAR', 'constraint' => 128],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pinned_items', true);
    }

    public function down()
    {
        $this->forge->dropTable('pinned_items');
    }
}
