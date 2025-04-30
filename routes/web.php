<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/dokter', [HomeController::class, 'index'])->name('dokter');
    Route::get('/pasien', [HomeController::class, 'index'])->name('pasien');
    // dst
});


// Rute logout
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Rute untuk pasien
Route::prefix('pasien')->group(function () {
    Route::get('/pasien', [HomeController::class, 'pasien'])->name('pasien');
    Route::get('/periksa', [PeriksaController::class, 'indexPasien'])->name('pasien.periksa.index');
    Route::get('/pasien/periksa/', [PeriksaController::class, 'indexPasien'])->name('pasien.periksa.index');
    Route::post('/pasien/periksa/', [PeriksaController::class, 'storePasien'])->name('pasien.periksa.simpan');

});

// Rute untuk dokter
Route::prefix('dokter')->middleware(['auth'])->group(function () {
    // Hanya untuk user dengan role 'dokter'
    // Route::middleware('can:dokter')->group(function () {
        // Dashboard
        Route::get('/dokter', [HomeController::class, 'dokter'])->name('dokter');

        // Periksa - tampilan dan edit
        Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa.index');
        Route::get('/dokter/periksa/{id}/edit', [PeriksaController::class, 'editPeriksa'])->name('periksa.edit');

        // Obat - tampilan
        Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
        Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
        Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    // });

    // Semua aksi modifikasi data tidak memakai 'can' karena dicek langsung lewat controller atau policy
    Route::post('/dokter/periksa/{id}', [PeriksaController::class, 'simpanPeriksa'])->name('periksa.simpan');

    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
});