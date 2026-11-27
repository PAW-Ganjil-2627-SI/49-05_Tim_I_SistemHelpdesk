<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AsetController::class, 'index'])->name('aset.index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// harus login
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // admin dan teknisi: boleh mengubah data aset
    Route::middleware('role:admin,teknisi')->group(function () {
        Route::get('/aset/{aset}/edit', [AsetController::class, 'edit'])->name('aset.edit');
        Route::put('/aset/{aset}', [AsetController::class, 'update'])->name('aset.update');
    });

    // admin saja: tambah dan hapus aset
    Route::middleware('role:admin')->group(function () {
        Route::get('/aset/create', [AsetController::class, 'create'])->name('aset.create');
        Route::post('/aset', [AsetController::class, 'store'])->name('aset.store');
        Route::delete('/aset/{aset}', [AsetController::class, 'destroy'])->name('aset.destroy');
    });
});