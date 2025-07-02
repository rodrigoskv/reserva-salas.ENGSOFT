<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'room_id', 'date', 'start_time', 'end_time'];
    protected $returnType = 'array';

    protected $validationRules = [
        'user_id' => 'required|integer',
        'room_id' => 'required|integer',
        'date' => 'required|valid_date',
        'start_time' => 'required',
        'end_time' => 'required',
    ];
}
