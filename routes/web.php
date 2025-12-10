<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\faktur_PenjualanController;
use App\Http\Controllers\DashboardController;
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
        Route::get('/cetak/{id}', [faktur_penjualanController::class, 'cetak'])->name('kwitansi.cetak');
        Route::get('/cetak-semua/{no_transaksi}', [faktur_penjualanController::class, 'cetakSemua'])->name('kwitansi.cetak-semua');
    });
    
    // Cetak
    Route::prefix('cetak')->group(function () {
        Route::get('/faktur/{no_transaksi}', [faktur_penjualanController::class, 'cetakFaktur'])->name('cetak.faktur');
        Route::get('/surat-jalan/{no_transaksi}', [faktur_penjualanController::class, 'cetakSuratJalan'])->name('cetak.surat-jalan');
    });
});

Route::fallback(function () {
    return redirect('/dashboard');
});