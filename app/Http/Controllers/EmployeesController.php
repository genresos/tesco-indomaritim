<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeesRepository;
use App\Http\Requests\DailyWorkerRequest;
use Illuminate\Support\Facades\DB;

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


    public function PayrollDailyWorkerList()
    {
        $data = $this->employeesRepository->getPayrollListDailyWorker();

        $defaultData = $this->getDefaultDataIndex(__('Payroll Daily Worker'), 'Payroll Daily Worker List', 'human-capital');
        $data        = array_merge(['data' => $data], $defaultData);
        return view('stisla.human-capital.employees.daily-worker-payroll', $data);
    }

    /**
     * showing add new menu page
     *
     * @return Response
     */
    public function CalculatePayrollCreate()
    {
        $title         = __('Calculate Payroll');
        $fullTitle     = __('Calculate Payroll Daily Worker');
        $defaultData   = $this->getDefaultDataCreate($title, 'employees.daily-worker');

        return view('stisla.human-capital.employees.daily-worker-form', array_merge($defaultData, [
            'fullTitle'     => $fullTitle,
        ]));
    }

    /**
     * save new group menu to db
     *
     * @param DailyWorkerRequest $request
     * @return Response
     */
    public function storePayrollDailyWorker(DailyWorkerRequest $request)
    {
        $data = $request->only([
            'from_date',
            'to_date'
        ]);

        if ($request->from_date > $request->to_date) {
            return back()->with('errorMessage', 'Tanggal tidak sesuai!');
        }

        $startDate = $request->from_date;
        $endDate = $request->to_date;

        $periode = $startDate . ' s.d ' . $endDate;
        $salaryByperiod = DB::table('daily_worker_salary')->where('periode', $periode)->count();

        if ($salaryByperiod > 0) {
            return back()->with('errorMessage', 'Payroll Periode ini sudah ada!');
        }

        DB::beginTransaction();
        try {


            $query = DB::table('daily_worker as daily_workers')->select(
                'daily_workers.badgenumber',
                'daily_workers.name',
                'daily_workers.site',
                'daily_workers.department',
                'daily_workers.status',
                'daily_workers.rate',
                'daily_workers.bank_name',
                'daily_workers.bank_account_no',
                'daily_workers.bank_account_name',
                'daily_worker_salary_type.type' // Ganti dengan kolom yang ingin diambil dari tabel salary_type
            )
                ->join('daily_worker_salary_type', 'daily_worker_salary_type.id', '=', 'daily_workers.salary_type')
                ->whereNotNull('daily_workers.rate')
                ->get();

            foreach ($query as $data) {
                $tmp = [];

                $total_attendance = DB::table('daily_worker_attendance')
                    ->select(
                        DB::raw('DATE(checktime) as check_date')
                    )
                    ->where('badgenumber', $data->badgenumber)
                    ->whereBetween(DB::raw('DATE(checktime)'), [$startDate, $endDate])
                    ->groupBy(DB::raw('DATE(checktime)'))
                    ->get();

                $count_total_attendance = count($total_attendance);
                $income = ($data->rate * count($total_attendance));
                $rapel = 0;
                $loan = 0;
                $actual_paid = 0;

                if ($data->status == 'TK/0') {
                    $totalpendapatansetahun = 54000000;
                } elseif ($data->status == 'K/0') {
                    $totalpendapatansetahun = 54000000;
                } elseif ($data->status == 'K/1') {
                    $totalpendapatansetahun = 63000000;
                } elseif ($data->status == 'K/2') {
                    $totalpendapatansetahun = 67500000;
                } elseif ($data->status == 'K/3') {
                    $totalpendapatansetahun = 72000000;
                }

                $ptkp = $totalpendapatansetahun / 12;
                $ptkp_per_week = $ptkp / 4;

                $gross_income = ($income + $rapel);
                if (($gross_income - $ptkp_per_week) < 0) {
                    $tax = 0;
                } else {
                    $tax = ($gross_income - $ptkp_per_week) * 0.05;
                }

                $net_income = ($gross_income - $loan - $tax);
                $gap = $net_income - $net_income;

                DB::table('daily_worker_salary')->insert(
                    [
                        'periode' => $periode,
                        'badgenumber' => $data->badgenumber,
                        'working_days' => $count_total_attendance,
                        'gross_income' => $income,
                        'income_arrears' => $rapel,
                        'loan' => $loan,
                        'tax' => $tax,
                        'net_income' => $net_income,
                        'gap' => $gap,
                        'created_by' => 1
                    ]
                );
            }

            DB::commit();
            // logCreate("Grup Menu", $result);

            $successMessage = successMessageCreate("Calculate Payroll Daily Worker");

            return redirect()->route('employees.daily-worker.listpayroll')->with('successMessage', $successMessage);
        } catch (Exception $exception) {
            DB::rollBack();
            return back()->with('errorMessage', $exception->getMessage());
        }
    }
}
