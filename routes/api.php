<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);  // open for all users
Route::post('/login', [AuthController::class, 'login']);        // open for all users

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::middleware('admin')->group(function () {
        Route::get('/admin/providers', [AdminController::class, 'getProviders']);
        Route::post('/admin/providers', [AdminController::class, 'addProvider']);
        Route::get('/admin/customers', [AdminController::class, 'getCustomers']);
    });
});
