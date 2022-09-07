<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Routine extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'routine_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'time' => [
                'type' => 'TIME',
                'null' => false
            ]
        ]);

        $this->forge->addKey('routine_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->createTable('routines');
    }

    public function down()
    {
        $this->forge->dropTable('routines');
    }
}
