<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Asegúrate de importar tu modelo de Producto

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'sku' => 'PROD-001',
            'nombre' => 'Laptop Gamer',
            'descripcion_corta' => 'Potente laptop para gaming',
            'descripcion_larga' => 'Laptop de alto rendimiento con procesador de última generación y tarjeta gráfica dedicada.',
            'imagen_url' => 'https://example.com/images/laptop_gamer.jpg',
            'precio_neto' => 1200.00,
            'stock_actual' => 50,
            'stock_minimo' => 5,
            'stock_bajo' => 10,
            'stock_alto' => 100
        ]);

        Product::create([
            'sku' => 'PROD-002',
            'nombre' => 'Teclado Mecánico',
            'descripcion_corta' => 'Teclado con switches mecánicos',
            'descripcion_larga' => 'Teclado ergonómico con retroiluminación RGB y switches de alta durabilidad.',
            'imagen_url' => 'https://example.com/images/teclado_mecanico.jpg',
            'precio_neto' => 85.00,
            'stock_actual' => 150,
            'stock_minimo' => 10,
            'stock_bajo' => 20,
            'stock_alto' => 200
        ]);

        Product::create([
            'sku' => 'PROD-003',
            'nombre' => 'Mouse Inalámbrico',
            'descripcion_corta' => 'Mouse de alta precisión sin cables',
            'descripcion_larga' => 'Mouse ligero y preciso con batería de larga duración y botones programables.',
            'imagen_url' => 'https://example.com/images/mouse_inalambrico.jpg',
            'precio_neto' => 45.50,
            'stock_actual' => 200,
            'stock_minimo' => 15,
            'stock_bajo' => 30,
            'stock_alto' => 250
        ]);

        Product::create([
            'sku' => 'PROD-004',
            'nombre' => 'Monitor 4K',
            'descripcion_corta' => 'Monitor de alta resolución',
            'descripcion_larga' => 'Monitor de 27 pulgadas con resolución 4K UHD, ideal para diseñadores y gamers.',
            'imagen_url' => 'https://example.com/images/monitor_4k.jpg',
            'precio_neto' => 450.00,
            'stock_actual' => 75,
            'stock_minimo' => 8,
            'stock_bajo' => 15,
            'stock_alto' => 120
        ]);

        Product::create([
            'sku' => 'PROD-005',
            'nombre' => 'Webcam Full HD',
            'descripcion_corta' => 'Webcam para videollamadas',
            'descripcion_larga' => 'Webcam con calidad Full HD y micrófono integrado para transmisiones y videollamadas.',
            'imagen_url' => 'https://example.com/images/webcam_hd.jpg',
            'precio_neto' => 60.00,
            'stock_actual' => 90,
            'stock_minimo' => 10,
            'stock_bajo' => 25,
            'stock_alto' => 150
        ]);
    }
}