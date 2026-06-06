<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_username' => 'Admin',
            'user_email' => 'admin@example.com',
            'user_password' => password_hash('admin', PASSWORD_BCRYPT),
            'user_level' => 0,
        ];

        $this->db->table('users')->insert($data);
    }
}
