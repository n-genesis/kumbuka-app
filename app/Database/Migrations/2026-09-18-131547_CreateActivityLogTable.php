<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Null for guests/system

            // Categorization
            'category' => ['type' => 'ENUM', 'constraint' => ['security', 'content', 'system'], 'default' => 'content'],
            'severity' => ['type' => 'ENUM', 'constraint' => ['info', 'success', 'warning', 'danger'], 'default' => 'info'],

            // Description (What the user sees vs what the admin sees)
            'description' => ['type' => 'VARCHAR', 'constraint' => 255],
            'metadata' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],

            // Context
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45],
            'user_agent' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id'); // Index for fast lookup of user history
        $this->forge->createTable('activity_log');
    }

    public function down()
    {
        $this->forge->dropTable('activity_log');
    }
}
