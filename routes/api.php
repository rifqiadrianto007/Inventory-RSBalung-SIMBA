<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AkunApiController;
use App\Http\Controllers\Api\PenerimaanApiController;
use App\Http\Controllers\Api\StokApiController;
use App\Http\Controllers\Api\PegawaiApiController;
use App\Http\Controllers\Api\NotifikasiApiController;
use App\Http\Controllers\Api\PemesananApiController;

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

    // ---------- Stok ----------
    Route::get('/stok', [StokApiController::class, 'index']);
    Route::get('/stok/{id}', [StokApiController::class, 'show']);
    Route::post('/stok', [StokApiController::class, 'store'])->middleware('role.api:super admin,admin gudang umum');
    Route::put('/stok/{id}', [StokApiController::class, 'update'])->middleware('role.api:super admin,admin gudang umum');
    Route::post('/stok/{id}/adjust', [StokApiController::class, 'adjustStock'])->middleware('role.api:admin gudang umum');

    // ---------- Pegawai ----------
    Route::get('/pegawai', [PegawaiApiController::class, 'index'])->middleware('role.api:super admin');
    Route::get('/pegawai/{id}', [PegawaiApiController::class, 'show'])->middleware('role.api:super admin');
    Route::post('/pegawai', [PegawaiApiController::class, 'store'])->middleware('role.api:super admin');
    Route::put('/pegawai/{id}', [PegawaiApiController::class, 'update'])->middleware('role.api:super admin');
    Route::post('/pegawai/{id}/toggle', [PegawaiApiController::class, 'toggleStatus'])->middleware('role.api:super admin');

    // ---------- Notifikasi (semua user) ----------
    Route::get('/notifikasi', [NotifikasiApiController::class, 'index']);
    Route::post('/notifikasi', [NotifikasiApiController::class, 'store']); // system/internal
    Route::post('/notifikasi/{id}/read', [NotifikasiApiController::class, 'markRead']);

    // ---------- Pemesanan ----------
    Route::get('/pemesanan', [PemesananApiController::class, 'index']);
    Route::get('/pemesanan/{id}', [PemesananApiController::class, 'show']);
    Route::post('/pemesanan', [PemesananApiController::class, 'store'])->middleware('role.api:instalasi');
    Route::put('/pemesanan/{id}/status', [PemesananApiController::class, 'updateStatus'])->middleware('role.api:ppk,teknis,admin gudang umum');
    Route::delete('/pemesanan/{id}', [PemesananApiController::class, 'destroy'])->middleware('role.api:ppk');
});

