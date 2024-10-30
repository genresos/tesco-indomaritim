<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Carbon\Carbon;

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

    public function index(Request $request)
    {
        $data = $this->getIndexData();
        return view('stisla.human-capital.finger-machine.index', $data);
    }

    function Parse_Data($data, $p1, $p2)
    {
        $data = " " . $data;
        $hasil = "";
        $awal = strpos($data, $p1);
        if ($awal != "") {
            $akhir = strpos(strstr($data, $p1), $p2);
            if ($akhir != "") {
                $hasil = substr($data, $awal + strlen($p1), $akhir - strlen($p1));
            }
        }
        return $hasil;
    }

    public function fetchAttendanceDaily()
    {
        $Key = 0;
        if (empty($IP)) $IP = "192.168.99.77";
        if (empty($Key)) $Key = "0";


        $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
        if ($Connect) {
            $soap_request = "<GetAttLog>
            <ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey>
            <Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
            </GetAttLog>";

            $newLine = "\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
            fputs($Connect, "Content-Type: text/xml" . $newLine);
            fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
            fputs($Connect, $soap_request . $newLine);
            $buffer = "";
            while ($Response = fgets($Connect, 1024)) {
                $buffer = $buffer . $Response;
            }
        } else echo "Koneksi Gagal";

        $buffer = $this->Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $buffer = explode("\r\n", $buffer);

        for ($a = 0; $a < count($buffer); $a++) {
            $data = $this->Parse_Data($buffer[$a], "<Row>", "</Row>");

            if ($this->Parse_Data($data, "<PIN>", "</PIN>") != "") {
                $export[$a]['pin'] = $this->Parse_Data($data, "<PIN>", "</PIN>");
                $export[$a]['waktu'] = $this->Parse_Data($data, "<DateTime>", "</DateTime>");
                $export[$a]['status'] = $this->Parse_Data($data, "<Status>", "</Status>");
            }
        }

        foreach ($export as $item) {
            $tmp[] = [
                'pin' => $item['pin'],
                'waktu' => $item['waktu'],
                'status' => $item['status']
            ];
        }
        DB::beginTransaction();
        try {

            foreach ($tmp as $data) {

                DB::table('daily_worker_attendance')->updateOrInsert(
                    [
                        'badgenumber' => $data['pin'],
                        'checktime' => $data['waktu']
                    ],
                    [
                        'badgenumber' => $data['pin'],
                        'checktime' => $data['waktu'],
                        'updated_at' => Carbon::now()
                    ]
                );
            }

            // Commit Transaction
            DB::commit();

            return response()->json([
                'success' => true
            ]);
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }

        // $dataKaryawan = json_decode($jsonData, true)['datakaryawan'];

        // // Menyimpan data ke database
        // foreach ($dataKaryawan as $karyawan) {
        //     DB::table('daily_worker')->updateOrInsert(
        //         ['badgenumber' => $karyawan['ID']],
        //         [
        //             'name' => $karyawan['Nama'],
        //             'site' => 'TLD'
        //         ]
        //     );
        // }

        // return 'ok';
    }

    public function getAllTransactionData()
    {
        $data = $this->fingermachineRepository->getAllTransaction();

        $defaultData = $this->getDefaultDataIndex(__('All Machine Transactions'), 'All Transaction Machine', 'human-capital');
        $data        = array_merge(['data' => $data], $defaultData);
        return view('stisla.human-capital.finger-machine.all-transaction', $data);
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
