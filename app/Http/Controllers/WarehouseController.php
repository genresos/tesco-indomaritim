<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

        $data = DB::table('warehouse_inbound')->orderBy('id', 'desc')->get();

        return view('stisla.warehouse.inbound.index', ['data' => $data]);
    }

    public function Create()
    {

        return view('stisla.warehouse.inbound.create');
    }

    public function storeInbound(Request $request)
    {

        DB::beginTransaction();
        try {

            DB::table('warehouse_inbound')->insert([
                'site' => $request->site,
                'est_date' => $request->est_date,
                'est_time' => $request->est_time,
                'vendor' => $request->vendor,
                'po_number' => $request->po_number,
                'wo_number' => $request->wo_number,
                'project_name' => $request->project_name,
                'company' => $request->company,
                'created_at' => Carbon::now(),
                'created_by' => Auth::id()
            ]);

            // Commit Transaction
            DB::commit();

            return redirect()->route('warehouse.inbound.index')->with('successMessage', 'Data added successfully.');
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }



        // Redirect ke halaman dengan pesan sukses
    }
}
