<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/providers', [AdminController::class, 'getProviders']);
        Route::post('/admin/providers', [AdminController::class, 'addProvider']);
        Route::get('/admin/customers', [AdminController::class, 'getCustomers']);
    });
    
    // Search functionality
    Route::get('/search', [SearchController::class, 'search']);
});