<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

// Public routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}/products', [ProductController::class, 'getByCategory']);
Route::get('/products', [ProductController::class, 'index']);

// User authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
