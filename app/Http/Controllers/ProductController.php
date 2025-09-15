<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importa el modelo de Producto
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
    public function store(Request $request)
    {
        // Validación de datos según la rúbrica
        $request->validate([
            'sku' => 'required|unique:products',
            'nombre' => 'required',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            'imagen_del_producto' => 'required|url', // Asume una URL de imagen
            'precio_neto' => 'required|numeric',
            'precio_de_venta' => 'required|numeric',
            'stock_actual' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'stock_bajo' => 'required|integer',
            'stock_alto' => 'required|integer',
        ]);

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
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku,' . $product->id,
            'nombre' => 'required',
            // ... valida el resto de los campos de la misma manera
        ]);

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