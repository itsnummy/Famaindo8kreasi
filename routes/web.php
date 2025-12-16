<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\faktur_PenjualanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CetakController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard dengan controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/filter', [DashboardController::class, 'filterData'])->name('dashboard.filter');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getOrderChartData'])->name('dashboard.chart');

    // User Management
    Route::resource('users', UserController::class);
    
    // Faktur Penjualan
    Route::resource('faktur_penjualan', faktur_penjualanController::class)
    ->except(['show']); 
    Route::get('/faktur_penjualan/kelola/{id}', [faktur_penjualanController::class, 'kelola'])
        ->name('faktur_penjualan.kelola');
    Route::put('/faktur_penjualan/{id}/selesai', [faktur_penjualanController::class, 'updateStatusSelesai'])
        ->name('faktur_penjualan.selesai');
    
        Route::get('/kelola-pembayaran', [faktur_penjualanController::class, 'indexKelolaPembayaran'])
    ->name('faktur_penjualan.kelolabayar');

// Route untuk DETAIL satu faktur (tabs)
    Route::get('/faktur_penjualan/kelola/{id}', [faktur_penjualanController::class, 'kelola'])
    ->name('faktur_penjualan.kelola'); 
    
    // Kwitansi
    Route::prefix('kwitansi')->group(function () {
        Route::post('/', [faktur_penjualanController::class, 'storeKwitansi'])->name('kwitansi.store');
        Route::delete('/{id}', [faktur_penjualanController::class, 'destroyKwitansi'])->name('kwitansi.destroy');
    });
    
    // Cetak
    Route::prefix('cetak')->group(function () {
        Route::get('/faktur/{no_transaksi}', [CetakController::class, 'cetakFaktur'])->name('cetak.faktur');
        Route::get('/preview/faktur/{no_transaksi}', [CetakController::class, 'previewFaktur'])->name('preview.faktur');
        Route::get('/preview/suratjalan/{no_transaksi}', [CetakController::class, 'previewSuratJalan'])->name('preview.suratjalan');
        Route::get('/suratjalan/{no_transaksi}', [CetakController::class, 'cetakSuratJalan'])->name('cetak.suratjalan');
        Route::get('/preview/kwitansi/{no_transaksi}', [CetakController::class, 'previewKwitansi'])->name('preview.kwitansi');
        Route::get('/kwitansi/{no_transaksi}', [CetakController::class, 'cetakKwitansi'])->name('cetak.kwitansi');
        Route::get('/preview/semuakwitansu/{no_transaksi}', [CetakController::class, 'previewSemuaKwitansi'])->name('preview.semuakwitansi');
        Route::get('/semuakwitansi/{no_transaksi}', [CetakController::class, 'cetakSemuaKwitansi'])->name('cetak.semuakwitansi');
    });
});


Route::fallback(function () {
    return redirect('/dashboard');
});