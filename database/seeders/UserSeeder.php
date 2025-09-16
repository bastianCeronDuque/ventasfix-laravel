<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos usuarios administrativos predefinidos
        $this->createAdminUsers();
        
        // Creamos algunos usuarios de prueba adicionales
        $this->createTestUsers();
    }

    /**
     * Crea usuarios administrativos predefinidos
     */
    private function createAdminUsers(): void
    {
        // Administrador principal
        User::create([
            'rut' => '111111111', // 11.111.111-1 sin formato
            'nombre' => 'Admin',
            'apellido' => 'Principal',
            'email' => 'admin.principal@ventasfix.cl',
            'password' => Hash::make('password123'),
        ]);

        // Gerente de Ventas
        User::create([
            'rut' => '123456785', // 12.345.678-5 sin formato
            'nombre' => 'Gerente',
            'apellido' => 'Ventas',
            'email' => 'gerente.ventas@ventasfix.cl',
            'password' => Hash::make('password123'),
        ]);

        // Supervisor
        User::create([
            'rut' => '157894568', // 15.789.456-8 sin formato
            'nombre' => 'Super',
            'apellido' => 'Visor',
            'email' => 'super.visor@ventasfix.cl',
            'password' => Hash::make('password123'),
        ]);
    }

    /**
     * Crea usuarios de prueba
     */
    private function createTestUsers(): void
    {
        // Lista de RUTs chilenos válidos (sin formato)
        $ruts = [
            '93456781',  // 9.345.678-1
            '16532987K', // 16.532.987-K
            '181234569', // 18.123.456-9
            '204215687', // 20.421.568-7
            '76543213',  // 7.654.321-3
        ];

        // Lista de nombres y apellidos
        $nombres = ['Juan', 'Pedro', 'María', 'Ana', 'Luis'];
        $apellidos = ['Pérez', 'González', 'Muñoz', 'Rodríguez', 'Silva'];
        
        // Crear usuarios con los datos anteriores
        for ($i = 0; $i < 5; $i++) {
            $nombre = $nombres[$i];
            $apellido = $apellidos[$i];
            
            User::create([
                'rut' => $ruts[$i],
                'nombre' => $nombre,
                'apellido' => $apellido,
                'email' => strtolower($nombre) . '.' . strtolower($apellido) . '@ventasfix.cl',
                'password' => Hash::make('password123'),
            ]);
        }
    }
}