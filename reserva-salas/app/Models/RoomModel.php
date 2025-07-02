<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'capacity'];
    protected $returnType = 'array';

    protected $validationRules = [
        'name' => 'required',
        'capacity' => 'required|integer',
    ];
}
