<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/data-dashboard', [TransaksiController::class, 'dataDashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/data-transaksi', [TransaksiController::class, 'data']);
});
