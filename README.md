# VentasFix

VentasFix es una aplicación web desarrollada con Laravel que permite gestionar un sistema de ventas moderno y eficiente. La aplicación está diseñada para trabajar con una interfaz gráfica de usuario, gestionar trabajadores y permitir la interacción con aplicaciones de terceros mediante APIs.  

![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)
![JWT](https://img.shields.io/badge/JWT-Auth-green.svg)
![MVC](https://img.shields.io/badge/Pattern-MVC-orange.svg)

## Arquitectura MVC

VentasFix implementa el patrón Modelo-Vista-Controlador (MVC):

### 📊 Modelo (Model)

-   Clases que encapsulan datos y lógica de negocio
-   Relaciones entre entidades (User-Ventas)
-   Validación de datos y reglas de negocio
-   Interacción con base de datos MySQL

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

-   **Autenticación Híbrida**: JWT para API, sesiones para web
-   **CRUD completo**: Crear, Leer, Actualizar y Eliminar registros
-   **Dashboard**: EEstadísticas y registros recientes
-   **API REST**: Endpoints protegidos con JWT
-   **Componentes Externos**: Integración con API Softland

## Tecnologías

-   **Backend**: Laravel 12.x, PHP 8.2+
-   **Base de Datos**: MySQL
-   **Frontend**: Vuexy Template, Bootstrap 5, JavaScript, Blade Templates  
-   **Plugins**: jQuery, Tabler Icons, Perfect Scrollbar, Hammer.js, Waves, Typeahead.js
-   **Autenticación**: JWT (tymon/jwt-auth)
-   **Build Tools**: Vite / Laravel Mix  

## Instalación

```bash
# Clonar e instalar
git clone https://github.com/bastianCeronDuque/ventasfix-laravel.git
cd ventasfix-laravel
composer install
npm install

# Configurar
cp .env.example .env
php artisan key:generate

# Base de datos
php artisan migrate

# Compilar y ejecutar
npm run build
php artisan serve
```

## Estructura MVC

```
app/
├── Models/                    # MODELO
│   ├── User.php
│   └── Project.php
│
├── Http/Controllers/          # CONTROLADOR
│   ├── AuthController.php
│   ├── ProjectController.php
│   └── DashboardController.php
│
├── Http/Middleware/
│   └── JwtMiddleware.php
│
└── Services/
    └── BancoCentralApiService.php

resources/
└── views/                     # VISTA
    ├── layouts/app.blade.php
    ├── dashboard.blade.php
    ├── login.blade.php
    ├── register.blade.php
    ├── components/            # Componentes reutilizables
    │   └── uf-value.blade.php
    └── projects/              # CRUD views
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        └── show.blade.php
```

## Flujo MVC en TechSolutions

1. **Request**: Usuario envía una solicitud (ej. crear venta)
2. **Router**: La ruta dirige la solicitud al controlador adecuado
3. **Controller**: Valida datos, interactúa con modelos y determina respuesta
4. **Model**: Aplica reglas de negocio y actualiza la base de datos
5. **Response**: Controlador devuelve vista (web) o JSON (API)

## API Endpoints

```http
# Autenticación
POST /api/register     # Registro de usuario
POST /api/login        # Inicio de sesión (devuelve JWT)
GET  /api/me           # Perfil del usuario (requiere auth)
POST /api/logout       # Cerrar sesión

# Gestión de Proyectos (CRUD)
GET    /api/projects       # Listar proyectos del usuario
POST   /api/projects       # Crear nuevo proyecto
GET    /api/projects/{id}  # Ver proyecto específico
PUT    /api/projects/{id}  # Actualizar proyecto
DELETE /api/projects/{id}  # Eliminar proyecto
```

## Ventajas del Patrón MVC

-   **Separación de Responsabilidades**: Código organizado y mantenible
-   **Testabilidad**: Capas independientes facilitan pruebas unitarias
-   **Reutilización**: Componentes independientes y reutilizables
-   **Escalabilidad**: Fácil expansión de funcionalidades
-   **Mantenibilidad**: Cambios localizados sin afectar otras partes

# Clonar e instalar

git clone https://github.com/bastianCeronDuque/techsolutions.git
cd techsolutions
composer install
npm install

# Configurar

cp .env.example .env
php artisan key:generate
php artisan jwt:secret

# Base de datos

php artisan migrate

# Compilar y ejecutar

npm run build
php artisan serve

````

## Uso

1. **Register**: Ve a `/register` y crea una cuenta
2. **Login**: Accede en `/login` con tus credenciales
3. **Dashboard**: Accede automáticamente tras login exitoso
4. **CRUD**: Gestiona ventas desde interfaz

## API Endpoints

```http
# Autenticación
POST /api/register     # Registro de usuario
POST /api/login        # Inicio de sesión
GET  /api/me           # Perfil del usuario (requiere auth)
POST /api/logout       # Cerrar sesión

# Gestión de Ventas (CRUD)
GET    /api/ventas         # Listar ventas
POST   /api/ventas         # Crear nueva venta
GET    /api/ventas/{id}    # Ver venta específica
PUT    /api/ventas/{id}    # Actualizar venta
DELETE /api/ventas/{id}    # Eliminar venta
````

## Estructura

```
app/
├── Models/                    # MODELO
│   ├── User.php
│   └── Venta.php
│
├── Http/Controllers/          # CONTROLADOR
│   ├── AuthController.php
│   ├── VentaController.php
│   └── DashboardController.php
│
├── Http/Middleware/
│   └── JwtMiddleware.php
resources/
└── views/                     # VISTA
    ├── layouts/app.blade.php
    ├── dashboard.blade.php
    ├── login.blade.php
    ├── register.blade.php
    ├── components/            # Componentes reutilizables
    └── ventas/                # CRUD views
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        └── show.blade.php
public/
├── assets/
│   ├── vendor/       # jQuery, Bootstrap, Tabler Icons, plugins
│   └── json/
│       ├── search-vertical.json
│       └── locales/
│           └── en.json
routes/
├── web.php
└── api.php

```

## Seguridad

-   Cookies HttpOnly (protección XSS)
-   Contraseñas hasheadas con bcrypt
-   Validación robusta de datos
-   Protección CSRF
-   Tokens con múltiples fuentes

## Autores

**Bastián Cerón Duque**  
GitHub: [@bastianCeronDuque](https://github.com/bastianCeronDuque)

**Felipe Morales Roa**  
GitHub: [@felipeDev303](https://github.com/felipeDev303)
