<?php
namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\ReservationModel;

class ReservationModelTest extends CIUnitTestCase
{
    public function testCheckTimeConflict()
    {
        $model = new ReservationModel();
        $hasConflict = $model->hasTimeConflict(1, date('Y-m-d', strtotime('+1 day')), '09:30:00', '10:30:00');
        $this->assertTrue($hasConflict);
    }
}
