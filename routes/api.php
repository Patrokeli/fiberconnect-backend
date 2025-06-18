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
        Route::prefix('/admin/providers')->group(function () {
        Route::get('/', [AdminController::class, 'getProviders']);
        Route::post('/', [AdminController::class, 'addProvider']);
        Route::get('{id}', [AdminController::class, 'getProviderById']);
        Route::put('{id}', [AdminController::class, 'updateProvider']);
        Route::delete('{id}', [AdminController::class, 'deleteProvider']);
    });


        Route::get('/admin/customers', [AdminController::class, 'getCustomers']);
        Route::post('/admin/customers', [AdminController::class, 'createCustomer']);
        Route::put('/admin/customers/{id}', [AdminController::class, 'updateCustomer']);
        Route::delete('/admin/customers/{id}', [AdminController::class, 'deleteCustomer']);
    });

});
