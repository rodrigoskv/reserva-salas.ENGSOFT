<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Room A', 'capacity' => 10],
            ['name' => 'Room B', 'capacity' => 20],
        ];

        $this->db->table('rooms')->insertBatch($data);
    }
}
