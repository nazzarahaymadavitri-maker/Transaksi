<?php

namespace App\Imports;

use App\Models\SnackTransaction;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SnackImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?Model
    {
        return SnackTransaction::updateOrCreate(
            ['transaction_id' => $row['id_transaksi']],
            [
                'nama_item'         => $row['nama_snack_dessert'],
                'jumlah'            => $row['jumlah'],
                'harga_satuan'      => $row['harga_satuan_rp'],
                'total_harga'       => $row['total_harga_rp'],
                'tanggal_transaksi' => $row['tanggal_transaksi'],
            ]
        );
    }
}