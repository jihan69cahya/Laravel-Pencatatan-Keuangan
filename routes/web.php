<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\PenggunaController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'redirect.if.logged.in'], function () {
    Route::get('/', [LandingController::class, 'index'])->name('landing');
    Route::get('/informasi', [LandingController::class, 'informasi'])->name('informasi');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/doLogin', [AuthController::class, 'login'])->name('doLogin');
});

Route::group(['middleware' => 'redirect.if.auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });
});
