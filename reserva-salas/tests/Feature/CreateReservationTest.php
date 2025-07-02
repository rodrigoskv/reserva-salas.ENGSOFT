<?php
namespace Tests\Feature;

use CodeIgniter\Test\FeatureTestCase;

class CreateReservationTest extends FeatureTestCase
{
    public function testCreateReservation()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->post('/reservations', [
                             'room_id' => 1,
                             'date' => date('Y-m-d', strtotime('+2 day')),
                             'start_time' => '08:00:00',
                             'end_time' => '09:00:00',
                         ]);

        $response->assertStatus(302);
        $response->assertRedirectTo('/dashboard');
    }
}
