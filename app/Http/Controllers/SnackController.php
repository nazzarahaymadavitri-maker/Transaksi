<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SnackTransaction;
use App\Exports\SnackExport;
use App\Imports\SnackImport;
use Maatwebsite\Excel\Facades\Excel;

class SnackController extends Controller
{
    // 1. Menampilkan Halaman Utama & Filter Tanggal
    public function index(Request $request)
    {
        $query = SnackTransaction::query();

        // Cek jika user mengisi filter tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_transaksi', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->orderBy('tanggal_transaksi', 'desc')->get();

        return view('snack.index', compact('transactions'));
    }

    // 2. Memproses Export Excel
    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new SnackExport($startDate, $endDate), 'Penjualan_Cemilan_Dessert.xlsx');
    }

    // 3. Memproses Import Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new SnackImport, $request->file('file'));

        return redirect()->route('snack.index')->with('success', 'Data Cemilan & Dessert berhasil di-import!');
    }
}