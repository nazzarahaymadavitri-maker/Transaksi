<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnackTransaction extends Model
{
    use HasFactory;

    protected $table = 'snack_transactions';

    protected $fillable = [
        'transaction_id',
        'nama_item',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'tanggal_transaksi',
    ];
}