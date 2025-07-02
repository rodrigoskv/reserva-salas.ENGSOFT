<?php
namespace Tests\Performance;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\ReservationModel;

class StressReservationTest extends CIUnitTestCase
{
    public function testMultipleReservations()
    {
        $model = new ReservationModel();
        $date = date('Y-m-d', strtotime('+3 day'));
        $room_id = 1;

        for ($i = 0; $i < 100; $i++) {
            $start = sprintf('%02d:00:00', ($i % 12) + 1);
            $end = sprintf('%02d:00:00', (($i % 12) + 2));

            $data = [
                'user_id' => 1,
                'room_id' => $room_id,
                'date' => $date,
                'start_time' => $start,
                'end_time' => $end,
            ];

            $model->insert($data);
        }

        $this->assertGreaterThanOrEqual(100, $model->where('date', $date)->countAllResults());
    }
}
