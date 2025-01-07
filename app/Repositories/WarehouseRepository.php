<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\DailyWorkerAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Collection;


class WarehouseRepository extends Repository
{

    public function getListData()
    {

        $query = DB::table('warehouse_inbound as wi')
            ->leftJoin('users as creator', 'creator.id', '=', 'wi.created_by')
            ->leftJoin('users as updater', 'updater.id', '=', 'wi.updated_by')
            ->select('wi.*', 'creator.name as creator', 'updater.name as updater')
            ->orderByRaw("CASE WHEN wi.status = 'New' THEN 0 ELSE 1 END")
            ->orderByDesc('wi.id')
            ->get();



        return $query;
    }
}
