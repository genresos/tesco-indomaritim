<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWorkerAttendance extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan
    protected $table = 'daily_worker_attendance';

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'badgenumber',
        'checktime',
    ];

    // Mengatur timestamps
    public $timestamps = true;

    // Relasi dengan model DailyWorker
    public function dailyWorker()
    {
        return $this->belongsTo(DailyWorker::class, 'badgenumber', 'badgenumber');
    }
}
