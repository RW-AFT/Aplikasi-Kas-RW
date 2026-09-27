<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Auth Routes
Auth::routes();
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Warga Management - Admin & Bendahara
    Route::middleware('role:admin,bendahara,ketua_rw')->group(function () {
        Route::resource('warga', WargaController::class);
        Route::get('/warga/{warga}/iuran', [WargaController::class, 'iuranHistory'])->name('warga.iuran');
    });
    
    // Iuran Management
    Route::middleware('role:admin,bendahara,ketua_rw')->group(function () {
        Route::resource('iuran', IuranController::class);
        Route::post('/iuran/{iuran}/bayar', [IuranController::class, 'bayar'])->name('iuran.bayar');
    });
    
    // Transaksi Kas
    Route::middleware('role:admin,bendahara,ketua_rw')->group(function () {
        Route::resource('transaksi', TransactionController::class);
        Route::get('/transaksi/laporan/bulanan', [TransactionController::class, 'laporanBulanan'])->name('transaksi.laporan');
    });
    
    // User Management - Admin & Ketua RW only
    Route::middleware('role:admin,ketua_rw')->group(function () {
        Route::resource('user', UserController::class);
        Route::post('/user/{user}/activate', [UserController::class, 'activate'])->name('user.activate');
        Route::post('/user/{user}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');
    });
});
