<?php

use Illuminate\Support\Facades\Route;

// ==============================
// LOGIN
// ==============================
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkunController;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'autentikasi'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// ==============================
// MIDDLEWARE UNTUK USER TERLOGIN
// ==============================
Route::middleware(['web'])->group(function () {

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
});

    // ==========================
    // DASHBOARD PER ROLE
    // (placeholder — kita buat sesuai dokumen alur)
    // ==========================

Route::get('/dashboard', function () {
    return view('V_HalDashboard');
})->name('dashboard');

Route::get('/penerimaan', function () {
    return view('V_HalPenerimaan');
})->name('penerimaan.index');

Route::get('/pengeluaran', function () {
    return view('V_HalPengeluaran');
})->name('pengeluaran.index');

Route::get('/pemesanan', function () {
    return view('V_HalPemesanan');
})->name('pemesanan.index');

});
