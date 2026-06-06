<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'post_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'post_text' => [
                'type' => 'TEXT',
                'constraint' => '5000',
            ],
            'post_topic' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'post_user' => [
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

        $this->forge->addPrimaryKey('post_id');
        $this->forge->addForeignKey('post_topic', 'topics', 'topic_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('post_user', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
