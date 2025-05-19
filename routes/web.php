<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderanController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// another routing goes here
Route::middleware('auth')->group(function () {
    Route::get('/orderan/{orderan}/cetak-pdf', [OrderanController::class, 'cetakPdf'])->name('orderan.cetakPdf');
    Route::get('/orderan/cetak-semua', [OrderanController::class, 'cetakSemua'])->name('orderan.cetakSemua');
    Route::post('/orderan/{orderan}/upload-bukti', [OrderanController::class, 'uploadBukti'])->name('orderan.uploadBukti');
});

//all resource routing goes below
Route::resource('layanan', LayananController::class)->middleware(['auth']);
Route::resource('pelanggan', PelangganController::class)->middleware(['auth']);
Route::resource('orderan', OrderanController::class)->middleware(['auth']);

//kayaknya ini routing yg kd tepakai, sdh dihandle resource routing
// Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
// Route::get('/orderan/{id}', [OrderanController::class, 'show'])->name('orderan.show');
// Route::get('/orderan/{id}/edit', [OrderanController::class, 'edit'])->name('orderan.edit');
// Route::put('/orderan/{orderan}', [OrderanController::class, 'update'])->name('orderan.update');

require __DIR__ . '/auth.php';