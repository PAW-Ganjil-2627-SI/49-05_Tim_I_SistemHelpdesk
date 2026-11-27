<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartemenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AsetController::class, 'index'])->name('aset.index');
Route::get('/aset', [AsetController::class, 'index'])->name('aset.list');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/departemen', [DepartemenController::class, 'index'])->name('departemen.index');

Route::middleware(['auth', 'role:admin'])->group(function (): void {
    Route::get('/departemen/create', [DepartemenController::class, 'create'])->name('departemen.create');
    Route::post('/departemen', [DepartemenController::class, 'store'])->name('departemen.store');
    Route::get('/departemen/{departemen}/edit', [DepartemenController::class, 'edit'])->name('departemen.edit');
    Route::put('/departemen/{departemen}', [DepartemenController::class, 'update'])->name('departemen.update');
    Route::delete('/departemen/{departemen}', [DepartemenController::class, 'destroy'])->name('departemen.destroy');

    Route::get('/aset/create', [AsetController::class, 'create'])->name('aset.create');
    Route::post('/aset', [AsetController::class, 'store'])->name('aset.store');
    Route::get('/aset/{aset}/edit', [AsetController::class, 'edit'])->name('aset.edit');
    Route::put('/aset/{aset}', [AsetController::class, 'update'])->name('aset.update');
    Route::delete('/aset/{aset}', [AsetController::class, 'destroy'])->name('aset.destroy');
});

Route::middleware(['auth', 'role:admin,teknisi'])->group(function (): void {
    Route::get('/aset/{aset}/kondisi', [AsetController::class, 'editKondisi'])->name('aset.kondisi.edit');
    Route::patch('/aset/{aset}/kondisi', [AsetController::class, 'updateKondisi'])->name('aset.kondisi.update');
});

Route::get('/aset/{aset}', [AsetController::class, 'show'])->name('aset.show');
