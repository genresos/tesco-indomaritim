<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FingerMachine extends Model
{
    use HasFactory;

    protected $connection = 'finger_machine_db';

    protected $table = 'iclock'; // Nama tabel

    protected $fillable = [
        'SN',
        'State',
        'LastActivity',
        'TransTimes',
        'TransInterval',
        'LogStamp',
        'OpLogStamp',
        'PhotoStamp',
        'Alias',
        'DeptID',
        'UpdateDB',
        'Style',
        'FWVersion',
        'FPCount',
        'TransactionCount',
        'UserCount',
        'MainTime',
        'MaxFingerCount',
        'MaxAttLogCount',
        'DeviceName',
        'AlgVer',
        'FlashSize',
        'FreeFlashSize',
        'Language',
        'VOLUME',
        'DtFmt',
        'IPAddress',
        'IsTFT',
        'Platform',
        'Brightness',
        'BackupDev',
        'OEMVendor',
        'City',
        'AccFun',
        'TZAdj',
        'DelTag',
        'FPVersion',
        'PushVersion',
    ];
}


