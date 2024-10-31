<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeesRepository;
use App\Http\Requests\DailyWorkerRequest;
use Illuminate\Support\Facades\DB;
use App\Models\DailyWorker;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DailyWorkerAttendanceExport;
use App\Imports\CsvImport;
use DatePeriod;
use DateTime;
use DateInterval;
use Auth;
use Dompdf\Dompdf;
use Dompdf\Options;


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
     * showing add new menu page
     *
     * @return Response
     */
    public function FormUploadAttendance()
    {
        $title         = __('Upload Attendance');
        $fullTitle     = __('Upload Attendance Daily Worker');
        $defaultData   = $this->getDefaultDataCreate($title, 'employees.daily-worker');

        return view('stisla.human-capital.employees.daily-worker-attendance-form', array_merge($defaultData, [
            'fullTitle'     => $fullTitle,
        ]));
    }

    public function StoreUploadAttendance(Request $request)
    {

        if (!$request->hasFile('attendance') || !$request->file('attendance')->isValid()) {
            return redirect()->back()->with('error', 'File attendance harus diunggah dan valid!');
        }

        $file = $request->file('attendance');
        if ($file->getClientOriginalExtension() != 'csv') {
            return redirect()->route('employees.daily-worker.attendance-upload')->with('error', 'Format file tidak sesuai! Harus dalam format CSV.');
        }

        $path = $file->getRealPath();

        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
            // Skip the first row
            fgetcsv($handle);

            DB::beginTransaction();
            try {

                // Read and process the remaining rows
                while (($data = fgetcsv($handle)) !== false) {
                    DB::table('daily_worker_attendance')->updateOrInsert(
                        [
                            'badgenumber' => $data[0],
                            'checktime' => $data[1]
                        ],
                        [
                            'badgenumber' => $data[0],
                            'checktime' => $data[1],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]
                    );
                }
                fclose($handle);

                // Commit Transaction
                DB::commit();

                // If everything is fine, proceed with the upload logic
                $successMessage = successMessageCreate("Attendance");

                return redirect()->route('employees.daily-worker.attendance-upload')->with('successMessage', $successMessage);
            } catch (Exception $e) {
                // Rollback Transaction
                DB::rollback();
            }
        }
    }

    public function ExportAttendanceDailyWorker(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        // Validasi jika salah satu variabel kosong atau null
        if (empty($fromDate) || empty($toDate)) {
            return redirect()->back()->with('error', 'Pastikan tanggal benar !');
        }

        // Validasi jika fromDate lebih besar dari toDate
        if ($fromDate > $toDate) {
            return redirect()->back()->with('error', 'Pastikan tanggal benar !');
        }

        $data = DB::table('daily_worker_attendance as worker_att')
            ->join('daily_worker as worker', 'worker.badgenumber', '=', 'worker_att.badgenumber')
            ->select('worker_att.*', 'worker.name')
            ->whereBetween(DB::raw('date(worker_att.checktime)'), [$fromDate, $toDate])
            ->get();

        $result = [];

        // Grouping data by badgenumber and date
        foreach ($data as $entry) {
            $badgenumber = $entry->badgenumber; // Access property using ->
            $date = substr($entry->checktime, 0, 10); // Extract date (YYYY-MM-DD)
            $time = substr($entry->checktime, 11, 5); // Extract time (HH:MM)

            // Initialize if not already set
            if (!isset($result[$badgenumber])) {
                $result[$badgenumber] = [
                    "badgenumber" => $badgenumber . '_' . $entry->name,
                    'times' => [] // Add a times array to hold min and max
                ];
            }

            // Initialize date array if not already set
            if (!isset($result[$badgenumber]['times'][$date])) {
                $result[$badgenumber]['times'][$date] = [
                    'cek_in' => null,
                    'cek_out' => null,
                ];
            }

            // Compare times to find cek_in (before noon) and cek_out (after noon)
            if ($time < '12:00') {
                // If this time is before noon, check for cek_inimum
                if ($result[$badgenumber]['times'][$date]['cek_in'] === null || $time < $result[$badgenumber]['times'][$date]['cek_in']) {
                    $result[$badgenumber]['times'][$date]['cek_in'] = $time;
                }
            } else {
                // If this time is after noon, check for cek_outimum
                if ($result[$badgenumber]['times'][$date]['cek_out'] === null || $time > $result[$badgenumber]['times'][$date]['cek_out']) {
                    $result[$badgenumber]['times'][$date]['cek_out'] = $time;
                }
            }
        }

        // Adding dynamic dates between fromDate and toDate
        $datePeriod = new DatePeriod(
            new DateTime($fromDate),
            new DateInterval('P1D'), // 1 day interval
            new DateTime($toDate . ' +1 day') // Include end date
        );

        foreach ($datePeriod as $date) {
            $formattedDate = $date->format('Y-m-d');

            // If no data for this date, initialize with null cek_in and max
            foreach ($result as $badgenumber => $entry) {
                if (!isset($entry['times'][$formattedDate])) {
                    $result[$badgenumber]['times'][$formattedDate] = [
                        'cek_in' => null,
                        'max' => null,
                    ];
                }
            }
        }

        // Formatting the final result
        $finalResult = [];
        foreach ($result as $badgenumber => $entry) {
            $finalEntry = array_merge(["badgenumber" => $entry['badgenumber']], $entry['times']);
            $finalResult[] = $finalEntry;
        }

        // Display the result
        // return json_encode($finalResult, JSON_PRETTY_PRINT);

        return Excel::download(new DailyWorkerAttendanceExport($finalResult), 'DailyWorkerAttendanceExport.xlsx');
    }


    /**
     * showing edit worker page
     *\
     */
    public function editWorker($dailyWorker)
    {
        $data = DailyWorker::where('badgenumber', $dailyWorker)->first(); // Menggunakan first() jika hanya ingin satu record

        // Pastikan data tidak null sebelum mengirim ke view
        if (!$data) {
            // Anda dapat menangani situasi di mana data tidak ditemukan, misalnya redirect dengan pesan error
            return redirect()->back()->with('error', 'Daily worker not found.');
        }

        return view('stisla.human-capital.employees.daily-worker-edit', compact('data'));
    }

    public function updateWorker(Request $request, $dailyWorker)
    {
        // Validasi input
        $request->validate([
            'badgenumber' => 'required|integer',
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'site' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'bank_account_no' => 'required|string|max:255',
            'bank_account_name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
            'personal_loan' => 'required|numeric|min:0',
            'installment_loan' => 'required|numeric|min:0',
            'meal_allowance_perday' => 'required|numeric|min:0',
            'rapel' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'salary_type' => 'required|in:1,2,3', // Validasi untuk Payroll Type
        ]);

        // Temukan pekerja berdasarkan badgenumber
        $worker = DailyWorker::where('badgenumber', $dailyWorker)->first();

        // Jika pekerja tidak ditemukan, redirect dengan pesan error
        if (!$worker) {
            return redirect()->back()->with('error', 'Daily worker not found.');
        }

        // Update data pekerja
        $worker->badgenumber = $request->badgenumber;
        $worker->name = $request->name;
        $worker->nik = $request->nik;
        $worker->site = $request->site;
        $worker->department = $request->department;
        $worker->bank_name = $request->bank_name;
        $worker->bank_account_no = $request->bank_account_no;
        $worker->bank_account_name = $request->bank_account_name;
        $worker->rate = $request->rate;
        $worker->meal_allowance_perday = $request->meal_allowance_perday;
        $worker->personal_loan = $request->personal_loan;
        $worker->installment_loan = $request->installment_loan;
        $worker->rapel = $request->rapel;
        $worker->status = $request->status;
        $worker->salary_type = $request->salary_type;

        // Simpan perubahan ke database
        $worker->save();

        // Redirect ke halaman dengan pesan sukses

        return redirect()->route('employees.daily-worker.index')->with('successMessage', 'Daily worker updated successfully.');
    }


    /**
     * save new worker to db
     *
     * @param DailyWorkerRequest $request
     * @return Response
     */

    function nextDatePeriode($tanggalAwal, $jumlahHari)
    {
        $tanggal = new DateTime($tanggalAwal);
        $hasil = [];

        // Mengambil 7 hari ke depan
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggal->add(new DateInterval('P1D')); // Menambahkan 1 hari
            $hasil[] = $tanggal->format('Y-m-d'); // Menyimpan tanggal dalam format yang diinginkan
        }

        return $hasil;
    }

    function updatePayrollPeriode($salary_type)
    {
        $getPayrollPeriodeOpen = DB::table('daily_worker_salary_periode as sp')
            ->join('daily_worker_salary_type as st', 'sp.salary_type', '=', 'st.id')
            ->select('sp.id', 'sp.to_date', 'st.total_day')
            ->where('sp.salary_type', $salary_type)
            ->where('sp.inactive', 0)
            ->first();

        $tanggalSelanjutnya = $this->nextDatePeriode($getPayrollPeriodeOpen->to_date, $getPayrollPeriodeOpen->total_day);

        // Menampilkan hasil
        $val = [];
        foreach ($tanggalSelanjutnya as $tanggal) {
            array_push($val, $tanggal);
        }

        // Mengambil indeks pertama
        $first = $val[0];

        // Mengambil indeks terakhir
        $last = $val[count($val) - 1];

        DB::table('daily_worker_salary_periode')->where('id', $getPayrollPeriodeOpen->id)->update(
            [
                'inactive' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => Auth::user()->id
            ]
        );

        DB::table('daily_worker_salary_periode')->insert(
            [
                'from_date' => $first,
                'to_date' => $last,
                'salary_type' => $salary_type,
                'inactive' => 0,
                'created_by' => 1
            ]
        );
    }

    public function storePayrollDailyWorker(DailyWorkerRequest $request)
    {
        $getPayrollPeriodeOpen = DB::table('daily_worker_salary_periode')->where('salary_type', $request->salary_type)->where('inactive', 0)->orderBy('id', 'desc')->first();
        if ($getPayrollPeriodeOpen->to_date >= date('Y-m-d')) {
            return back()->with('errorMessage', 'Belum memasuki Periode Payroll!');
        }

        $startDate = $getPayrollPeriodeOpen->from_date;
        $endDate = $getPayrollPeriodeOpen->to_date;


        $periode = $getPayrollPeriodeOpen->id;

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
                'daily_workers.meal_allowance_perday',
                'daily_workers.personal_loan',
                'daily_workers.installment_loan',
                'daily_workers.rapel',
                'daily_worker_salary_type.type' // Ganti dengan kolom yang ingin diambil dari tabel salary_type
            )
                ->join('daily_worker_salary_type', 'daily_worker_salary_type.id', '=', 'daily_workers.salary_type')
                ->whereNotNull('daily_workers.rate')
                ->whereIn('daily_workers.site', $request->site)
                ->where('daily_worker_salary_type.id', $request->salary_type)
                ->get();

            foreach ($query as $data) {

                $total_attendance = DB::table('daily_worker_attendance')
                    ->select(
                        DB::raw('DATE(checktime) as check_date')
                    )
                    ->where('badgenumber', $data->badgenumber)
                    ->whereBetween(DB::raw('DATE(checktime)'), [$startDate, $endDate])
                    ->groupBy(DB::raw('DATE(checktime)'))
                    ->get();

                $sumLoan = DB::table('daily_worker_salary_loan')
                    ->where('badgenumber', $data->badgenumber)
                    ->sum('amount');

                $count_total_attendance = count($total_attendance);
                $income = ($data->rate * count($total_attendance));
                $rapel = $data->rapel;
                $loan = ($sumLoan >= $data->personal_loan) ? 0 : round($data->personal_loan / $data->installment_loan);
                $meal_allowance = ($data->meal_allowance_perday * 50000);

                if ($data->status == 'TK/0') {
                    $totalpendapatansetahun = 54000000;
                } elseif ($data->status == 'K0') {
                    $totalpendapatansetahun = 58500000;
                } elseif ($data->status == 'K1') {
                    $totalpendapatansetahun = 63000000;
                } elseif ($data->status == 'K2') {
                    $totalpendapatansetahun = 67500000;
                } elseif ($data->status == 'K3') {
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

                $net_income = ($gross_income - $loan - $tax) + $meal_allowance;
                $gap = $net_income - $net_income;

                $value =   [
                    'periode' => $periode,
                    'badgenumber' => $data->badgenumber,
                    'working_days' => $count_total_attendance,
                    'meal_allowance' => $meal_allowance,
                    'rapel' => $rapel,
                    'gross_income' => ($income + $rapel + $meal_allowance),
                    'income_arrears' => $rapel,
                    'loan' => $loan,
                    'tax' => $tax,
                    'net_income' => $net_income,
                    'gap' => $gap,
                    'created_by' => 1
                ];

                $uniqueCondition = [
                    'periode' => $periode,
                    'badgenumber' => $data->badgenumber
                ];

                if ($net_income > 0) {
                    DB::table('daily_worker_salary')->updateOrInsert(
                        $uniqueCondition,
                        $value
                    );
                }

                $entry = DB::table('daily_worker_salary')->where($uniqueCondition)->first();

                if ($loan > 0) {

                    $loan_value =   [
                        'badgenumber' => $data->badgenumber,
                        'amount' => $loan,
                        'salary_id' => $entry->id,
                        'updated_at' => Carbon::now()
                    ];

                    $loanUniqueCondition = [
                        'badgenumber' => $data->badgenumber,
                        'salary_id' => $entry->id
                    ];
                    DB::table('daily_worker_salary_loan')->updateOrInsert(
                        $loanUniqueCondition,
                        $loan_value
                    );
                }

                if ($request->locked) {

                    DB::table('daily_worker')->where('badgenumber', $data->badgenumber)->update(
                        [
                            'rapel' => 0,
                            'meal_allowance_perday' => 0
                        ]
                    );

                    if ($sumLoan >= $data->personal_loan)
                        DB::table('daily_worker')->where('badgenumber', $data->badgenumber)->update(
                            [
                                'personal_loan' => 0,
                                'installment_loan' => 0
                            ]
                        );
                }

                // DB::table('daily_worker_salary_loan')
                //     ->where('badgenumber', $data->badgenumber)->update(
                //         [
                //             'meal_allowance_perday' => 0
                //         ]
                //     );
            }

            if ($request->locked) {

                $this->updatePayrollPeriode($request->salary_type);
            }

            DB::commit();
            $successMessage = successMessageCreate("Calculate Payroll Daily Worker");

            // sleep(5);

            return redirect()->route('employees.daily-worker.listpayroll')->with('successMessage', $successMessage);
        } catch (Exception $exception) {
            DB::rollBack();
            return back()->with('errorMessage', $exception->getMessage());
        }
    }

    public function downloadPayslip($id)
    {
        $data = $this->employeesRepository->getPayrollListDailyWorker($id);
        $document_name = $data[0]->name;
        $htmlContent = view('stisla.human-capital.employees.daily-worker-payslip', ['data' => $data])->render();

        // Initialize Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true); // Enable remote file access
        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Stream the PDF in the browser
        return $dompdf->stream($document_name . '.pdf', ['Attachment' => true]);
    }
}
