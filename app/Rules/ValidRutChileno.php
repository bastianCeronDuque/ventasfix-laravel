<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Freshwork\ChileanBundle\Rut as ChileanRut;

class ValidRutChileno implements ValidationRule
{
    /**
     * Determina si el RUT chileno es válido.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            // Intenta crear una instancia de Rut con el valor proporcionado
            $rut = new ChileanRut($value);
            
            // Verifica si el RUT es válido
            if (!$rut->isValid()) {
                $fail('El :attribute no es válido.');
            }
        } catch (\Exception $e) {
            $fail('El formato del :attribute no es válido.');
        }
    }

    /**
     * Formatea un RUT para mostrar (con puntos y guión)
     *
     * @param  string  $rut
     * @return string
     */
    public static function formatear($rut)
    {
        try {
            return (new ChileanRut($rut))->format(ChileanRut::FORMAT_WITH_DASH);
        } catch (\Exception $e) {
            return $rut;
        }
    }

    /**
     * Formatea un RUT para guardar (sin puntos ni guión)
     *
     * @param  string  $rut
     * @return string
     */
    public static function formatearParaGuardar($rut)
    {
        try {
            return (new ChileanRut($rut))->format(ChileanRut::FORMAT_ESCAPED);
        } catch (\Exception $e) {
            return $rut;
        }
    }
}