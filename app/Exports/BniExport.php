<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BniExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
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
        $query = DB::table('tb_bni')
            ->select('tanggal', 'keterangan', 'status', 'jml_transaksi', 'saldo_akhir', 'saldo_awal')
            ->whereBetween('tanggal', [$this->start_date, $this->end_date]);

        $data = $query->orderBy('tanggal', 'asc')->get();

        $saldo_awal = count($data) > 0 ? $data->first()->saldo_awal : 0;

        $mapped_data = $data->map(function ($item, $key) {
            $formatted_date = date_create($item->tanggal)->format('j-M-y');
            return [
                'no' => $key + 1,
                'tanggal' => $formatted_date,
                'keterangan' => $item->keterangan,
                'penerimaan' => $item->status == 'penerimaan' ? $item->jml_transaksi : 0,
                'pengeluaran' => $item->status == 'pengeluaran' ? $item->jml_transaksi : 0,
                'saldo_akhir' => $item->saldo_akhir,
            ];
        });

        $saldo_awal_row = collect([
            [
                'no' => '',
                'tanggal' => '',
                'keterangan' => 'Saldo Awal',
                'penerimaan' => '',
                'pengeluaran' => '',
                'saldo_akhir' => $saldo_awal == 0 ? '0' : $saldo_awal,
            ]
        ]);

        $merged_data = $saldo_awal_row->concat($mapped_data);

        return $merged_data;
    }

    public function headings(): array
    {
        return [
            'no',
            'tanggal',
            'keterangan',
            'penerimaan',
            'pengeluaran',
            'saldo_akhir',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:F' . $highestRow)->applyFromArray([
            'borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'inside' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestRow = $sheet->getHighestRow();

                $sheet->setCellValue('B' . ($highestRow + 2), 'Mengetahui,');
                $sheet->setCellValue('B' . ($highestRow + 3), 'Direktur');
                $sheet->setCellValue('B' . ($highestRow + 6), 'Furhanudin');

                $sheet->setCellValue('F' . ($highestRow + 2), 'Cirebon, ' . date('F Y'));
                $sheet->setCellValue('F' . ($highestRow + 6), 'Aini Hastika');

                $sheet->getStyle('B' . ($highestRow + 2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B' . ($highestRow + 3))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B' . ($highestRow + 6))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('F' . ($highestRow + 2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F' . ($highestRow + 6))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
