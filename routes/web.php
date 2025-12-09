<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\faktur_PenjualanController;
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

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
  
    
    // ========== USER MANAGEMENT ==========
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
 
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