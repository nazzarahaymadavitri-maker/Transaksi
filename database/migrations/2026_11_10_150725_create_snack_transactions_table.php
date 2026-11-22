<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('snack_transactions', function (Blueprint $table) {
            $table->id();$table->string('transaction_id')->unique(); // ID: TRX-SNACK-202610-xxx
            $table->string('nama_item');$table->integer('jumlah');
            $table->decimal('harga_satuan', 12, 2);$table->decimal('total_harga', 12, 2);
            $table->date('tanggal_transaksi');$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('snack_transactions');
    }
};