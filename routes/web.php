<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\MonitoringController;

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
