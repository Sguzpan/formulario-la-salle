<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto - Universidad La Salle</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind config básica personalizada (opcional pero recomendado) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lasalle-blue': '#003366',    // Azul oscuro típico universitario
                        'lasalle-gold': '#c9a96e',    // Dorado/acento si quieres
                    }
                }
            }
        }
    </script>
    
    <!-- Tus estilos personalizados (opcional) -->
    <link rel="stylesheet" href="../css/style.css">
    
    <!-- Íconos (opcional - Font Awesome o Heroicons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navbar / Header -->
    <header class="bg-lasalle-blue text-white shadow-lg">
        <div class="container mx-auto px-6 py-5 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fas fa-university text-3xl"></i>
                <h1 class="text-2xl md:text-3xl font-bold">Universidad La Salle</h1>
            </div>
            <nav class="hidden md:flex space-x-8">
                <a href="index.php" class="hover:text-lasalle-gold transition-colors">Inicio</a>
                <a href="#contacto" class="hover:text-lasalle-gold transition-colors">Contacto</a>
            </nav>
            <!-- Mobile menu button (opcional) -->
            <button class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="min-h-screen py-10">