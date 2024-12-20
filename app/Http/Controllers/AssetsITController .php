<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetsIT;
use App\Repositories\CanteenTransactionRepository;
use Illuminate\Support\Facades\DB;

class AssetsITController extends StislaController
{
    /**
     * menu repository
     *
     * @var CanteenTransactionRepository
     */

    private CanteenTransactionRepository $canteenRepository;

    public function __construct()
    {
        parent::__construct();

        $this->defaultMiddleware('Canteen Transaction');

        $this->icon           = 'fa fa-pizza-slice';
        $this->viewFolder     = 'canteen-transaction';
        $this->canteenRepository = new CanteenTransactionRepository;
    }

    public function index()
    {
        $data = $this->canteenRepository->getAll();
        $today = date('Y-m-d');
        $totalcekintoday = Canteen::whereDate('time', $today)->where('type', 0)->count();
        $totalcekouttoday = Canteen::whereDate('time', $today)->where('type', 1)->count();

        // Jika null, set ke 0
        $totalcekintoday = $totalcekintoday ?? 0;
        $totalcekouttoday = $totalcekouttoday ?? 0;

        // return $data;
        $defaultData = $this->getDefaultDataIndex(__('Transaction Canteen'), 'Canteen Transaction History', 'human-capital');
        // return $data;
        $defaultData = $this->getDefaultDataIndex(__('Transaction Canteen'), 'Canteen Transaction History', 'human-capital');
        $data = array_merge([
            'data' => $data,
            'totalcekintoday' => $totalcekintoday,    // Menambahkan totalcekintoday ke dalam array data
            'totalcekouttoday' => $totalcekouttoday   // Menambahkan totalcekouttoday ke dalam array data
        ], $defaultData);

        return view('stisla.human-capital.canteen.index', $data);
    }
}
