<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/data-dashboard', [TransaksiController::class, 'dataDashboard']);
    Route::get('/cek-saldo-awal', [TransaksiController::class, 'cekSaldoAwal']);
    Route::get('/data-transaksi', [TransaksiController::class, 'data']);
    Route::post('/simpan-transaksi', [TransaksiController::class, 'simpanTransaksi']);
    Route::post('/hapus-transaksi', [TransaksiController::class, 'hapusTransaksi']);
});
