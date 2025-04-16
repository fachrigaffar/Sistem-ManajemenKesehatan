<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/dokter', [App\Http\Controllers\HomeController::class, 'dokter'])->name('dokter');
Route::get('/pasien', [App\Http\Controllers\HomeController::class, 'pasien'])->name('pasien');

Route::prefix('dokter')->group(function () {
    Route::resource('obat', ObatController::class);
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::resource('periksa', PeriksaController::class);
});