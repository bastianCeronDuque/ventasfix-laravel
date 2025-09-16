<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importa el modelo de Producto
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Método para mostrar la lista de todos los productos
    public function index()
    {
        $products = Product::all();
        return view('productos.index', compact('products'));
    }

    // Método para mostrar el formulario de creación de un nuevo producto
    public function create()
    {
        return view('productos.create');
    }

    // Método para guardar un nuevo producto en la base de datos
    public function store(ProductRequest $request)
    {
        // Los datos ya están validados por el ProductRequest
        Product::create($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    // Método para mostrar los detalles de un producto específico
    public function show(Product $product)
    {
        return view('productos.show', compact('product'));
    }

    // Método para mostrar el formulario de edición de un producto
    public function edit(Product $product)
    {
        return view('productos.edit', compact('product'));
    }

    // Método para actualizar un producto en la base de datos
    public function update(ProductRequest $request, Product $product)
    {
        // Los datos ya están validados por el ProductRequest
        $product->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    // Método para eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}