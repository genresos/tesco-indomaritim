<?php

namespace App\Repositories;

use App\Models\Canteen;
use App\Models\DailyWorkerAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Collection;


class CanteenTransactionRepository extends Repository
{
    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Canteen();
    }
    /**
     * Get all CanteenTransaction.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */


    /**
     * getFullData
     *
     * @return Collection
     */
    public function getAll()
    {
        return DB::table('canteen_transaction as ct')
            ->leftJoin('userinfo as u', 'ct.badgenumber', '=', 'u.badgenumber')
            ->select(
                'ct.badgenumber as id',
                'u.name',
                DB::raw('DATE_FORMAT(MIN(CASE WHEN ct.type = 0 THEN ct.time END), "%d-%b-%Y %H:%i") as checkin'),
                DB::raw('DATE_FORMAT(MAX(CASE WHEN ct.type = 1 THEN ct.time END), "%d-%b-%Y %H:%i") as checkout')
            )
            ->whereDate('ct.time', '>=', '2024-11-05')
            ->groupBy('ct.badgenumber', 'u.name', DB::raw('DATE(ct.time)'))
            ->orderBy('ct.badgenumber')
            ->orderBy(DB::raw('DATE(ct.time)'))
            ->get();
    }

    // /**
    //  * Find employee by id.
    //  *
    //  * @param int $id
    //  * @return \App\Models\Employee|null
    //  */
    // public function find($id)
    // {
    //     return Employee::find($id);

    //     $CanteenTransaction = Employee::latest()->get();
    //     return $CanteenTransaction;
    // }

    /**
     * Create a new employee.
     *
     * @param array $data
     * @return \App\Models\Canteen
     */
    public function create(array $data)
    {
        return Canteen::create($data);
    }

    /**
     * Update an existing employee.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Canteen
     */
    // public function update($id, array $data)
    // {
    //     $employee = $this->find($id);
    //     if ($employee) {
    //         $employee->update($data);
    //     }
    //     return $employee;
    // }


}
