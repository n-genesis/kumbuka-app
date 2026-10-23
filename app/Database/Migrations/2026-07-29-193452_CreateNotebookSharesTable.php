<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotebookSharesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'notebook_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'access_level' => [
                'type'       => 'ENUM',
                'constraint' => ['view','edit'],
                'default'    => 'view',
                'null'       => false,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('notebook_id', 'notebooks', 'id', 'NO ACTION', 'CASCADE'); 
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE'); 
        $this->forge->createTable('notebook_shares');
    }

    public function down()
    {
        $this->forge->dropTable('notebook_shares');
    }
}
