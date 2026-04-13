# Formulario de Contacto - Universidad La Salle

Proyecto desarrollado para la actividad de Arquitectura de Software:  
Diseño y construcción de ambientes de desarrollo y pruebas para aplicaciones web.

## Descripción

Aplicación web sencilla con:
- Página principal con formulario de contacto
- Procesamiento seguro del formulario (validación + almacenamiento en BD)
- Uso de patrones de diseño: Singleton (conexión BD), Factory (creación y validación), Repository (acceso a datos)

## Tecnologías utilizadas

- PHP 8+
- MySQL / MariaDB
- PDO (conexión segura)
- HTML5 + CSS (Tailwind CDN recomendado)
- XAMPP (ambiente local)
- Visual Studio Code

## Estructura del proyecto

formulario-contacto-u-lasalle/
├── Config/               # Conexión a BD (Singleton)
├── Models/               # Entidades / Modelos de dominio
├── Factories/            # Creación y validación de objetos
├── Repositories/         # Acceso a datos (patrón Repository)
├── Services/             # Servicios (validación adicional si se expande)
├── includes/             # Partes comunes (header, footer)
├── css/                  # Estilos personalizados
├── js/                   # JavaScript (validación cliente opcional)
├── database/             # Scripts SQL
├── index.php             # Página principal + formulario
├── contacto.php          # Procesador del formulario
|--formulario.php         # estructura del diseño del formulario
├── README.md
└── .gitignore


## Requisitos

- PHP ≥ 8.0
- MySQL / MariaDB
- Servidor web (Apache vía XAMPP)

## Instalación local (XAMPP)

1. Clonar o descargar el proyecto
2. Copiar la carpeta a `C:\xampp\htdocs\formulario-contacto-u-lasalle`
3. Iniciar Apache y MySQL en XAMPP
4. Crear base de datos `db_contacto_lasalle`
5. Ejecutar `database/schema.sql` en phpMyAdmin
6. (Opcional) Configurar credenciales en `Config/Database.php`
7. Abrir en navegador: http://localhost/formulario-contacto-u-lasalle/index.php

## Ambiente de pruebas (lo que pide la actividad)

Ver archivo `prueba_bd.php` para demostración de:
- Crear BD de prueba
- Crear tabla
- Consulta SELECT simple
- Agregar datos manualmente
- Mostrar datos

## Versión pública

- Dominio: [pendiente – subir a InfinityFree / 000webhost / similar]
- Enlace: https://formulario-lasalle.42web.io/formulario_contacto_uni_salle/index.php 

## Patrones de diseño aplicados

- **Singleton** → Conexión única a BD (Database.php)
- **Factory** → Creación y validación de objetos Contact (ContactFactory.php)
- **Repository** → Abstracción de persistencia (ContactRepository.php)

## Link del repositorio en GITHUB

https://github.com/Sguzpan/formulario-la-salle

## Autores

SANTIAGO GUZMAN NAVARRETE
LUIS ALFREDO MUNAR MONTOYA
JUAN ANDRES ROMERO CELIS
BRAYAN ANDRES VARGAS SOACHE

Actividad de Arquitectura de Software – Marzo 2026

¡Gracias por revisar!