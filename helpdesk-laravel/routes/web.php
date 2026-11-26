<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

// =========================================================
// PUBLIK: BOLEH DIBUKA TANPA LOGIN (TAMU)
// =========================================================
Route::view('/', 'templates.dashboard')->name('home');
Route::view('/dashboard', 'templates.dashboard')->name('dashboard');
Route::get('/daftar-gangguan', [GangguanController::class, 'daftar'])->name('gangguan.daftar');

// Halaman Kerangka Sementara Modul A, B, dan D
Route::view('/teknisi', 'modul b.index')->name('teknisi.index');
Route::view('/aset', 'modul d.index')->name('aset.index');

// Modul C: Daftar Knowledge Base / FAQ (Publik)
Route::get('/faq', [FaqController::class, 'daftar'])->name('faq.daftar');
// =========================================================
// HANYA UNTUK YANG BELUM LOGIN (GUEST)
// =========================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
});

// =========================================================
// HANYA UNTUK YANG SUDAH LOGIN (AUTH)
// =========================================================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [GangguanController::class, 'index'])->name('home');
    Route::post('/gangguan', [GangguanController::class, 'store'])->name('gangguan.store');

    Route::get('/gangguan/{gangguan}/edit', [GangguanController::class, 'edit'])->name('gangguan.edit');
    Route::put('/gangguan/{gangguan}', [GangguanController::class, 'update'])->name('gangguan.update');
    Route::delete('/gangguan/{gangguan}', [GangguanController::class, 'destroy'])->name('gangguan.destroy');

    // Gate: hanya admin yang boleh menambah FAQ baru
    Route::get('/faq/tambah', [FaqController::class, 'create'])
        ->can('kelola-faq-baru')
        ->name('faq.create');
    Route::post('/faq', [FaqController::class, 'store'])
        ->can('kelola-faq-baru')
        ->name('faq.store');

    // Middleware Role ('role:admin,teknisi') + Policy ('update', 'faq')
    Route::middleware('role:admin,teknisi')->group(function () {
        Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])
            ->can('update', 'faq')
            ->name('faq.edit');
        Route::put('/faq/{faq}', [FaqController::class, 'update'])
            ->can('update', 'faq')
            ->name('faq.update');
    });

    // Middleware Role ('role:admin') + Policy ('delete', 'faq')
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])
        ->middleware('role:admin')
        ->can('delete', 'faq')
        ->name('faq.destroy');
});