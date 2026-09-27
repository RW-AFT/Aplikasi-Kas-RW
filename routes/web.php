<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['web'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('warga', App\Http\Controllers\WargaController::class);
    Route::resource('iuran', App\Http\Controllers\IuranController::class);
    Route::resource('transaksi', App\Http\Controllers\TransactionController::class);
});
