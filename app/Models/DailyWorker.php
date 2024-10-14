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
        'daily_rate',
        'site',
    ];

    public $timestamps = true;
}
