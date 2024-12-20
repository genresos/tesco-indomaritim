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

    public function CreateInbound()
    {

        return view('stisla.warehouse.inbound.create');
    }

    public function EditInbound($id)
    {

        return view('stisla.warehouse.inbound.edit', compact('id'));
    }

    public function StoreInbound(Request $request)
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

            return redirect()->route('warehouse.inbound.create')->with('successMessage', 'Data added successfully.');
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }
    }

    public function UpdateInbound(Request $request, $id)
    {

        DB::beginTransaction();
        try {

            DB::table('warehouse_inbound')
                ->where('id', $request->id)  // Pastikan Anda menggunakan kondisi yang benar, seperti ID yang unik
                ->update([
                    'status' => $request->status,
                    'updated_at' => Carbon::now(),
                    'arrival_date' => ($request->status == 'Delivered') ? now()->format('Y-m-d') : null,
                    'arrival_time' => ($request->status == 'Delivered') ? now()->format('H:i:s') : null,
                    'updated_by' => Auth::id()  // Pastikan ada kolom untuk menyimpan siapa yang melakukan update
                ]);

            // Commit Transaction
            DB::commit();

            return redirect()->route('dashboard.index')->with('successMessage', 'Data update successfully.');
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }
    }
}
