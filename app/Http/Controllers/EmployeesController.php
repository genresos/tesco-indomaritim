<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeesRepository;

class EmployeesController extends StislaController
{
    /**
     * menu repository
     *
     * @var EmployeesRepository
     */
    private EmployeesRepository $employeesRepository;
    public function __construct()
    {
        parent::__construct();

        $this->defaultMiddleware('Show Employees');

        $this->icon           = 'fa fa-users';
        $this->viewFolder     = 'employee-management';
        $this->employeesRepository = new EmployeesRepository;
    }

    /**
     * get index data
     *
     * @return array
     */
    // protected function getIndexData()
    // {
    //     $roleOptions = $this->userRepository->getRoleOptions();
    //     $defaultData = $this->getDefaultDataIndex(__('Pengguna'), 'Pengguna', 'user-management.users');
    //     return array_merge($defaultData, [
    //         'data'      => $this->userRepository->getUsers(),
    //         'roleCount' => count($roleOptions),
    //     ]);
    // }

    public function ShowDailyWorker()
    {
        $data = $this->employeesRepository->getDailyWorker();

        $defaultData = $this->getDefaultDataIndex(__('Daily Worker'), 'Daily Worker List', 'human-capital');
        $data        = array_merge(['data' => $data], $defaultData);
        return view('stisla.human-capital.employees.daily-worker', $data);
    }

    public function ShowDailyWorkerAttendance()
    {
        $data = $this->employeesRepository->getDailyWorkerAttendance();

        $defaultData = $this->getDefaultDataIndex(__('Daily Worker Attendance'), 'Daily Worker List', 'human-capital');
        $data        = array_merge(['data' => $data], $defaultData);
        return view('stisla.human-capital.employees.daily-worker-attendance', $data);
    }
}
