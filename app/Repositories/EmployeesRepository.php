<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\DailyWorker;
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
        $query = DailyWorker::select('badgenumber', 'name', 'daily_rate', 'site')->get();

        return $query;
    }

    public function getDailyWorkerAttendance()
    {

        $results = DB::table('daily_worker_attendance as t')
            ->select('t.id', 't.badgenumber', 'u.name', 't.checktime')
            ->join('daily_worker as u', 't.badgenumber', '=', 'u.badgenumber')
            ->whereBetween('t.checktime', [now()->subMonth(), now()])
            ->get();

        return $results;
    }
}
