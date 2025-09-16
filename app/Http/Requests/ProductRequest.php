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
        $rules = [
            'nombre' => 'required',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            'imagen_url' => 'required|url',
            'precio_neto' => 'required|numeric',
            'stock_actual' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'stock_bajo' => 'required|integer',
            'stock_alto' => 'required|integer',
        ];

        // Reglas específicas para creación o actualización
        if ($this->isMethod('POST')) {
            // Creación - SKU debe ser único
            $rules['sku'] = 'required|unique:products';
        } else {
            // Actualización - SKU debe ser único excepto para el registro actual
            $productId = $this->route('product') ? $this->route('product')->id : null;
            $rules['sku'] = [
                'required',
                Rule::unique('products')->ignore($productId)
            ];
        }

        return $rules;
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