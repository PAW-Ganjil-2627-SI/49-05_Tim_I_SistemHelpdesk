<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GangguanController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return 'Berhasil connect ke DB!';
    } catch (\Exception $e) {
        return 'Gagal connect ke DB: ' . $e->getMessage();
    }
})->withoutMiddleware('web');

// Halaman daftar gangguan bisa dilihat siapa saja
Route::get('/daftar-gangguan', [GangguanController::class, 'daftar'])->name('gangguan.daftar');

// Halaman khusus pengunjung yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
});

// Halaman khusus pengguna yang sudah login (admin, teknisi, user)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [GangguanController::class, 'index'])->name('home');
    Route::post('/gangguan', [GangguanController::class, 'store'])->name('gangguan.store');

    Route::get('/gangguan/{gangguan}/edit', [GangguanController::class, 'edit'])->name('gangguan.edit');
    Route::put('/gangguan/{gangguan}', [GangguanController::class, 'update'])->name('gangguan.update');
    Route::delete('/gangguan/{gangguan}', [GangguanController::class, 'destroy'])->name('gangguan.destroy');
});