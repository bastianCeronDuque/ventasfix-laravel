<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

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
        if (!$this->isValidRut($value)) {
            $fail('El :attribute no es un RUT chileno válido.');
        }
    }

    /**
     * Valida si un RUT chileno es válido
     *
     * @param string $rut
     * @return bool
     */
    private function isValidRut($rut)
    {
        // Limpiar el RUT (remover puntos, guiones y espacios)
        $rut = $this->cleanRut($rut);
        
        // Verificar que tenga al menos 2 caracteres (número + dígito verificador)
        if (strlen($rut) < 2) {
            return false;
        }

        // Separar el número del dígito verificador
        $rutNumber = substr($rut, 0, -1);
        $dv = strtoupper(substr($rut, -1));

        // Verificar que el número sea numérico
        if (!is_numeric($rutNumber)) {
            return false;
        }

        // Verificar que el dígito verificador sea válido (0-9 o K)
        if (!preg_match('/^[0-9K]$/', $dv)) {
            return false;
        }

        // Calcular el dígito verificador esperado
        $expectedDv = $this->calculateDv($rutNumber);

        return $dv === $expectedDv;
    }

    /**
     * Calcula el dígito verificador de un RUT
     *
     * @param string $rutNumber
     * @return string
     */
    private function calculateDv($rutNumber)
    {
        $sum = 0;
        $multiplier = 2;

        // Recorrer el RUT de derecha a izquierda
        for ($i = strlen($rutNumber) - 1; $i >= 0; $i--) {
            $sum += intval($rutNumber[$i]) * $multiplier;
            $multiplier = $multiplier === 7 ? 2 : $multiplier + 1;
        }

        $remainder = $sum % 11;
        $dv = 11 - $remainder;

        if ($dv === 11) {
            return '0';
        } elseif ($dv === 10) {
            return 'K';
        } else {
            return (string) $dv;
        }
    }

    /**
     * Limpia un RUT removiendo puntos, guiones y espacios
     *
     * @param string $rut
     * @return string
     */
    private function cleanRut($rut)
    {
        return preg_replace('/[^0-9kK]/', '', $rut);
    }

    /**
     * Formatea un RUT para mostrar (con puntos y guión)
     *
     * @param  string  $rut
     * @return string
     */
    public static function formatear($rut)
    {
        $cleanRut = preg_replace('/[^0-9kK]/', '', $rut);
        
        if (strlen($cleanRut) < 2) {
            return $rut;
        }

        $rutNumber = substr($cleanRut, 0, -1);
        $dv = strtoupper(substr($cleanRut, -1));

        // Agregar puntos cada 3 dígitos desde la derecha
        $formattedNumber = '';
        $rutReversed = strrev($rutNumber);
        
        for ($i = 0; $i < strlen($rutReversed); $i++) {
            if ($i > 0 && $i % 3 === 0) {
                $formattedNumber = '.' . $formattedNumber;
            }
            $formattedNumber = $rutReversed[$i] . $formattedNumber;
        }

        return $formattedNumber . '-' . $dv;
    }

    /**
     * Formatea un RUT para guardar (sin puntos ni guión)
     *
     * @param  string  $rut
     * @return string
     */
    public static function formatearParaGuardar($rut)
    {
        return preg_replace('/[^0-9kK]/', '', $rut);
    }
}