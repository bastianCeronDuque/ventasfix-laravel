<?php

namespace App\Http\Requests;

use App\Rules\ValidRutChileno;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => [
                'required',
                'email',
                'regex:/^[a-z]+\.[a-z]+@ventasfix\.cl$/i'
            ],
        ];

        // Reglas específicas para creación o actualización
        if ($this->isMethod('POST')) {
            // Creación - RUT y email deben ser únicos, password obligatorio
            $rules['rut'] = ['required', 'unique:users', new ValidRutChileno];
            $rules['email'][] = 'unique:users';
            $rules['password'] = 'required|string|min:8|confirmed';
        } else {
            // Actualización - RUT y email deben ser únicos excepto para el registro actual
            $userId = $this->route('user');
            $rules['rut'] = [
                'required', 
                Rule::unique('users')->ignore($userId),
                new ValidRutChileno
            ];
            $rules['email'][] = Rule::unique('users')->ignore($userId);
            
            // Password opcional en actualización
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Limpiar el RUT antes de la validación
        if ($this->has('rut')) {
            $this->merge([
                'rut' => str_replace(['.', ','], '', $this->rut)
            ]);
        }
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'rut.required' => 'El RUT es obligatorio',
            'rut.unique' => 'Este RUT ya está registrado en el sistema',
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El formato del email no es válido',
            'email.unique' => 'Este email ya está registrado en el sistema',
            'email.regex' => 'El email debe tener el formato nombre.apellido@ventasfix.cl',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'La confirmación de la contraseña no coincide',
        ];
    }
}