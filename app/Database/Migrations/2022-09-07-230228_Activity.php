<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Activity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'activity_id' => [
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
            'date_activity' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM("1","0" )', //1 for completed task, 0 for uncompleted
                'null' => false
            ],
            'completed_date' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('activity_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->createTable('activitys');
    }

    public function down()
    {
        $this->forge->dropTable('activitys');
    }
}
