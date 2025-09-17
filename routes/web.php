<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas del Mantenedor de Usuarios (CRUD completo)
    Route::resource('usuarios', UserController::class)->names('users');

    // Rutas del Mantenedor de Productos
    Route::resource('productos', ProductController::class)
        ->names('products')
        ->parameters(['productos' => 'product']);


    // Rutas del Mantenedor de Clientes
    Route::resource('clientes', ClientController::class)
        ->names('clients')
        ->parameters(['clientes' => 'client']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';