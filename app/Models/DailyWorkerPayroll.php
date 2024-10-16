<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWorkerPayroll extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan
    protected $table = 'daily_worker_salary';

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'badgenumber',
        'working_days',
        'gross_income',
        'income_arrears',
        'loan',
        'tax',
        'net_income',
        'gap',
        'created_by',
        'updated_by',
    ];

    // Mengatur timestamps
    public $timestamps = true;

    // Relasi dengan model DailyWorker
    public function dailyWorker()
    {
        return $this->belongsTo(DailyWorker::class, 'badgenumber', 'badgenumber');
    }
}
