<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\PenggunaController;
use App\Http\Controllers\Keuangan\TransaksiController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'redirect.if.logged.in'], function () {
    Route::get('/', [LandingController::class, 'index'])->name('landing');
    Route::get('/informasi', [LandingController::class, 'informasi'])->name('informasi');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/register', [AuthController::class, 'index_register'])->name('register');
    Route::post('/doLogin', [AuthController::class, 'login'])->name('doLogin');
    Route::post('/doRegister', [AuthController::class, 'register'])->name('doRegister');
});

Route::group(['middleware' => 'redirect.if.auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('cek_saldo_awal', [TransaksiController::class, 'cekSaldoAwal'])->name('cek_saldo_awal');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });

    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('', [TransaksiController::class, 'index'])->name('index');
        Route::get('saldo_transaksi', [TransaksiController::class, 'saldoTransaksi'])->name('saldo_transaksi');
        Route::get('datatable_pencatatan', [TransaksiController::class, 'datatablePencatatan'])->name('datatable_pencatatan');
        Route::post('tambah_data', [TransaksiController::class, 'tambahData'])->name('tambah_data');
        Route::post('edit_data', [TransaksiController::class, 'editData'])->name('edit_data');
        Route::post('hapus_data', [TransaksiController::class, 'hapusData'])->name('hapus_data');
    });
});
