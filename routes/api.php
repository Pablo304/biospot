<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth:sanctum');
    });

    Route::prefix('complaints')->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name('complaint.index');
        Route::get('/{compliant}', [ComplaintController::class, 'show'])->name('complaint.show');
        Route::get('/status', [StatusController::class, 'index'])->name('status.index');
        Route::post('/{compliant}', [ComplaintController::class, 'discard'])->name('complaint.discard');
    });
});
