<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Obtiene la instancia del modelo del producto desde la ruta
        $product = $this->route('product');

        return [
            'sku' => [
                'required',
                'string',
                'max:255',
                // Esta única regla maneja ambos casos (creación y actualización)
                Rule::unique('products')->ignore($product->id),
            ],
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'nullable|string',
            'descripcion_larga' => 'nullable|string',
            'imagen_url' => 'nullable|url',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'sku.required' => 'El SKU es obligatorio',
            'sku.unique' => 'Este SKU ya está registrado en el sistema',
            'nombre.required' => 'El nombre es obligatorio',
            'descripcion_corta.required' => 'La descripción corta es obligatoria',
            'descripcion_larga.required' => 'La descripción larga es obligatoria',
            'imagen_url.required' => 'La URL de la imagen es obligatoria',
            'imagen_url.url' => 'La URL de la imagen debe ser una URL válida',
            'precio_neto.required' => 'El precio neto es obligatorio',
            'precio_neto.numeric' => 'El precio neto debe ser un valor numérico',
            'stock_actual.required' => 'El stock actual es obligatorio',
            'stock_actual.integer' => 'El stock actual debe ser un número entero',
            'stock_minimo.required' => 'El stock mínimo es obligatorio',
            'stock_minimo.integer' => 'El stock mínimo debe ser un número entero',
            'stock_bajo.required' => 'El stock bajo es obligatorio',
            'stock_bajo.integer' => 'El stock bajo debe ser un número entero',
            'stock_alto.required' => 'El stock alto es obligatorio',
            'stock_alto.integer' => 'El stock alto debe ser un número entero',
        ];
    }
}