<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FakturPenjualanController;
use Illuminate\Support\Facades\Route;

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return redirect()->route('login');
});

// ==================== AUTH ROUTES (TANPA MIDDLEWARE) ====================
// Tambah middleware 'guest' agar user yang sudah login tidak bisa akses login page
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ==================== PROTECTED ROUTES (HANYA SETELAH LOGIN) ====================
Route::middleware(['auth'])->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ========== USER MANAGEMENT ==========
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    // ========== FAKTUR PENJUALAN ==========
    // Perbaiki nama class (huruf besar di awal)
    Route::resource('faktur_penjualan', 'App\Http\Controllers\faktur_penjualanController');
    
    // Route khusus untuk kelola
    Route::get('/faktur_penjualan/kelola/{id}', [faktur_penjualanController::class, 'kelola'])
        ->name('faktur_penjualan.kelola');
    
    // Kwitansi routes
    Route::post('/kwitansi', [faktur_penjualanController::class, 'storeKwitansi']);
    Route::delete('/kwitansi/{id}', [faktur_penjualanController::class, 'destroyKwitansi'])
        ->name('kwitansi.destroy');
});

// ==================== FALLBACK ROUTE ====================
Route::fallback(function () {
    return redirect('/dashboard');
});