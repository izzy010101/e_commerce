<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CrosMiddleware;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}/products', [ProductController::class, 'getByCategory']);
Route::get('/products', [ProductController::class, 'index']);

// User authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes with Sanctum
Route::middleware([CrosMiddleware::class])->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::put('/password/update', [PasswordController::class, 'update']);
        Route::put('/profile/update', [ProfileController::class, 'update']);
        Route::middleware('auth:sanctum')->delete('/profile/delete_user', [ProfileController::class, 'delete_user']);
        Route::delete('/profile/delete', [ProfileController::class, 'destroy']);
        Route::post('/orders', [OrderController::class, 'store']);

    });
});
