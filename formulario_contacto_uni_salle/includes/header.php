<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto - Universidad La Salle</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- ScrollReveal (Librería de animaciones que faltaba) -->
    <script src="https://unpkg.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lasalle-dark': '#0a0a0a',
                        'lasalle-green': '#00c853',
                        'lasalle-green-dark': '#00a140',
                    }
                }
            }
        }
    </script>
    
    <!-- Rutas directas para htdocs -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        .hero-bg { background: linear-gradient(135deg, #0a0a0a 0%, #111111 100%); }
        .neon-green { text-shadow: 0 0 20px #00c853, 0 0 40px #00c853; }
        .card-dark { background: rgba(15, 15, 15, 0.95); backdrop-filter: blur(12px); }
        main { overflow-x: hidden; }
    </style>
</head>
<body class="bg-lasalle-dark text-white antialiased">
    <header class="bg-lasalle-dark border-b border-lasalle-green/10 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-5 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-lasalle-green to-emerald-400 flex items-center justify-center">
                    <i class="fas fa-university text-xl text-black"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Universidad La Salle</h1>
            </div>
            <nav class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="index.php" class="hover:text-lasalle-green transition-colors">Inicio</a>
                <a href="formulario.php" class="hover:text-lasalle-green transition-colors">Contacto</a>
            </nav>
            <button class="md:hidden text-white"><i class="fas fa-bars text-2xl"></i></button>
        </div>
    </header>
    <main>