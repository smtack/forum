<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTopicsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'topic_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'topic_title' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
            ],
            'topic_category' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'topic_user' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('topic_id');
        $this->forge->addForeignKey('topic_category', 'categories', 'category_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('topic_user', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('topics');
    }

    public function down()
    {
        $this->forge->dropTable('topics');
    }
}
