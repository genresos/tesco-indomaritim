<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canteen;
// use App\Repositories\CanteenTransactionRepository;
use Illuminate\Support\Facades\DB;

class WarehouseController extends StislaController
{


    public function __construct()
    {
        // parent::__construct();

        // $this->defaultMiddleware('Canteen Transaction');

        // $this->icon           = 'fa fa-pizza-slice';
        // $this->viewFolder     = 'canteen-transaction';
        // $this->canteenRepository = new CanteenTransactionRepository;
    }

    public function inboundIndex()
    {

        $data = DB::table('warehouse_inbound')->get();

        return view('stisla.warehouse.inbound.index', ['data' => $data]);
    }
}
