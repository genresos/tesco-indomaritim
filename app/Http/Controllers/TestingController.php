<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestingController extends Controller
{
    public function datatable()
    {
        return view('testing.datatable');
    }

    public function sendEmail()
    {
        (new EmailService)->testing('hairulanam21@gmail.com', Str::random(20));
    }

    public function modal()
    {
        return view('testing.modal');
    }

    public function test()
    {
        $jsonData = '{
            "data": [
                {
      "name": "HERMAWAN",
      "pin": "307",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054327504",
      "bank_account": "HERMAWAN",
      "daily_rate": 150000
     },
     {
      "name": "MUHAMAR",
      "pin": "313",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054309506",
      "bank_account": "MUHAMAR",
      "daily_rate": 150000
     },
     {
      "name": "RICKY ADI SAPUTRO",
      "pin": "318",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "019001020577533",
      "bank_account": "RICKY ADI SAPUTRO",
      "daily_rate": 150000
     },
     {
      "name": "ROJALIH",
      "pin": "319",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054300502",
      "bank_account": "ROJALIH",
      "daily_rate": 150000
     },
     {
      "name": "ROSAD",
      "pin": "320",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054382504",
      "bank_account": "ROSAD",
      "daily_rate": 150000
     },
     {
      "name": "DIMAS PANGESTU",
      "pin": "334",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054304506",
      "bank_account": "DIMAS PANGESTU",
      "daily_rate": 150000
     },
     {
      "name": "ROSAD",
      "pin": "340",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054398505",
      "bank_account": "ROSAD",
      "daily_rate": 150000
     },
     {
      "name": "WENDY BAYU FAHREZA ",
      "pin": "343",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054336503",
      "bank_account": "WENDI BAYU PAHREZA",
      "daily_rate": 150000
     },
     {
      "name": "YOGO",
      "pin": "344",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054301508",
      "bank_account": "YOGO",
      "daily_rate": 150000
     },
     {
      "name": "ARIPIN",
      "pin": "379",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054380502",
      "bank_account": "ARIPIN",
      "daily_rate": 150000
     },
     {
      "name": "MARTONO ",
      "pin": "387",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054377509",
      "bank_account": "MARTONO",
      "daily_rate": 150000
     },
     {
      "name": "MULYADI",
      "pin": "389",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054306508",
      "bank_account": "MULYADI",
      "daily_rate": 150000
     },
     {
      "name": "SAIFUL BAHRI ",
      "pin": "396",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054326508",
      "bank_account": "SAIFUL BAHRI",
      "daily_rate": 150000
     },
     {
      "name": "TOMI ",
      "pin": "398",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054325502",
      "bank_account": "TOMI",
      "daily_rate": 150000
     },
     {
      "name": "EDIH MAHMUDIH",
      "pin": "399",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 150000
     },
     {
      "name": "DIKY WAHYUDI",
      "pin": "405",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 150000
     },
     {
      "name": "RENDI IBRAHIM",
      "pin": "414",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054379501",
      "bank_account": "RENDI IBRAHIM",
      "daily_rate": 150000
     },
     {
      "name": "SANUN",
      "pin": "419",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 150000
     },
     {
      "name": "USMAN EFENDI",
      "pin": "423",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054302504",
      "bank_account": "USMAN EFENDI",
      "daily_rate": 150000
     },
     {
      "name": "HARI SANTOSO",
      "pin": "455",
      "site": "TM5",
      "departemen": "TM5 - FRP",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054381508",
      "bank_account": "HARI SANTOSO",
      "daily_rate": 150000
     },
     {
      "name": "AKEW",
      "pin": "130",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054346508",
      "bank_account": "OPIK",
      "daily_rate": 140000
     },
     {
      "name": "DIMAS SITO SAPUTRA",
      "pin": "1457",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054397509",
      "bank_account": "DIMAS SITO SAPUTRA",
      "daily_rate": 110000
     },
     {
      "name": "KHOERUDIN",
      "pin": "1458",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054337509",
      "bank_account": "KHOERUDIN",
      "daily_rate": 110000
     },
     {
      "name": "MUHAMAD ILHAM",
      "pin": "1459",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054338505",
      "bank_account": "MUHAMAD ILHAM",
      "daily_rate": 110000
     },
     {
      "name": "ANWAR B",
      "pin": "160",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "135501007176537",
      "bank_account": "ANWAR",
      "daily_rate": 140000
     },
     {
      "name": "BASIR",
      "pin": "24",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "774401003536538",
      "bank_account": "BASIR",
      "daily_rate": 140000
     },
     {
      "name": "ENGKAM",
      "pin": "3",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054345502",
      "bank_account": "KAMHARI",
      "daily_rate": 140000
     },
     {
      "name": "AAN ROHMAN",
      "pin": "325",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054342504",
      "bank_account": "AAN ROHANA",
      "daily_rate": 140000
     },
     {
      "name": "SOLEH",
      "pin": "327",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054296509",
      "bank_account": "SOLEH",
      "daily_rate": 140000
     },
     {
      "name": "AHMAD AZHARI",
      "pin": "371",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "204601012117506",
      "bank_account": "AHMAD AZHARI",
      "daily_rate": 150000
     },
     {
      "name": "BUHORI",
      "pin": "43",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "411601021018530",
      "bank_account": "BUKHORI",
      "daily_rate": 140000
     },
     {
      "name": "TATA",
      "pin": "56",
      "site": "TM5",
      "departemen": "TM5 - KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "411601027350532",
      "bank_account": "TATA PERMANA",
      "daily_rate": 140000
     },
     {
      "name": "SUBUR",
      "pin": "1460",
      "site": "TM5",
      "departemen": "TM5 - PERKEBUNAN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054313505",
      "bank_account": "SUBUR",
      "daily_rate": 110000
     },
     {
      "name": "SUPANDI",
      "pin": "2323",
      "site": "TM5",
      "departemen": "TM5 - PERKEBUNAN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "204601011968506",
      "bank_account": "SUPANDI",
      "daily_rate": 100000
     },
     {
      "name": "ALPIAN TARA",
      "pin": "445",
      "site": "TM5",
      "departemen": "TM5 - PERKEBUNAN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "204601011838507",
      "bank_account": "ALPIAN TARA",
      "daily_rate": 110000
     },
     {
      "name": "MURSIN",
      "pin": "447",
      "site": "TM5",
      "departemen": "TM5 - PERKEBUNAN",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054340502",
      "bank_account": "MURSIN",
      "daily_rate": 110000
     },
     {
      "name": "ENDANG",
      "pin": "450",
      "site": "TM5",
      "departemen": "TM5 - PERKEBUNAN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 110000
     },
     {
      "name": "SULAIMAN",
      "pin": "119",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 170000
     },
     {
      "name": "ASEP AAN",
      "pin": "128",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 190000
     },
     {
      "name": "M ADE",
      "pin": "150",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 175000
     },
     {
      "name": "MUSA",
      "pin": "2257",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054385502",
      "bank_account": "MUSA",
      "daily_rate": 275000
     },
     {
      "name": "ARIP HIDAYATULOH",
      "pin": "239",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054343500",
      "bank_account": "ADE SETIADI",
      "daily_rate": 175000
     },
     {
      "name": "YUDI SOLEHUDIN",
      "pin": "240",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054399501",
      "bank_account": "YUDI SOLEHUDIN",
      "daily_rate": 170000
     },
     {
      "name": "MISRIADI",
      "pin": "294",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 180000
     },
     {
      "name": "MIAN",
      "pin": "38",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101031875533",
      "bank_account": "YUSUF JAMIAN",
      "daily_rate": 180000
     },
     {
      "name": "PIAT",
      "pin": "40",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "367101018382501",
      "bank_account": "ASEP AAN",
      "daily_rate": 170000
     },
     {
      "name": "ABI YUSUF",
      "pin": "428",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "204601012111500",
      "bank_account": "ABI YUSUF",
      "daily_rate": 170000
     },
     {
      "name": "HENDAR TASIK",
      "pin": "434",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054400506",
      "bank_account": "HENDAR",
      "daily_rate": 170000
     },
     {
      "name": "SULAEMAN",
      "pin": "71",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054341508",
      "bank_account": "SULAEMAN",
      "daily_rate": 170000
     },
     {
      "name": "SAKUR",
      "pin": "86",
      "site": "TM5",
      "departemen": "TM5 - TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054311503",
      "bank_account": "IMAN MASKURI",
      "daily_rate": 195000
     },
     {
      "name": "NACIH",
      "pin": "100",
      "site": "TM5",
      "departemen": "TM5 - KANTIN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054329506",
      "bank_account": "NACIH",
      "daily_rate": 100000
     },
     {
      "name": "WINAH",
      "pin": "106",
      "site": "TM5",
      "departemen": "TM5 - KANTIN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054393505",
      "bank_account": "WINAH",
      "daily_rate": 100000
     },
     {
      "name": "NASUHA",
      "pin": "107",
      "site": "TM5",
      "departemen": "TM5 - KANTIN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054392509",
      "bank_account": "NASUHA",
      "daily_rate": 100000
     },
     {
      "name": "SUHENI",
      "pin": "97",
      "site": "TM5",
      "departemen": "TM5 - KANTIN",
      "status": "TK\/0",
      "bank_name": "",
      "bank_no": "0",
      "bank_account": "",
      "daily_rate": 120000
     },
     {
      "name": "LISAH",
      "pin": "98",
      "site": "TM5",
      "departemen": "TM5 - KANTIN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054324506",
      "bank_account": "LISAH",
      "daily_rate": 100000
     },
     {
      "name": "NARSIH",
      "pin": "99",
      "site": "TM5",
      "departemen": "TM5 - KANTIN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054328500",
      "bank_account": "NARSIH",
      "daily_rate": 100000
     },
     {
      "name": "HENDRIK",
      "pin": "108",
      "site": "TM5",
      "departemen": "TM5 - PERKEBUNAN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054339501",
      "bank_account": "HENDRIK",
      "daily_rate": 110000
     },
     {
      "name": "UJANG KUSMAWAN",
      "pin": "109",
      "site": "TM5",
      "departemen": "TM5 - PERKEBUNAN",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054396503",
      "bank_account": "UJANG KUSMAWAN",
      "daily_rate": 110000
     },
     {
      "name": "WAHBUDIN",
      "pin": "1470",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "K0",
      "bank_name": "BRI",
      "bank_no": "037801054290503",
      "bank_account": "WAHBUDIN ",
      "daily_rate": 150000
     },
     {
      "name": "BUDI RAHMAT",
      "pin": "2302",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "662801020339530",
      "bank_account": "SETIOUTOMO",
      "daily_rate": 160000
     },
     {
      "name": "M YUSUP PADILAH",
      "pin": "354",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054287500",
      "bank_account": "M YUSUP PADILAH",
      "daily_rate": 160000
     },
     {
      "name": "SANDI SUNANJA",
      "pin": "469",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "662801020339530",
      "bank_account": "SETIOUTOMO",
      "daily_rate": 150000
     },
     {
      "name": "SURYANA RIDWAN",
      "pin": "323",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054363500",
      "bank_account": "SURYANA RAWIN",
      "daily_rate": 160000
     },
     {
      "name": "JAMALUDIN AKBAR",
      "pin": "370",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "411601024512509",
      "bank_account": "JAMALUDIN AKBAR ",
      "daily_rate": 150000
     },
     {
      "name": "YANDI SUWANDI",
      "pin": "457",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054368500",
      "bank_account": "YANDI SUWANDI",
      "daily_rate": 150000
     },
     {
      "name": "DIAN ELGI LESMANA",
      "pin": "473",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054362504",
      "bank_account": "DIAN ELGI LESMANA",
      "daily_rate": 150000
     },
     {
      "name": "WAHYU ABADI",
      "pin": "483",
      "site": "TM7",
      "departemen": "OP DRAGGER SEMENTARA",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054364506",
      "bank_account": "WAHYU ABADI",
      "daily_rate": 140000
     },
     {
      "name": "SAMSUL HIDAYAT",
      "pin": "1468",
      "site": "TM7",
      "departemen": "TM7-KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "662801020339530",
      "bank_account": "SETIOUTOMO",
      "daily_rate": 140000
     },
     {
      "name": "CEPI UMBARA",
      "pin": "2341",
      "site": "TM7",
      "departemen": "TM7-KENEK",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "774401011478538",
      "bank_account": "CEPI UMBARA ",
      "daily_rate": 130000
     },
     {
      "name": "ILHAM RENALDI",
      "pin": "465",
      "site": "TM7",
      "departemen": "TM7-KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054284502",
      "bank_account": "ILHAM RENALDI",
      "daily_rate": 140000
     },
     {
      "name": "ASEP SUHERMAN",
      "pin": "474",
      "site": "TM7",
      "departemen": "TM7-KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054355507",
      "bank_account": "ASEP SUHERMAN",
      "daily_rate": 110000
     },
     {
      "name": "RIZAL FAUZI",
      "pin": "2358",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054372509",
      "bank_account": "RIZAL FAUZI",
      "daily_rate": 100000
     },
     {
      "name": "BAMBANG",
      "pin": "2359",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "204601012096506",
      "bank_account": "BAMBANG",
      "daily_rate": 100000
     },
     {
      "name": "CAHYONO",
      "pin": "2360",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054292505",
      "bank_account": "CAHYONO",
      "daily_rate": 100000
     },
     {
      "name": "BAGAS TIANO",
      "pin": "2361",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054371503",
      "bank_account": "BAGAS TIANOA ADINDA SULUNG",
      "daily_rate": 100000
     },
     {
      "name": "DIPARYO PERMANA",
      "pin": "475",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "420601013407538",
      "bank_account": "DIPARYO PERMANA ",
      "daily_rate": 110000
     },
     {
      "name": "IRHAM MUBAROK",
      "pin": "477",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054293501",
      "bank_account": "IRHAM MUBAROK",
      "daily_rate": 110000
     },
     {
      "name": "NURUL IMAN",
      "pin": "478",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "662801020339530",
      "bank_account": "SETIOUTOMO",
      "daily_rate": 110000
     },
     {
      "name": "TAUFIK HIDAYAT",
      "pin": "481",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054291509",
      "bank_account": "TAUFIK HIDAYAT",
      "daily_rate": 110000
     },
     {
      "name": "WANDA",
      "pin": "482",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "420601019796539",
      "bank_account": "WANDA ",
      "daily_rate": 110000
     },
     {
      "name": "SUSANTO",
      "pin": "479",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054294507",
      "bank_account": "SUSANTO",
      "daily_rate": 110000
     },
     {
      "name": "TARJUKI",
      "pin": "480",
      "site": "TM7",
      "departemen": "TM7-LOKAL",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054356503",
      "bank_account": "TARJUKI",
      "daily_rate": 110000
     },
     {
      "name": "SETIO UTOMO",
      "pin": "136",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "662801020339530",
      "bank_account": "SETIOUTOMO",
      "daily_rate": 195000
     },
     {
      "name": "ANO",
      "pin": "145",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054370507",
      "bank_account": "ANO",
      "daily_rate": 170000
     },
     {
      "name": "RASTONO",
      "pin": "1461",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054373505",
      "bank_account": "RASTONO",
      "daily_rate": 160000
     },
     {
      "name": "YUDI MARDIANTO",
      "pin": "1465\n",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054399501",
      "bank_account": "YUDI SOLEHUDIN",
      "daily_rate": 165000
     },
     {
      "name": "AAN TUKANG",
      "pin": "179",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054358505",
      "bank_account": "AAN",
      "daily_rate": 170000
     },
     {
      "name": "WALIMIN AHMAD ADWIJAYANT",
      "pin": "222",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054285508",
      "bank_account": "WALIMIN AHMAD ADWIJAYANTO",
      "daily_rate": 170000
     },
     {
      "name": "DEPI SAPUTRA",
      "pin": "2309",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054359501",
      "bank_account": "DEPI SAPUTRA",
      "daily_rate": 165000
     },
     {
      "name": "WAHYUDIN",
      "pin": "2344",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054384506",
      "bank_account": "WAHYUDIN",
      "daily_rate": 160000
     },
     {
      "name": "MOH. AGUS SUPRIATNA",
      "pin": "2350",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054286504",
      "bank_account": "MOH AGUS SUPRIATNA",
      "daily_rate": 160000
     },
     {
      "name": "MOH. LUTFI",
      "pin": "2357",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "TK\/0",
      "bank_name": "Mandiri",
      "bank_no": "1390023444460",
      "bank_account": "MOHAMMAD LUTFI",
      "daily_rate": 160000
     },
     {
      "name": "ACEP ISMAIL",
      "pin": "293",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054365502",
      "bank_account": "ACEP ISMAIL",
      "daily_rate": 170000
     },
     {
      "name": "ABDUL FATILAH",
      "pin": "460",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054289502",
      "bank_account": "ABDUL FATILAH",
      "daily_rate": 170000
     },
     {
      "name": "ASEP SODIKIN",
      "pin": "462",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054360502",
      "bank_account": "ASEP SODIKIN",
      "daily_rate": 170000
     },
     {
      "name": "ABDUL ROHMAN",
      "pin": "463",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054288506",
      "bank_account": "ABDUL ROHMAN",
      "daily_rate": 170000
     },
     {
      "name": "DADANG PURNAMA",
      "pin": "464",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "067101025619508",
      "bank_account": "DADANG PURNAMA ",
      "daily_rate": 170000
     },
     {
      "name": "WARNATA",
      "pin": "484",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "420601013793531",
      "bank_account": "WARNATA BIN TOHIR",
      "daily_rate": 160000
     },
     {
      "name": "EPET SAMSUDIN",
      "pin": "90",
      "site": "TM7",
      "departemen": "TM7-TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054361508",
      "bank_account": "SAMSUDIN",
      "daily_rate": 175000
     },
     {
      "name": "ANDI",
      "pin": "121",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054352509",
      "bank_account": "ANDI",
      "daily_rate": 140000
     },
     {
      "name": "SISWANTO",
      "pin": "228",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "K0",
      "bank_name": "BRI",
      "bank_no": "037801054348500",
      "bank_account": "SISWANTO",
      "daily_rate": 140000
     },
     {
      "name": "MARWAN MAULANA",
      "pin": "2293",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054282500",
      "bank_account": "MARWAN MAULANA",
      "daily_rate": 140000
     },
     {
      "name": "KURNIAWAN",
      "pin": "2342",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054333505",
      "bank_account": "KURNIAWAN",
      "daily_rate": 130000
     },
     {
      "name": "SUPRIYADI",
      "pin": "2343",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054395507",
      "bank_account": "SUPRIYADI",
      "daily_rate": 130000
     },
     {
      "name": "M. LUTFI ADITYA",
      "pin": "2349",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054280508",
      "bank_account": "M.LUTFI ADITYA",
      "daily_rate": 130000
     },
     {
      "name": "ANDIANSYAH",
      "pin": "289",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "345501047611531",
      "bank_account": "ANDIANSYAH",
      "daily_rate": 130000
     },
     {
      "name": "JIMI",
      "pin": "366",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054354501",
      "bank_account": "JIMI",
      "daily_rate": 175000
     },
     {
      "name": "ASEP PENDI",
      "pin": "368",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054310507",
      "bank_account": "ASEP DENDI",
      "daily_rate": 140000
     },
     {
      "name": "MUHAMAD PURWANTO",
      "pin": "372",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054332509",
      "bank_account": "MUHAMMAD PURWANTO",
      "daily_rate": 170000
     },
     {
      "name": "GISFA AZIZ",
      "pin": "374",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 140000
     },
     {
      "name": "ABDURAHMAN SAEFUL",
      "pin": "426",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054330507",
      "bank_account": "ABDURAHMAN SAEFUL ANWAR",
      "daily_rate": 140000
     },
     {
      "name": "YUNUS",
      "pin": "435",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 140000
     },
     {
      "name": "JAENUDIN",
      "pin": "436",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "412201014966503",
      "bank_account": "JAENUDIN",
      "daily_rate": 140000
     },
     {
      "name": "MUHAMMAD ZIHAD PATUR",
      "pin": "437",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "010001114471503",
      "bank_account": "MUHAMMAD ZIHAD PATUR",
      "daily_rate": 140000
     },
     {
      "name": "JULI",
      "pin": "44",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "K0",
      "bank_name": "BRI",
      "bank_no": "037801054283506",
      "bank_account": "JULIAWAN",
      "daily_rate": 140000
     },
     {
      "name": "TAUFIK AZI PERNAMA",
      "pin": "466",
      "site": "TLD",
      "departemen": "TLD KENEK",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054344506",
      "bank_account": "TAUFIK AZI PRATAMA",
      "daily_rate": 140000
     },
     {
      "name": "ALI CARTI",
      "pin": "11",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054353505",
      "bank_account": "HAERUDIN",
      "daily_rate": 260000
     },
     {
      "name": "HERMAN",
      "pin": "13",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054312509",
      "bank_account": "SUHERMAN",
      "daily_rate": 170000
     },
     {
      "name": "SUPRIATNA",
      "pin": "156",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "441601039946501",
      "bank_account": "SUPRIYADI",
      "daily_rate": 180000
     },
     {
      "name": "UDIN",
      "pin": "17",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054334501",
      "bank_account": "DIDI SAMSUDIN",
      "daily_rate": 185000
     },
     {
      "name": "SATIBI",
      "pin": "206",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054307504",
      "bank_account": "ENTIB",
      "daily_rate": 170000
     },
     {
      "name": "ADIN",
      "pin": "2345",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054349506",
      "bank_account": "ADIN",
      "daily_rate": 160000
     },
     {
      "name": "DEDE ROSADILAH",
      "pin": "2346",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054335507",
      "bank_account": "DEDE ROSADILAH",
      "daily_rate": 160000
     },
     {
      "name": "H. HOERUDIN",
      "pin": "2347",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054279507",
      "bank_account": "H.HOERUDIN",
      "daily_rate": 160000
     },
     {
      "name": "M ENJANG",
      "pin": "242",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 175000
     },
     {
      "name": "WAHYUDIN",
      "pin": "256",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 170000
     },
     {
      "name": "SUHENDAR RESI",
      "pin": "296",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K2",
      "bank_name": "BRI",
      "bank_no": "037801054351503",
      "bank_account": "SUHENDAR RESI",
      "daily_rate": 180000
     },
     {
      "name": "RIZAL",
      "pin": "328",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054350507",
      "bank_account": "RIZAL",
      "daily_rate": 180000
     },
     {
      "name": "AHMAD",
      "pin": "329",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 175000
     },
     {
      "name": "KAMALUDIN",
      "pin": "351",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 180000
     },
     {
      "name": "ABDUL ROJAK",
      "pin": "358",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K3",
      "bank_name": "BRI",
      "bank_no": "037801054401502",
      "bank_account": "ABDUL ROJAK",
      "daily_rate": 180000
     },
     {
      "name": "MUHAMAD PAJAR",
      "pin": "362",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054331503",
      "bank_account": "MUHAMMAD FAJAR",
      "daily_rate": 165000
     },
     {
      "name": "DEDEN ASEP YAMAN",
      "pin": "39",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K0",
      "bank_name": "BRI",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 195000
     },
     {
      "name": "BADRU",
      "pin": "41",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 180000
     },
     {
      "name": "NANA SUBANG",
      "pin": "432",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BRI",
      "bank_no": "037801054402508",
      "bank_account": "NANA B IMAN",
      "daily_rate": 170000
     },
     {
      "name": "ALGI EGA PERMANA",
      "pin": "440",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054281504",
      "bank_account": "ALGI EGA PERMANA",
      "daily_rate": 180000
     },
     {
      "name": "ANDRI",
      "pin": "49",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "TK\/0",
      "bank_name": "BCA",
      "bank_no": "2801852001",
      "bank_account": "ASEP YAMAN",
      "daily_rate": 180000
     },
     {
      "name": "HERU BAYONG SAPRUDIN",
      "pin": "93",
      "site": "TLD",
      "departemen": "TLD TUKANG",
      "status": "K1",
      "bank_name": "BRI",
      "bank_no": "037801054394501",
      "bank_account": "DEDE HERU SARIPUDIN",
      "daily_rate": 175000
     }
            ]
        }';

        // Mengonversi JSON menjadi array PHP
        $data = json_decode($jsonData, true);

        // Melakukan loop untuk menampilkan data
        foreach ($data['data'] as $item) {

            DB::table('daily_worker')->insert(
                [
                    'badgenumber' => $item['pin'],
                    'name' => $item['name'],
                    'department' => $item['departemen'],
                    'status' => $item['status'],
                    'site' => $item['site'],
                    'rate' => $item['daily_rate'],
                    'bank_name' => empty($item['bank_name']) ? '' : $item['bank_name'],
                    'bank_account_no' => empty($item['bank_no']) ? 0 : $item['bank_no'],
                    'bank_account_name' => $item['bank_account'],
                    'salary_type' => 1,
                    'created_at' => Carbon::now()
                ]
            );
        }

        return 'ok';
    }
}
