<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PenerimaanTeknisController;
use App\Http\Controllers\PenerimaanPPKController;
use App\Http\Controllers\PenerimaanGudangController;
use App\Http\Controllers\DetailPenerimaanController;

// ==============================
// LOGIN (harus di luar middleware web)
// ==============================
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'autentikasi'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// ==============================
// ROUTE UNTUK USER YANG SUDAH LOGIN
// ==============================
Route::middleware(['web', 'auth.session'])->group(function () {

    // ==========================
    // PROFILE - semua role
    // ==========================
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/faq', [ProfileController::class, 'faq'])->name('faq');


    // ==========================
    // MANAJEMEN AKUN - SUPER ADMIN ONLY
    // ==========================
    Route::prefix('akun')->middleware('superadmin')->group(function () {
        Route::get('/', [AkunController::class, 'index'])->name('akun.index');
        Route::get('/create', [AkunController::class, 'create'])->name('akun.create');
        Route::post('/', [AkunController::class, 'store'])->name('akun.store');
        Route::get('/{id}/edit', [AkunController::class, 'edit'])->name('akun.edit');
        Route::put('/{id}', [AkunController::class, 'update'])->name('akun.update');
        Route::delete('/{id}', [AkunController::class, 'destroy'])->name('akun.destroy');
        Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
        Route::get('/akun/{id}', [AkunController::class, 'show'])->name('akun.show');
        Route::get('/akun/{id}/monitoring', [MonitoringController::class, 'perUser'])
            ->name('monitoring.peruser');
    });


    Route::middleware('multirole:admin,admin gudang umum')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::middleware('multirole:instalasi')->group(function () {
        Route::get('/pemesanan', function () {
            return view('pemesanan');
        })->name('pemesanan.index');
    });

    Route::middleware('multirole:ppk, teknis')->group(function () {
        Route::get('/penerimaan', function () {
            return view('penerimaan');
        })->name('penerimaan.index');
    });

    Route::middleware('multirole:penanggung jawab')->group(function () {
        Route::get('/pengeluaran', function () {
            return view('pengeluaran');
        })->name('pengeluaran.index');
    });

// ==========================
// PENERIMAAN TEKNIS
// ==========================
Route::middleware(['teknis'])->prefix('penerimaan/teknis')->name('teknis.penerimaan.')->group(function () {
// Route::prefix('penerimaan/teknis')->name('teknis.penerimaan.')->group(function () {
    Route::get('/', [PenerimaanTeknisController::class, 'index'])->name('index');
    Route::get('/{id}/detail', [PenerimaanTeknisController::class, 'detail'])->name('detail');
    Route::post('/{id}/update-kelayakan', [PenerimaanTeknisController::class, 'updateKelayakan'])->name('update');
});

// ==========================
// PENERIMAAN PPK
// ==========================
Route::middleware(['ppk'])->prefix('penerimaan/ppk')->name('ppk.penerimaan.')->group(function () {
// Route::prefix('penerimaan/ppk')->name('ppk.penerimaan.')->group(function () {
    Route::get('/', [PenerimaanPPKController::class, 'index'])->name('index');
    Route::get('/{id}/create', [PenerimaanPPKController::class, 'create'])->name('create');
    Route::post('/{id}/store', [PenerimaanPPKController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PenerimaanPPKController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [PenerimaanPPKController::class, 'update'])->name('update');
    Route::delete('/{id}/delete', [PenerimaanPPKController::class, 'destroy'])->name('delete');
});

// ==========================
// PENERIMAAN GUDANG
// ==========================
Route::middleware(['admin.gudang'])->prefix('penerimaan/gudang')->name('gudang.penerimaan.')->group(function () {
// Route::prefix('penerimaan/gudang')->name('gudang.penerimaan.')->group(function () {
    Route::get('/', [PenerimaanGudangController::class, 'index'])->name('index');
    Route::get('/{id}/upload-bast', [PenerimaanGudangController::class, 'uploadBast'])->name('upload');
    Route::post('/{id}/store-bast', [PenerimaanGudangController::class, 'storeBast'])->name('storeBast');
    Route::get('/download/{id}', [PenerimaanGudangController::class, 'downloadBast'])->name('download');
});

// ==========================
// DETAIL PENERIMAAN
// ==========================
Route::prefix('detail')->group(function () {

    Route::get('/{id}', [DetailPenerimaanController::class, 'index'])
        ->name('detail.index');

    Route::get('/{id}/create', [DetailPenerimaanController::class, 'create'])
        ->name('detail.create');

    Route::post('/{id}/store', [DetailPenerimaanController::class, 'store'])
        ->name('detail.store');

    Route::get('/edit/{id_detail}', [DetailPenerimaanController::class, 'edit'])
        ->name('detail.edit');

    Route::put('/update/{id_detail}', [DetailPenerimaanController::class, 'update'])
        ->name('detail.update');

    Route::delete('/delete/{id_detail}', [DetailPenerimaanController::class, 'destroy'])
        ->name('detail.delete');
});

    // ==========================
    // DASHBOARD PER ROLE
    // ==========================
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/penerimaan', function () {
        return view('penerimaan');
    })->name('penerimaan.index');

    Route::get('/pengeluaran', function () {
        return view('pengeluaran');
    })->name('pengeluaran.index');

    Route::get('/pemesanan', function () {
        return view('pemesanan');
    })->name('pemesanan.index');

});
