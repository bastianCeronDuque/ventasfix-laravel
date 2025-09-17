<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => 'required|string|unique:products|max:50',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:500',
            'descripcion_larga' => 'required|string',
            'imagen_url' => 'required|url|max:500',
            'precio_neto' => 'required|numeric|min:0|max:99999999.99',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Validación adicional para stock_bajo < stock_alto
        if ($request->stock_bajo >= $request->stock_alto) {
            return response()->json([
                'status' => 'error',
                'message' => 'El stock bajo debe ser menor que el stock alto'
            ], 422);
        }

        // Validación adicional para stock_minimo <= stock_bajo
        if ($request->stock_minimo > $request->stock_bajo) {
            return response()->json([
                'status' => 'error',
                'message' => 'El stock mínimo debe ser menor o igual que el stock bajo'
            ], 422);
        }

        $product = Product::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Producto creado exitosamente',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'sku' => 'string|unique:products,sku,' . $id . '|max:50',
            'nombre' => 'string|max:255',
            'descripcion_corta' => 'string|max:500',
            'descripcion_larga' => 'string',
            'imagen_url' => 'url|max:500',
            'precio_neto' => 'numeric|min:0|max:99999999.99',
            'stock_actual' => 'integer|min:0',
            'stock_minimo' => 'integer|min:0',
            'stock_bajo' => 'integer|min:0',
            'stock_alto' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Determinar los valores para validaciones adicionales
        $stock_bajo = $request->has('stock_bajo') ? $request->stock_bajo : $product->stock_bajo;
        $stock_alto = $request->has('stock_alto') ? $request->stock_alto : $product->stock_alto;
        $stock_minimo = $request->has('stock_minimo') ? $request->stock_minimo : $product->stock_minimo;

        // Validación adicional para stock_bajo < stock_alto
        if ($stock_bajo >= $stock_alto) {
            return response()->json([
                'status' => 'error',
                'message' => 'El stock bajo debe ser menor que el stock alto'
            ], 422);
        }

        // Validación adicional para stock_minimo <= stock_bajo
        if ($stock_minimo > $stock_bajo) {
            return response()->json([
                'status' => 'error',
                'message' => 'El stock mínimo debe ser menor o igual que el stock bajo'
            ], 422);
        }

        $product->update($request->all());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Producto actualizado exitosamente',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }
        
        $product->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado exitosamente'
        ]);
    }
}
