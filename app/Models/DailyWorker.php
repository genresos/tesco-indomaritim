<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWorker extends Model
{
    use HasFactory;

    protected $table = 'daily_worker';

    protected $fillable = [
        'badgenumber',
        'name',
        'rate',
        'department',
        'status',
        'rate',
        'site',
        'bank_name',
        'bank_account_no',
        'bank_account_name',
        'rapel',
        'nik',
        'personal_loan',
        'installment_loan',
        'meal_allowance_perday'
    ];

    public $timestamps = true;
}
