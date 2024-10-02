<?php

namespace App\Repositories;

use App\Models\FingerMachine;
use App\Models\FingerMachineTransaction;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Collection;

class FingerMachineRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new FingerMachine(); 
    }

    /**
     * getFullData
     *
     * @return Collection
     */
    public function getMachineData()
    {
        return $this->model->orderBy('LastActivity','desc')->get();
    }

    public function getAllTransaction(){
        $query = FingerMachineTransaction::select('c.id', 'u.badgenumber as pin', 'u.name', 'c.checktime', 'c.SN as device')
        ->join('userinfo as u', 'u.userid', '=', 'c.userid')
        ->from('checkinout as c');


        // Mengambil tanggal saat ini
        $currentDate = now();

        // Mengambil tanggal 21 bulan sebelumnya
        $startDate = now()->subMonth()->day(21)->startOfDay();
        
        // Menambahkan kondisi untuk filter berdasarkan checktime
        $query->whereBetween('c.checktime', [$startDate, $currentDate]);

        return $query->orderBy('c.id', 'desc')->get();
    }


    public function getMachineTransaction($SN)
    {
        $query = FingerMachineTransaction::select('c.id', 'u.badgenumber as pin', 'u.name', 'c.checktime', 'c.SN as device')
        ->join('userinfo as u', 'u.userid', '=', 'c.userid')
        ->from('checkinout as c');


        // Mengambil tanggal saat ini
        $currentDate = now();

        // Mengambil tanggal 21 bulan sebelumnya
        $startDate = now()->subMonth()->day(21)->startOfDay();

        if ($SN !== null) {
            $query->where('c.SN', $SN);
        }

        // Menambahkan kondisi untuk filter berdasarkan checktime
        $query->whereBetween('c.checktime', [$startDate, $currentDate]);

        return $query->orderBy('c.id', 'desc')->get();
    }
}
