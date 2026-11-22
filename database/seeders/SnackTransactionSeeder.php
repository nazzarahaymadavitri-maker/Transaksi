<?php

namespace Database\Seeders;

use App\Models\SnackTransaction;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SnackTransactionSeeder extends Seeder
{
    public function run(): void
    {
        // 10 Varian Menu Snack & Dessert
        $items = [
            ['nama' => 'Pisang Goreng Keju', 'harga' => 15000],
            ['nama' => 'Dimsum Ayam', 'harga' => 20000],
            ['nama' => 'Roti Bakar Cokelat', 'harga' => 18000],
            ['nama' => 'Pancake Ice Cream', 'harga' => 25000],
            ['nama' => 'Churros Chocolate', 'harga' => 22000],
            ['nama' => 'Waffle Caramel', 'harga' => 27000],
            ['nama' => 'Singkong Goreng Crispy', 'harga' => 14000],
            ['nama' => 'Cireng Bumbu Rujak', 'harga' => 12000],
            ['nama' => 'French Fries Cheese', 'harga' => 16000],
            ['nama' => 'Brownies Lava', 'harga' => 23000],
        ];

        // Buat 20 data sampel transaksi dummy
        for ($i = 1; $i <= 20; $i++) {
            $item = $items[array_rand($items)];
            $qty = rand(1, 5);
            $total = $qty * $item['harga'];
            
            // Format ID khusus: TRX-SNACK-202610-xxx
            $trxId = 'TRX-SNACK-202610-' . str_pad($i, 3, '0', STR_PAD_LEFT);

            SnackTransaction::create([
                'transaction_id' => $trxId,
                'nama_item' => $item['nama'],
                'jumlah' => $qty,
                'harga_satuan' => $item['harga'],
                'total_harga' => $total,
                'tanggal_transaksi' => Carbon::now()->subDays(rand(0, 15))->format('Y-m-d'),
            ]);
        }
    }
}