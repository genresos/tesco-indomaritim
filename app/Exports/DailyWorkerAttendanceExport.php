<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DailyWorkerAttendanceExport implements FromArray, WithHeadings, WithEvents
{
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $result = [];

        // Mendapatkan daftar tanggal dari kunci data
        foreach ($this->data as $item) {
            $row = [$item['badgenumber']];


            // Ambil tanggal berdasarkan kunci yang ada
            foreach (array_keys($item) as $key) {
                if ($key !== 'badgenumber') {
                    $details = $item[$key] ?? ['cek_in' => null, 'cek_out' => null];
                    $row[] = $details['cek_in'] ?? 'N/A'; // Cek In
                    $row[] = $details['cek_out'] ?? 'N/A'; // Cek Out
                }
            }

            $result[] = $row;
        }

        return $result;
    }

    public function headings(): array
    {
        $headings = ['Employee'];

        // Ambil tanggal dari kunci data
        if (!empty($this->data)) {
            $firstItem = reset($this->data); // Ambil item pertama
            foreach (array_keys($firstItem) as $key) {
                if ($key !== 'badgenumber') {
                    $headings[] = $key; // Tambahkan tanggal
                    $headings[] = $key; // Tambahkan untuk cek in dan cek out
                }
            }
        }

        return $headings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Menggabungkan sel untuk setiap tanggal
                $dateCount = (count($this->headings()) - 2) / 2; // Menghitung jumlah tanggal
                for ($i = 0; $i < $dateCount; $i++) {
                    $startColumn = chr(66 + $i * 2); // Menghitung kolom mulai dari B (66)
                    $event->sheet->getDelegate()->mergeCells("$startColumn" . '1:' . chr(67 + $i * 2) . '1');
                }

                // Mengatur gaya sel
                $event->sheet->getDelegate()->getStyle('C1:' . chr(66 + ($dateCount * 2 - 1)) . '1')->getAlignment()->setHorizontal('center');
            },
        ];
    }
}
    