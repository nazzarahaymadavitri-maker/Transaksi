<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnackController;

Route::redirect('/', '/snack');
Route::get('/snack', [SnackController::class, 'index'])->name('snack.index');
Route::get('/snack/export', [SnackController::class, 'export'])->name('snack.export');
Route::post('/snack/import', [SnackController::class, 'import'])->name('snack.import');