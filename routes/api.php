<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PlagueController;
use App\Http\Controllers\PlagueStatusController;
use App\Http\Controllers\PlagueTypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SuspectController;
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
        Route::post('/', [ComplaintController::class, 'store'])->name('complaint.store');
        Route::get('/{compliant}', [ComplaintController::class, 'show'])->name('complaint.show');
        Route::post('/{compliant}/discard', [ComplaintController::class, 'discard'])->name('complaint.discard');
        Route::post('/{compliant}/confirm', [ComplaintController::class, 'confirm'])->name('complaint.confirm');
    });

    Route::prefix('suspects')->group(function () {
        Route::get('/', [SuspectController::class, 'index'])->name('suspect.index');
        Route::get('/{suspect}', [SuspectController::class, 'show'])->name('suspect.show');
        Route::post('/{suspect}/discard', [SuspectController::class, 'discard'])->name('suspect.discard');
        Route::post('/{suspect}/confirm', [SuspectController::class, 'confirm'])->name('suspect.confirm');
    });

    Route::prefix('plague')->group(function () {
        Route::post('/', [PlagueController::class, 'store'])->name('plague.store');
        Route::get('/plague-status', [PlagueStatusController::class, 'index']);
        Route::get('/plague-types', [PlagueTypeController::class, 'index'])->name('plague.types');
    });
    Route::get('/status', [StatusController::class, 'index'])->name('status.index');
});
