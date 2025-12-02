<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\faktur_penjualanController; // nama asli controller
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/faktur_penjualan/kelola/{id}', [faktur_penjualanController::class, 'kelola'])->name('faktur-penjualan.kelola');
Route::resource('faktur_penjualan', faktur_penjualanController::class)->except(['show']);

Route::get('/faktur_penjualan/kelola/{id}', [faktur_penjualanController::class, 'kelola']);
Route::post('/kwitansi', [faktur_penjualanController::class, 'storeKwitansi']);
Route::delete('/kwitansi/{id}', [faktur_penjualanController::class, 'destroyKwitansi'])->name('kwitansi.destroy');

require __DIR__.'/auth.php';