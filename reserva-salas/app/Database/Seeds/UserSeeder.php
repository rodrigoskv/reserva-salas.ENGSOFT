<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ];

        $this->db->table('users')->insert($data);
    }
}
