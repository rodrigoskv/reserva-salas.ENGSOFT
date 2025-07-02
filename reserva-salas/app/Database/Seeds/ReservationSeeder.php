<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_id' => 1,
            'room_id' => 1,
            'date' => date('Y-m-d', strtotime('+1 day')),
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
        ];

        $this->db->table('reservations')->insert($data);
    }
}
