<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class NidiExport implements FromCollection, WithStyles, ShouldAutoSize, WithEvents
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        // Query to fetch NIDI data from the database
        $data = DB::table('tb_nidi')
            ->join('tb_peruntukannidi', 'tb_nidi.id_peruntukan', '=', 'tb_peruntukannidi.id')
            ->select('tb_nidi.*', 'tb_peruntukannidi.nama as peruntukan_nama')
            ->whereBetween('tb_nidi.tanggal', [$this->start_date, $this->end_date])
            ->orderBy('tb_nidi.tanggal', 'asc')
            ->get();

        // Adding headings as the first row
        $headings = [
            'Nama',
            'Daya',
            'Tanggal',
            'PT',
            'Sebanyak',
            'Peruntukan',
            'Harga NIDI (Asli)',
            'Harga NIDI (Setelah)',
            'Harga SLO (Asli)',
            'Harga SLO (Setelah)',
        ];

        // Mapping data and adding row numbers
        $mapped_data = $data->map(function ($item, $key) {
            // Format the date to 'j-M-y'
            $formatted_date = date_create($item->tanggal)->format('j-M-y');

            return [
                'nama' => $item->nama,
                'daya' => $item->daya,
                'tanggal' => $formatted_date,
                'pt' => $item->pt,
                'sebanyak' => $item->sebanyak,
                'peruntukan_nama' => $item->peruntukan_nama,
                'hrg_nidi_asli' => $item->hrg_nidi_asli,
                'hrg_nidi_set' => $item->hrg_nidi_set,
                'hrg_slo_asli' => $item->hrg_slo_asli,
                'hrg_slo_set' => $item->hrg_slo_set,
            ];
        });

        // Calculate total row
        $total_row = [
            'nama' => 'Total',
            'daya' => '',
            'tanggal' => '',
            'pt' => '',
            'sebanyak' => $mapped_data->sum('sebanyak') . ' Buah',
            'peruntukan_nama' => '',
            'hrg_nidi_asli' => $mapped_data->sum('hrg_nidi_asli'),
            'hrg_nidi_set' => $mapped_data->sum('hrg_nidi_set'),
            'hrg_slo_asli' => $mapped_data->sum('hrg_slo_asli'),
            'hrg_slo_set' => $mapped_data->sum('hrg_slo_set'),
        ];

        // Prepending headings, data, and total row
        $data_with_headings_and_total = collect([$headings])->merge($mapped_data)->push($total_row);

        return $data_with_headings_and_total;
    }


    public function styles(Worksheet $sheet)
    {
        // Style for the header
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);

        // Style for the data
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:J' . ($highestRow - 1))->applyFromArray([
            'borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'inside' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ]);

        // Style for the total row (assuming it's the last row)
        $sheet->getStyle('A' . $highestRow . ':J' . $highestRow)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFF00'], // Yellow color
            ],
            'font' => ['bold' => true],
        ]);

        // Number formatting for specific columns in the total row
        $totalRowColumns = ['G', 'H', 'I', 'J']; // Columns for 'hrg_nidi_asli', 'hrg_nidi_set', 'hrg_slo_asli', 'hrg_slo_set'
        foreach ($totalRowColumns as $column) {
            // $sheet->getStyle($column)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
            $sheet->getStyle($column)->getNumberFormat()->setFormatCode('#,##0');
        }

    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // You can add additional events here if needed
            },
        ];
    }
}
