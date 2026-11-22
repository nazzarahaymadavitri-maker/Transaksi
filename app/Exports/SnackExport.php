<?php

namespace App\Exports;

use App\Models\SnackTransaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Database\Eloquent\Builder;

class SnackExport implements FromQuery, WithHeadings, WithTitle, WithStyles, ShouldAutoSize, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    // Perhatikan penambahan : Builder di ujung deklarasi fungsi ini
    public function query(): Builder
    {
        $query = SnackTransaction::query();

        // Filter Waktu / Rentang Tanggal
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('tanggal_transaksi', [$this->startDate, $this->endDate]);
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->transaction_id,
            $row->nama_item,
            $row->jumlah,
            $row->harga_satuan,
            $row->total_harga,
            $row->tanggal_transaksi,
        ];
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Snack / Dessert',
            'Jumlah',
            'Harga Satuan (Rp)',
            'Total Harga (Rp)',
            'Tanggal Transaksi',
        ];
    }

  public function title(): string
    {
        return 'Cemilan & Dessert';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'B45309'], // Dark Amber Header
                ],
            ],
        ];
    }
}