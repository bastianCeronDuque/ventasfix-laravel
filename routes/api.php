<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AuthController;

// Rutas públicas para autenticación JWT
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

// Rutas protegidas por JWT
Route::middleware('auth.jwt')->prefix('api')->group(function () {
    // Rutas de gestión de token
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::get('auth/me', [AuthController::class, 'me']);

    // Rutas API para Usuarios (protegidas por JWT)
    Route::apiResource('users', UserController::class);

    // Rutas API para Productos
    Route::apiResource('products', ProductController::class);

    // Rutas API para Clientes
    Route::apiResource('clients', ClientController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});