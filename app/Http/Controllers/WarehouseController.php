<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\WarehouseRepository;

class WarehouseController extends StislaController
{

    /**
     * menu repository
     *
     * @var WarehouseRepository
     */
    private WarehouseRepository $warehouseRepository;
    public function __construct()
    {
        parent::__construct();

        $this->defaultMiddleware('Warehouse Inbound Create');

        $this->icon           = 'fas fa-archive';
        $this->viewFolder     = 'employee-management';
        $this->warehouseRepository = new WarehouseRepository;
    }

    public function inboundIndex()
    {

        $data = DB::table('warehouse_inbound as wi')
            ->leftJoin('users as creator', 'creator.id', '=', 'wi.created_by')
            ->leftJoin('users as updater', 'updater.id', '=', 'wi.updated_by')
            ->select('wi.*', 'creator.name as creator', 'updater.name as updater')
            ->where(function ($query) {
                $query->whereDate('wi.est_date', '=', now()->toDateString())
                    ->orWhere('wi.status', '=', 'New');
            })
            ->orderByRaw("CASE WHEN wi.status = 'New' THEN 0 ELSE 1 END")
            ->orderByDesc('wi.id')
            ->get();

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
        $item = DB::table('warehouse_inbound')->where('id', $id)->first();
        /* validasi jika barang diterima sudah lewat hari status jadi Received Late */
        if ($request->status == 'Received' && $item->est_date < date('Y-m-d')) {
            $status = 'Received Late';
        } else {
            $status = $request->status;
        }
        if ($item->updated_at != null) {
            session()->flash('error', 'Data ini sudah diupdate.');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {

            DB::table('warehouse_inbound')
                ->where('id', $request->id)  // Pastikan Anda menggunakan kondisi yang benar, seperti ID yang unik
                ->update([
                    'status' => $status,
                    'updated_at' => Carbon::now(),
                    'arrival_date' => ($request->status == 'Received') ? now()->format('Y-m-d') : null,
                    'arrival_time' => ($request->status == 'Received') ? now()->format('H:i:s') : null,
                    'updated_by' => Auth::id()  // Pastikan ada kolom untuk menyimpan siapa yang melakukan update
                ]);

            // Commit Transaction
            DB::commit();

            return redirect()->route('warehouse.inbound.index')->with('successMessage', 'Data update successfully.');
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }
    }

    public function inboundList()
    {

        $data = $this->warehouseRepository->getListData();

        $defaultData = $this->getDefaultDataIndex(__('List Warehouse Inbound'), 'Warehouse Inbound', '');
        $data        = array_merge(['data' => $data], $defaultData);

        return view('stisla.warehouse.inbound.list', $data);
    }
}
