<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
                'unique' => true,
            ],
            'category_description' => [
                'type' => 'TEXT',
                'constraint' => '1000',
            ],
        ]);

        $this->forge->addPrimaryKey('category_id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
