<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::prefix('vehicles')->group(function () {
    Route::get('/', [VehicleController::class, 'index']);
    Route::get('/{id}', [VehicleController::class, 'show']);
    Route::post('/', [VehicleController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/{id}', [VehicleController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{id}', [VehicleController::class, 'destroy'])->middleware('auth:sanctum');
    Route::get('/{vehicle}/leads', [LeadController::class, 'show']);
});

Route::prefix('leads')->group(function () {
    Route::get('/', [LeadController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/', [LeadController::class, 'store']);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:sanctum');