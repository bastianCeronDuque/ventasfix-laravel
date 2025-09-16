-- Script para insertar usuarios de prueba en la base de datos

-- Limpiamos la tabla de usuarios (opcional, comentar si no se desea)
-- TRUNCATE TABLE users;

-- Insertamos usuarios administradores
INSERT INTO users (rut, nombre, apellido, email, password, created_at, updated_at)
VALUES 
('111111111', 'Admin', 'Principal', 'admin.principal@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW()),
('123456785', 'Gerente', 'Ventas', 'gerente.ventas@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW()),
('157894568', 'Super', 'Visor', 'super.visor@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW());

-- Insertamos usuarios de prueba
INSERT INTO users (rut, nombre, apellido, email, password, created_at, updated_at)
VALUES 
('93456781', 'Juan', 'Pérez', 'juan.perez@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW()),
('16532987K', 'Pedro', 'González', 'pedro.gonzalez@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW()),
('181234569', 'María', 'Muñoz', 'maria.muñoz@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW()),
('204215687', 'Ana', 'Rodríguez', 'ana.rodriguez@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW()),
('76543213', 'Luis', 'Silva', 'luis.silva@ventasfix.cl', '$2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS', NOW(), NOW());

-- NOTA: La contraseña para todos los usuarios es 'password123'
-- El hash utilizado es: $2y$12$LW.fXgU.UcEdYlL2hL0mCOkgU1YzqOQxoq7XyVjwpbXoFNiTHUQUS