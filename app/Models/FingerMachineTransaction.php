<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FingerMachineTransaction extends Model
{
    use HasFactory;

    protected $connection = 'finger_machine_db';

    protected $table = 'checkinout'; // Nama tabel

    protected $fillable = [
        'userid',
        'checktime',
        'checktype',
        'verifycode',
        'SN',
        'sensorid',
        'WorkCode',
        'Reserved',
    ];
}


