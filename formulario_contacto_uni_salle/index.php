<?php
require_once 'includes/header.php';
?>

<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white flex flex-col justify-center">

    <!-- Hero Section -->
    <section class="text-center px-6 py-20 md:py-32">
        <div class="max-w-5xl mx-auto">
            <!-- Icono grande o logo -->
            <div class="mb-10">
                <i class="fas fa-university text-8xl md:text-9xl text-lasalle-blue opacity-90"></i>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-lasalle-blue mb-6 leading-tight">
                Universidad La Salle
            </h1>

            <p class="text-xl md:text-2xl lg:text-3xl text-gray-700 mb-12 md:mb-16 max-w-4xl mx-auto leading-relaxed">
                Formación integral con valores lasallistas.<br>
                Excelencia académica, innovación y compromiso social.
            </p>

            <!-- Botón principal – grande y llamativo -->
            <a href="index.php"  <!-- ← apunta al formulario (tu index.php actual) -->
               class="inline-block bg-lasalle-blue text-white font-bold text-xl md:text-2xl px-12 md:px-20 py-6 md:py-8 rounded-2xl shadow-2xl 
                      hover:bg-blue-900 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                Ir al Formulario de Contacto →
            </a>

            <p class="mt-8 text-lg text-gray-600">
                Completa el formulario y nuestro equipo se pondrá en contacto contigo lo antes posible.
            </p>
        </div>
    </section>

    <!-- Sección secundaria (opcional – suma presentación) -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-10 text-center">
            <div class="p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition-shadow duration-300">
                <i class="fas fa-graduation-cap text-6xl text-lasalle-blue mb-6"></i>
                <h3 class="text-2xl font-bold text-lasalle-blue mb-4">Educación de Calidad</h3>
                <p class="text-gray-700">Programas acreditados y docentes comprometidos con tu desarrollo.</p>
            </div>

            <div class="p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition-shadow duration-300">
                <i class="fas fa-users text-6xl text-lasalle-blue mb-6"></i>
                <h3 class="text-2xl font-bold text-lasalle-blue mb-4">Comunidad Inclusiva</h3>
                <p class="text-gray-700">Ambiente de respeto, diversidad y apoyo mutuo.</p>
            </div>

            <div class="p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition-shadow duration-300">
                <i class="fas fa-hand-holding-heart text-6xl text-lasalle-blue mb-6"></i>
                <h3 class="text-2xl font-bold text-lasalle-blue mb-4">Compromiso Social</h3>
                <p class="text-gray-700">Proyectos que impactan positivamente en la sociedad.</p>
            </div>
        </div>
    </section>

</div>

<?php require_once 'includes/footer.php'; ?>