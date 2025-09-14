<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ClientController;

// ... (el código predeterminado que pegaste antes)

Route::middleware('auth:sanctum')->group(function () {
    // Rutas API para Usuarios (ya tienes un controlador)
    Route::apiResource('users', UserController::class);

    // Rutas API para Productos
    Route::apiResource('products', ProductController::class);

    // Rutas API para Clientes
    Route::apiResource('clients', ClientController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});