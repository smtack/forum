<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_username' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
                'unique' => true
            ],
            'user_email' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
                'unique' => true,
            ],
            'user_password' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
            ],
            'user_avatar' => [
                'type' =>'VARCHAR',
                'constraint' => '256',
                'default' => 'default.png',
            ],
            'user_level' => [
                'type' => 'INT',
                'default' => '2',
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

        $this->forge->addPrimaryKey('user_id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
