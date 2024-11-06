<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canteen;
use App\Repositories\CanteenTransactionRepository;
use Illuminate\Support\Facades\DB;

class CanteenController extends StislaController
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
        $totalcekintoday = Canteen::whereDate('time', $today)->count();
        $totalcekouttoday = Canteen::whereDate('time', $today)->count();

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
    public function fetchData()
    {
        DB::beginTransaction();
        try {


            $PM1 = self::PintuMasukKantin1();
            $PM2 = self::PintuMasukKantin2();
            $PM3 = self::PintuMasukKantin3();
            $PK1 = self::PintuKeluarKantin1();
            $PK2 = self::PintuKeluarKantin2();

            $combinedData = array_merge($PM1, $PM2, $PM3, $PK1, $PK2);

            foreach ($combinedData as $data) {
                // Cek apakah sudah ada data dengan badgenumber dan time yang sama di database
                $existingCanteen = Canteen::where('badgenumber', $data['pin'])
                    ->where('time', $data['waktu'])
                    ->first();

                // Jika tidak ada data yang cocok, baru lakukan insert
                if (!$existingCanteen) {
                    $canteen = new Canteen;
                    $canteen->badgenumber = $data['pin'];
                    $canteen->type = $data['type'];
                    $canteen->time = $data['waktu'];

                    // Simpan perubahan ke database
                    $canteen->save();
                }
            }

            DB::commit();

            // If everything is fine, proceed with the upload logic
            $successMessage = successMessageCreate("Data");

            return redirect()->route('canteen.index')->with('successMessage', $successMessage);
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();

            return redirect()->back()->with('error', 'Mesin tidak terkoneksi!');
        }
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

    public function PintuMasukKantin1()
    {
        $Key = 0;
        if (empty($IP)) $IP = "36.91.216.217:81";
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
                'status' => $item['status'],
                'type' => 0
            ];
        }

        return $tmp;
    }

    public function PintuMasukKantin2()
    {
        $Key = 0;
        if (empty($IP)) $IP = "36.91.216.217:82";
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
                'status' => $item['status'],
                'type' => 0
            ];
        }

        return $tmp;
    }

    public function PintuMasukKantin3()
    {
        $Key = 0;
        if (empty($IP)) $IP = "36.91.216.217:83";
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
                'status' => $item['status'],
                'type' => 0
            ];
        }

        return $tmp;
    }

    public function PintuKeluarKantin1()
    {
        $Key = 0;
        if (empty($IP)) $IP = "36.91.216.217:84";
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
                'status' => $item['status'],
                'type' => 1
            ];
        }

        return $tmp;
    }

    public function PintuKeluarKantin2()
    {
        $Key = 0;
        if (empty($IP)) $IP = "36.91.216.217:85";
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
                'status' => $item['status'],
                'type' => 1
            ];
        }

        return $tmp;
    }
}
