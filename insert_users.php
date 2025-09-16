<?php

// Configuración de la conexión a la base de datos desde .env
$host = '127.0.0.1';
$db   = 'ventasfix_laravel_db';
$user = 'ventasfix_laravel_user';
$pass = 'secure_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Conectar a la base de datos
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    echo "Conexión exitosa a la base de datos.\n";
    
    // Hash de contraseña 'password123'
    $password = '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS'; // bcrypt de 'password123'
    $now = date('Y-m-d H:i:s');
    
    // Insertar usuarios administradores
    $adminUsers = [
        [
            'rut' => '111111111',
            'nombre' => 'Admin',
            'apellido' => 'Principal',
            'email' => 'admin.principal@ventasfix.cl',
        ],
        [
            'rut' => '123456785',
            'nombre' => 'Gerente',
            'apellido' => 'Ventas',
            'email' => 'gerente.ventas@ventasfix.cl',
        ],
        [
            'rut' => '157894568',
            'nombre' => 'Super',
            'apellido' => 'Visor',
            'email' => 'super.visor@ventasfix.cl',
        ]
    ];
    
    // Insertar usuarios de prueba
    $testUsers = [
        [
            'rut' => '93456781',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@ventasfix.cl',
        ],
        [
            'rut' => '16532987K',
            'nombre' => 'Pedro',
            'apellido' => 'González',
            'email' => 'pedro.gonzalez@ventasfix.cl',
        ],
        [
            'rut' => '181234569',
            'nombre' => 'María',
            'apellido' => 'Muñoz',
            'email' => 'maria.munoz@ventasfix.cl',
        ],
        [
            'rut' => '204215687',
            'nombre' => 'Ana',
            'apellido' => 'Rodríguez',
            'email' => 'ana.rodriguez@ventasfix.cl',
        ],
        [
            'rut' => '76543213',
            'nombre' => 'Luis',
            'apellido' => 'Silva',
            'email' => 'luis.silva@ventasfix.cl',
        ]
    ];
    
    // Preparar la consulta SQL
    $stmt = $pdo->prepare("
        INSERT INTO users (rut, nombre, apellido, email, password, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    
    // Insertar usuarios administradores
    foreach ($adminUsers as $user) {
        $stmt->execute([
            $user['rut'],
            $user['nombre'],
            $user['apellido'],
            $user['email'],
            $password,
            $now,
            $now
        ]);
    }
    
    echo "Usuarios administradores insertados correctamente.\n";
    
    // Insertar usuarios de prueba
    foreach ($testUsers as $user) {
        $stmt->execute([
            $user['rut'],
            $user['nombre'],
            $user['apellido'],
            $user['email'],
            $password,
            $now,
            $now
        ]);
    }
    
    echo "Usuarios de prueba insertados correctamente.\n";
    echo "Total de usuarios insertados: " . count($adminUsers) + count($testUsers) . "\n";
    
} catch (\PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}