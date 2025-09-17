# VentasFix

VentasFix es una aplicación web desarrollada con Laravel 12 que permite gestionar un sistema de ventas moderno y eficiente. La aplicación está diseñada con arquitectura MVC, interfaz web con template Vuexy, y API REST completa con autenticación JWT para integración con aplicaciones de terceros.

![Laravel](https://img.shields.io/badge/Laravel-12.24.0-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2.29-blue.svg)
![JWT](https://img.shields.io/badge/JWT-Auth-green.svg)
![MVC](https://img.shields.io/badge/Pattern-MVC-orange.svg)
![API](https://img.shields.io/badge/API-REST-blue.svg)
![MySQL](https://img.shields.io/badge/Database-MySQL_8.0.30-blue.svg)

## Arquitectura MVC

VentasFix implementa el patrón Modelo-Vista-Controlador (MVC):

### 📊 Modelo (Model)

-   Clases que encapsulan datos y lógica de negocio
-   Relaciones entre entidades (User-Products-Clients)
-   Validación de datos y reglas de negocio
-   Interacción con base de datos MySQL 8.0.30

### 🎨 Vista (View)

-   Interfaces de usuario usando Blade Templates
-   Separación clara de lógica de presentación
-   Componentes reutilizables
-   Validación en tiempo real con JavaScript

### 🧠 Controlador (Controller)

-   Manejo de solicitudes HTTP
-   Validación de entradas
-   Coordinación entre Modelos y Vistas
-   Respuestas diferenciadas (web/API)

## Características Principales

-   **Gestión Completa de Ventas**: Sistema integral para manejo de productos, clientes y usuarios
-   **Autenticación Híbrida**: JWT para API, sesiones web para interfaz administrativa
-   **API REST Completa**: Endpoints protegidos con autenticación JWT
-   **CRUD Completo**: Operaciones completas para todos los recursos
-   **Dashboard Administrativo**: Estadísticas y gestión centralizada
-   **Validación RUT Chileno**: Validación especializada para documentos chilenos
-   **Template Vuexy**: Interfaz moderna y responsiva
-   **Seguridad Avanzada**: Middleware JWT, validación de datos, protección CSRF

## Tecnologías

-   **Backend**: Laravel 12.24.0, PHP 8.2.29
-   **Base de Datos**: MySQL 8.0.30 con migraciones y seeders
-   **Frontend**: Vuexy Admin Template, Bootstrap 5, JavaScript, Blade Templates
-   **Autenticación**: JWT (tymon/jwt-auth) para API, Laravel Auth para web
-   **Herramientas**: Vite, Composer 2.8.9, npm
-   **Validación**: FormRequest classes, reglas personalizadas RUT
-   **Arquitectura**: Patrón MVC, separación API/Web controllers

## Instalación

```bash
# Clonar el repositorio
git clone https://github.com/bastianCeronDuque/ventasfix-laravel.git
cd ventasfix-laravel

# Instalar dependencias
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate
php artisan jwt:secret

# Configurar base de datos (MySQL)
# Edita .env con tus credenciales de BD
php artisan migrate
php artisan db:seed

# Compilar assets y ejecutar
npm run build
php artisan serve
```

## Configuración de Base de Datos

Configura tu archivo `.env` con los datos de MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ventasfix_laravel_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password

JWT_SECRET=tu_jwt_secret_generado
JWT_TTL=60
JWT_REFRESH_TTL=20160
```

## Información del Sistema

**Versiones actuales instaladas:**

-   Laravel Framework: 12.24.0
-   PHP: 8.2.29
-   MySQL: 8.0.30
-   Composer: 2.8.9
-   Node.js: Para compilación de assets con Vite

### Comandos de Verificación

```bash
# Verificar versión de Laravel
php artisan --version

# Información completa del sistema
php artisan about

# Versión de PHP
php --version

# Versión de la base de datos
php artisan tinker --execute="use Illuminate\Support\Facades\DB; echo 'MySQL Version: ' . DB::select('SELECT VERSION() as version')[0]->version;"
```

## Estructura del Proyecto

```
app/
├── Models/                    # MODELOS
│   ├── User.php              # Gestión de usuarios con JWT
│   ├── Product.php           # Catálogo de productos
│   └── Client.php            # Base de clientes
│
├── Http/Controllers/          # CONTROLADORES
│   ├── Api/                  # API Controllers
│   │   ├── AuthController.php     # Autenticación JWT
│   │   ├── UserController.php     # CRUD usuarios API
│   │   ├── ProductController.php  # CRUD productos API
│   │   └── ClientController.php   # CRUD clientes API
│   │
│   ├── Web/                  # Web Controllers
│   │   ├── DashboardController.php
│   │   ├── ProductController.php  # CRUD productos web
│   │   ├── ClientController.php   # CRUD clientes web
│   │   └── UserController.php     # CRUD usuarios web
│   │
│   ├── Middleware/
│   │   └── JwtMiddleware.php      # Middleware JWT personalizado
│   │
│   └── Requests/
│       ├── ProductRequest.php     # Validación productos
│       ├── ClientRequest.php      # Validación clientes
│       └── UserRequest.php        # Validación usuarios
│
├── Rules/
│   └── ValidRutChileno.php   # Validación RUT chileno
│
└── View/
    └── Components/           # Componentes Blade

resources/
└── views/                    # VISTAS (Vuexy Template)
    ├── layouts/
    │   └── app.blade.php     # Layout principal Vuexy
    ├── auth/                 # Autenticación
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── dashboard.blade.php   # Dashboard principal
    ├── products/             # CRUD Productos
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   ├── edit.blade.php
    │   └── show.blade.php
    ├── clients/              # CRUD Clientes
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   ├── edit.blade.php
    │   └── show.blade.php
    └── users/                # CRUD Usuarios
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        └── show.blade.php

database/
├── migrations/               # Estructura de BD
│   ├── create_users_table.php
│   ├── create_products_table.php
│   └── create_clients_table.php
└── seeders/                  # Datos iniciales
    ├── UserSeeder.php        # Usuarios de prueba
    └── ProductSeeder.php     # Productos de prueba

routes/
├── web.php                   # Rutas web (interfaz admin)
└── api.php                   # Rutas API (JWT protegidas)
```

## Flujo MVC en VentasFix

1. **Request**: Usuario envía una solicitud (ej. crear venta)
2. **Router**: La ruta dirige la solicitud al controlador adecuado
3. **Controller**: Valida datos, interactúa con modelos y determina respuesta
4. **Model**: Aplica reglas de negocio y actualiza la base de datos
5. **Response**: Controlador devuelve vista (web) o JSON (API)

## API Endpoints

### Autenticación JWT

```http
# Autenticación
POST   /api/auth/register     # Registro de usuario
POST   /api/auth/login        # Login (devuelve JWT token)
POST   /api/auth/logout       # Logout (invalida token)
POST   /api/auth/refresh      # Renovar token
GET    /api/auth/me           # Información del usuario autenticado
GET    /api/user              # Usuario actual (alias)
```

### Recursos Protegidos (Requieren JWT)

```http
# Gestión de Usuarios
GET    /api/users             # Listar usuarios
POST   /api/users             # Crear usuario
GET    /api/users/{id}        # Ver usuario específico
PUT    /api/users/{id}        # Actualizar usuario
DELETE /api/users/{id}        # Eliminar usuario

# Gestión de Productos
GET    /api/products          # Listar productos
POST   /api/products          # Crear producto
GET    /api/products/{id}     # Ver producto específico
PUT    /api/products/{id}     # Actualizar producto
DELETE /api/products/{id}     # Eliminar producto

# Gestión de Clientes
GET    /api/clients           # Listar clientes
POST   /api/clients           # Crear cliente
GET    /api/clients/{id}      # Ver cliente específico
PUT    /api/clients/{id}      # Actualizar cliente
DELETE /api/clients/{id}      # Eliminar cliente
```

### Ejemplo de Uso

```bash
# 1. Obtener token de acceso
curl -X POST http://tu-dominio.test/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin.principal@ventasfix.cl","password":"password123"}'

# 2. Usar token en requests protegidos
curl -X GET http://tu-dominio.test/api/products \
  -H "Authorization: Bearer tu_token_jwt_aqui"

# 3. Crear un nuevo producto
curl -X POST http://tu-dominio.test/api/products \
  -H "Authorization: Bearer tu_token_jwt_aqui" \
  -H "Content-Type: application/json" \
  -d '{"sku":"PROD-123","nombre":"Nuevo Producto","precio_neto":99.99}'
```

## Flujo MVC en VentasFix

1. **Request**: Usuario envía solicitud (web o API)
2. **Router**: Dirige la solicitud al controlador apropiado (Web o API)
3. **Controller**: Valida datos, interactúa con modelos
4. **Model**: Aplica lógica de negocio y actualiza base de datos
5. **Response**: Retorna vista Blade (web) o JSON (API)

## Ventajas del Patrón MVC

-   **Separación de Responsabilidades**: Código organizado y mantenible
-   **Testabilidad**: Capas independientes facilitan pruebas unitarias
-   **Reutilización**: Componentes independientes y reutilizables
-   **Escalabilidad**: Fácil expansión de funcionalidades
-   **Mantenibilidad**: Cambios localizados sin afectar otras partes

## Características de Seguridad

-   **Autenticación JWT**: Tokens seguros para API
-   **Validación de datos**: FormRequest classes con reglas personalizadas
-   **Validación RUT**: Regla personalizada para documentos chilenos
-   **Protección CSRF**: Para formularios web
-   **Middleware personalizado**: Control de acceso granular
-   **Passwords hasheadas**: Bcrypt para contraseñas seguras

## Uso de la Aplicación

### Interfaz Web (Vuexy Template)

1. Accede a `http://tu-dominio.test`
2. Login con credenciales: `admin.principal@ventasfix.cl` / `password123`
3. Usa el dashboard para gestionar productos, clientes y usuarios
4. CRUD completo disponible para todos los recursos

### API REST

1. Obtén token JWT mediante `POST /api/auth/login`
2. Incluye token en header: `Authorization: Bearer {token}`
3. Accede a endpoints protegidos para operaciones CRUD
4. Consulta documentación de endpoints arriba

## Usuarios de Prueba

El seeder incluye usuarios predefinidos:

-   **Admin**: admin.principal@ventasfix.cl / password123
-   **Gerente**: gerente.ventas@ventasfix.cl / password123
-   **Supervisor**: super.visor@ventasfix.cl / password123

## Estado del Proyecto

✅ **Completado:**

-   Autenticación híbrida (Web + JWT API)
-   CRUD completo para Users, Products, Clients
-   Validación RUT chileno personalizada
-   Template Vuexy implementado
-   API REST funcional con todos los endpoints
-   Base de datos MySQL 8.0.30 con seeders
-   Middleware JWT personalizado

🚀 **Listo para:**

-   Integración con aplicaciones móviles
-   Consumo desde frontend SPA (React/Vue)
-   Integración con sistemas terceros
-   Escalamiento horizontal

## Autores

**Bastián Cerón Duque**  
GitHub: [@bastianCeronDuque](https://github.com/bastianCeronDuque)

**Felipe Morales Roa**  
GitHub: [@felipeDev303](https://github.com/felipeDev303)
