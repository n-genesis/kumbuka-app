<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotebooksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 145, 'null' => false],
            'metadata' => ['type' => 'TEXT', 'default' => null, 'null' => true],
            'description' => ['type' => 'TEXT', 'default' => null, 'null' => true],
            'theme_color' => [
                'type'       => 'ENUM',
                'constraint' => ['primary','success', 'warning', 'danger'], // Define ENUM values 
                'default'    => 'primary',
                'null'       => false,
            ],
            'image_path'=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => null, 'null' => true],
            'visibility' => [
                'type'       => 'ENUM',
                'constraint' => ['private','public'], 
                'default'    => 'public',
                'null'       => false,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE'); // Link to Shield's users table
        $this->forge->createTable('notebooks');
    }

    public function down()
    {
        $this->forge->dropTable('notebooks');
    }
}
