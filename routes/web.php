<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;

// Esta es la única ruta que maneja la página de inicio
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas del Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas del Mantenedor de Usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // <-- **Esta es la línea que falta**

    // Rutas del Mantenedor de Productos
    Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
    // ... Aquí puedes agregar las rutas para el CRUD de productos

    // Rutas del Mantenedor de Clientes
    Route::get('/clientes', [ClientController::class, 'index'])->name('clients.index');
    // ... Aquí puedes agregar las rutas para el CRUD de clientes
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';