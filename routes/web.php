<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\faktur_penjualanController;
use Illuminate\Support\Facades\Route;

// ========== PUBLIC ROUTES ==========
Route::get('/', function () {
    return view('welcome'); // Dashboard publik untuk guest
});

// ========== AUTH ROUTES ==========
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========== PROTECTED ROUTES (Hanya untuk admin yang login) ==========
Route::middleware(['auth'])->group(function () {
    
    // DASHBOARD SEDERHANA (pakai closure dulu, tanpa controller)
    Route::get('/dashboard', function () {
        // Cek jika user adalah admin
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        
        // Tampilkan view dashboard.blade.php yang sudah ada
        return view('dashboard');
    })->name('dashboard');
    
    // Route lainnya...
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Faktur penjualan
    Route::get('/faktur_penjualan/kelola/{id}', [faktur_penjualanController::class, 'kelola'])->name('faktur-penjualan.kelola');
    Route::resource('faktur_penjualan', faktur_penjualanController::class)->except(['show']);
    
    // Kwitansi
    Route::post('/kwitansi', [faktur_penjualanController::class, 'storeKwitansi']);
    Route::delete('/kwitansi/{id}', [faktur_penjualanController::class, 'destroyKwitansi'])->name('kwitansi.destroy');
});

// ========== FALLBACK ==========
Route::fallback(function () {
    return redirect('/');
});