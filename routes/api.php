<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AkunApiController;
use App\Http\Controllers\Api\PenerimaanApiController;

// ===== AUTENTIKASI =====
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// ===== ROUTE DILINDUNGI TOKEN =====
Route::middleware('auth:sanctum')->group(function () {

    // ---------- AKUN ----------
    Route::get('/akun', [AkunApiController::class, 'index']);
    Route::get('/akun/{id}', [AkunApiController::class, 'show']);
    Route::post('/akun', [AkunApiController::class, 'store']);
    Route::put('/akun/{id}', [AkunApiController::class, 'update']);
    Route::delete('/akun/{id}', [AkunApiController::class, 'destroy']);

    // Monitoring
    Route::get('/monitoring', [AkunApiController::class, 'monitoringAll']);
    Route::get('/monitoring/{id}', [AkunApiController::class, 'monitoringUser']);

    // ---------- PENERIMAAN ----------
    Route::get('/penerimaan', [PenerimaanApiController::class, 'index']);
    Route::get('/penerimaan/{id}', [PenerimaanApiController::class, 'show']);
    Route::post('/penerimaan', [PenerimaanApiController::class, 'store'])->middleware('role.api:ppk');
    Route::put('/penerimaan/{id}', [PenerimaanApiController::class, 'update'])->middleware('role.api:ppk,teknis');
    Route::delete('/penerimaan/{id}', [PenerimaanApiController::class, 'destroy'])->middleware('role.api:ppk');

    // Upload/download BAST (khusus gudang)
    Route::post('/penerimaan/{id}/upload-bast', [PenerimaanApiController::class, 'uploadBast'])->middleware('role.api:admin gudang umum');
    Route::get('/penerimaan/{id}/download-bast', [PenerimaanApiController::class, 'downloadBast'])->middleware('role.api:admin gudang umum');
});

