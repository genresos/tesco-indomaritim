<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends StislaController
{
    public function __construct()
    {
        parent::__construct();

        $this->defaultMiddleware('Show Employees');

        $this->icon           = 'fa fa-users';
        $this->viewFolder     = 'employee-management';
    }

    /**
     * get index data
     *
     * @return array
     */
    protected function getIndexData()
    {
        $roleOptions = $this->userRepository->getRoleOptions();
        $defaultData = $this->getDefaultDataIndex(__('Pengguna'), 'Pengguna', 'user-management.users');
        return array_merge($defaultData, [
            'data'      => $this->userRepository->getUsers(),
            'roleCount' => count($roleOptions),
        ]);
    }
}
