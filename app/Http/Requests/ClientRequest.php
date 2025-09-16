<?php

namespace App\Http\Requests;

use App\Rules\ValidRutChileno;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'rubro' => 'required|string|max:150',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string|max:255',
        ];

        // Reglas específicas para creación o actualización
        if ($this->isMethod('POST')) {
            // Creación - RUT y email deben ser únicos
            $rules['rut_empresa'] = ['required', 'unique:clients', new ValidRutChileno];
            $rules['email_contacto'] = 'required|email|unique:clients';
        } else {
            // Actualización - RUT y email deben ser únicos excepto para el registro actual
            $rules['rut_empresa'] = [
                'required', 
                Rule::unique('clients')->ignore($this->route('client')),
                new ValidRutChileno
            ];
            $rules['email_contacto'] = [
                'required',
                'email',
                Rule::unique('clients')->ignore($this->route('client'))
            ];
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Limpiar el RUT antes de la validación (opcional)
        if ($this->has('rut_empresa')) {
            $this->merge([
                'rut_empresa' => str_replace(['.', ','], '', $this->rut_empresa)
            ]);
        }
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'rut_empresa.required' => 'El RUT de la empresa es obligatorio',
            'rut_empresa.unique' => 'Este RUT ya está registrado en el sistema',
            'rubro.required' => 'El rubro es obligatorio',
            'razon_social.required' => 'La razón social es obligatoria',
            'telefono.required' => 'El teléfono es obligatorio',
            'direccion.required' => 'La dirección es obligatoria',
            'nombre_contacto.required' => 'El nombre de contacto es obligatorio',
            'email_contacto.required' => 'El email de contacto es obligatorio',
            'email_contacto.email' => 'El formato del email de contacto no es válido',
            'email_contacto.unique' => 'Este email de contacto ya está registrado en el sistema',
        ];
    }
}