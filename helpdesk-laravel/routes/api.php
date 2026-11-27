<?php

use App\Http\Controllers\Api\AsetApiController;
use App\Http\Controllers\Api\DepartemenApiController;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::get('/departemen', [DepartemenApiController::class, 'index']);
Route::get('/departemen/{departemen}', [DepartemenApiController::class, 'show']);
Route::get('/aset', [AsetApiController::class, 'index']);
Route::get('/aset/{aset}', [AsetApiController::class, 'show']);

Route::middleware([EncryptCookies::class, StartSession::class, 'api.admin'])->group(function (): void {
    Route::post('/departemen', [DepartemenApiController::class, 'store']);
    Route::put('/departemen/{departemen}', [DepartemenApiController::class, 'update']);
    Route::patch('/departemen/{departemen}', [DepartemenApiController::class, 'update']);
    Route::delete('/departemen/{departemen}', [DepartemenApiController::class, 'destroy']);

    Route::post('/aset', [AsetApiController::class, 'store']);
    Route::put('/aset/{aset}', [AsetApiController::class, 'update']);
    Route::patch('/aset/{aset}', [AsetApiController::class, 'update']);
    Route::delete('/aset/{aset}', [AsetApiController::class, 'destroy']);
});
