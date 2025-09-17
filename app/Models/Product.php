<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'sku', 
        'nombre', 
        'descripcion_corta', 
        'descripcion_larga',
        'imagen_url', 
        'precio_neto', 
        'stock_actual', 
        'stock_minimo', 
        'stock_bajo', 
        'stock_alto'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precio_neto' => 'decimal:2',
        'stock_actual' => 'integer',
        'stock_minimo' => 'integer',
        'stock_bajo' => 'integer',
        'stock_alto' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<string>
     */
    protected $appends = ['precio_venta'];

    /**
     * Get the precio_venta attribute.
     *
     * @return float
     */
    public function getPrecioVentaAttribute()
    {
        // Asegúrate que el precio_neto sea un valor válido antes de hacer el cálculo
        $precioNeto = floatval($this->precio_neto);
        return round($precioNeto * 1.19, 2);
    }

    /**
     * Check if the product has low stock.
     *
     * @return bool
     */
    public function hasLowStock()
    {
        return $this->stock_actual <= $this->stock_bajo;
    }
}
