<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    /**
     * Get all employees.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Employee::all();
    }

    /**
     * Find employee by id.
     *
     * @param int $id
     * @return \App\Models\Employee|null
     */
    public function find($id)
    {
        return Employee::find($id);

        $employees = Employee::latest()->get();
        return $employees;
    }

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
    public function update($id, array $data)
    {
        $employee = $this->find($id);
        if ($employee) {
            $employee->update($data);
        }
        return $employee;
    }

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
}
