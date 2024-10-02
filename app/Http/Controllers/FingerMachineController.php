<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Repositories\FingerMachineRepository;


class FingerMachineController extends StislaController
{
    /**
     * menu repository
     *
     * @var FingerMachineRepository
     */
    private FingerMachineRepository $fingermachineRepository;

    public function __construct()
    {
        parent::__construct();

        $this->defaultMiddleware('Finger Machine');

        $this->icon           = 'fa fa-fingerprint';
        $this->viewFolder = 'human-capital.finger-machine';
        $this->fingermachineRepository = new FingerMachineRepository;
    }

    /**
     * get index data
     *
     * @return array
     */
    protected function getIndexData()
    {
        $data = $this->fingermachineRepository->getMachineData();
        $defaultData = $this->getDefaultDataIndex(__('Finger Machine'), 'Finger Machine', 'human-capital');
        $data        = array_merge(['data' => $data], $defaultData);
        return $data;
    }

    public function index()
    {
        $data = $this->getIndexData();
        // return $data;
        return view('stisla.human-capital.finger-machine.index',$data);
    }

    public function getAllTransactionData()
    {
        $data = $this->fingermachineRepository->getAllTransaction();

        $defaultData = $this->getDefaultDataIndex(__('All Machine Transactions'), 'All Transaction Machine', 'human-capital');
        $data        = array_merge(['data' => $data], $defaultData);
        return view('stisla.human-capital.finger-machine.all-transaction',$data);
    }


    public function transactionFingerMachine($SN)
    {
        $data = $this->fingermachineRepository->getMachineTransaction($SN);

        return view('stisla.human-capital.finger-machine.detail-table', [
            'data' => $data,
            'title' => 'Datatable' // atau sesuai dengan judul yang Anda inginkan
        ]);
    }

   
}
