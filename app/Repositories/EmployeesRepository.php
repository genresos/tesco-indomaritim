<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\DailyWorkerAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Collection;


class EmployeesRepository extends Repository
{
    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Employee();
    }
    /**
     * Get all employees.
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
        return Employee::all();
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

    //     $employees = Employee::latest()->get();
    //     return $employees;
    // }

    /**
     * Create a new employee.
     *
     * @param array $data
     * @return \App\Models\Employee
     */
    public function create(array $data)
    {
        return Employee::create($data);
    }

    /**
     * Update an existing employee.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Employee
     */
    // public function update($id, array $data)
    // {
    //     $employee = $this->find($id);
    //     if ($employee) {
    //         $employee->update($data);
    //     }
    //     return $employee;
    // }

    /**
     * Delete an employee.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $employee = $this->find($id);
        if ($employee) {
            return $employee->delete();
        }
        return false;
    }

    public function getDailyWorker()
    {
        $query = DB::table('daily_worker as daily_workers')->select(
            'daily_workers.badgenumber',
            'daily_workers.name',
            'daily_workers.site',
            'daily_workers.department',
            'daily_workers.status',
            'daily_workers.rate',
            'daily_workers.bank_name',
            'daily_workers.bank_account_no',
            'daily_workers.bank_account_name',
            'daily_worker_salary_type.type' // Ganti dengan kolom yang ingin diambil dari tabel salary_type
        )
            ->join('daily_worker_salary_type', 'daily_worker_salary_type.id', '=', 'daily_workers.salary_type')
            ->whereNotNull('daily_workers.rate')
            ->get();



        return $query;
    }

    public function getDailyWorkerAttendance()
    {

        $results = DB::table('daily_worker_attendance as t')
            ->select('t.id', 't.badgenumber', 'u.name', 't.checktime')
            ->join('daily_worker as u', 't.badgenumber', '=', 'u.badgenumber')
            ->whereBetween('t.checktime', [now()->subMonth(), now()])
            ->whereNotNull('u.rate')
            ->get();

        return $results;
    }

    public function getPayrollListDailyWorker()
    {
        $results = DB::table('daily_worker_salary as s')
            ->join('daily_worker as u', 's.badgenumber', '=', 'u.badgenumber')
            ->select('u.*', 's.*')
            ->get();

        return $results;
    }
}
