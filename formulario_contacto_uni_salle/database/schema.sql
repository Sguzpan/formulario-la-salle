-- schema.sql
-- Estructura de la base de datos para el Formulario de Contacto U La Salle
-- Base de datos: db_contacto_lasalle

-- Crear la base de datos (solo si no existe)
CREATE DATABASE IF NOT EXISTS db_contacto_lasalle
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_spanish_ci;

-- Usar la base de datos
USE db_contacto_lasalle;

-- Crear la tabla contactos
CREATE TABLE IF NOT EXISTS contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL COMMENT 'Nombre completo del remitente',
    email VARCHAR(120) NOT NULL COMMENT 'Correo electrónico del remitente',
    asunto VARCHAR(150) NOT NULL COMMENT 'Motivo del mensaje',
    mensaje TEXT NOT NULL COMMENT 'Contenido del mensaje',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora de envío automática',
    leido TINYINT(1) DEFAULT 0 COMMENT '0 = pendiente, 1 = revisado/leído'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Índice adicional para búsquedas rápidas por email o fecha (opcional pero buena práctica)
CREATE INDEX idx_email ON contactos(email);
CREATE INDEX idx_fecha ON contactos(fecha);

-- Comentario final
-- Última actualización: Marzo 2026
-- Autor: Santiago (para la actividad de Arquitectura de Software)