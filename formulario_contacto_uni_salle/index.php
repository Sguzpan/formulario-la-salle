<?php
// Asegúrate de que este archivo esté en la raíz de htdocs
require_once 'includes/header.php';
?>

<div class="min-h-screen bg-lasalle-dark">

    <!-- HERO SECTION - Estilo Premium Dark -->
    <section class="hero-bg min-h-screen flex items-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(at_center,#00c85310_0%,transparent_70%)]"></div>
        
        <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">
            <!-- Badge superior -->
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-6 py-2 rounded-full border border-lasalle-green/20 mb-8 reveal-fade">
                <div class="w-2 h-2 bg-lasalle-green rounded-full animate-pulse"></div>
                <span class="text-sm font-medium tracking-widest text-lasalle-green">EXCELENCIA LASALLISTA</span>
            </div>

            <!-- Icono Institucional -->
            <div class="mb-6 reveal-fade">
                <i class="fas fa-university text-7xl md:text-8xl text-lasalle-green neon-green opacity-90"></i>
            </div>

            <!-- Título Hero -->
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter leading-none mb-6 text-white reveal-up">
                UNIVERSIDAD<br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-lasalle-green via-emerald-300 to-lasalle-green neon-green">
                    LA SALLE
                </span>
            </h1>

            <p class="text-xl md:text-3xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-12 reveal-up">
                Formación integral con valores lasallistas.<br>
                Excelencia académica, innovación y compromiso social.
            </p>

            <!-- Botón principal -->
            <a href="formulario.php" 
               class="group inline-flex items-center justify-center gap-3 bg-gradient-to-r from-lasalle-green to-emerald-400 hover:from-emerald-400 hover:to-lasalle-green text-black font-bold text-2xl px-12 md:px-20 py-6 md:py-8 rounded-3xl shadow-2xl shadow-lasalle-green/40 transition-all duration-300 hover:scale-105 reveal-up">
                <span>Ir al Formulario de Contacto</span>
                <i class="fas fa-arrow-right text-3xl group-hover:translate-x-2 transition-transform"></i>
            </a>

            <!-- Acceso Administrativo -->
            <div class="mt-12 reveal-fade">
                <a href="contacto.php?admin=salle_pro_2024" class="text-gray-500 hover:text-lasalle-green text-sm transition-colors duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Acceso al Panel de Registros
                </a>
            </div>
        </div>
    </section>

    <!-- Sección de Pilares -->
    <section class="py-24 bg-lasalle-dark border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
                <!-- Tarjeta 1 -->
                <div class="card-dark group p-10 rounded-3xl border border-white/5 hover:border-lasalle-green/30 transition-all duration-500 hover:-translate-y-2 reveal-card">
                    <div class="w-20 h-20 rounded-2xl bg-lasalle-green/10 flex items-center justify-center mb-8 group-hover:bg-lasalle-green/20">
                        <i class="fas fa-graduation-cap text-5xl text-lasalle-green"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Educación de Calidad</h3>
                    <p class="text-gray-400 leading-relaxed text-lg">Programas acreditados y docentes comprometidos.</p>
                </div>
                <!-- Tarjeta 2 -->
                <div class="card-dark group p-10 rounded-3xl border border-white/5 hover:border-lasalle-green/30 transition-all duration-500 hover:-translate-y-2 reveal-card">
                    <div class="w-20 h-20 rounded-2xl bg-lasalle-green/10 flex items-center justify-center mb-8 group-hover:bg-lasalle-green/20">
                        <i class="fas fa-users text-5xl text-lasalle-green"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Comunidad Inclusiva</h3>
                    <p class="text-gray-400 leading-relaxed text-lg">Ambiente de respeto, diversidad y apoyo mutuo.</p>
                </div>
                <!-- Tarjeta 3 -->
                <div class="card-dark group p-10 rounded-3xl border border-white/5 hover:border-lasalle-green/30 transition-all duration-500 hover:-translate-y-2 reveal-card">
                    <div class="w-20 h-20 rounded-2xl bg-lasalle-green/10 flex items-center justify-center mb-8 group-hover:bg-lasalle-green/20">
                        <i class="fas fa-hand-holding-heart text-5xl text-lasalle-green"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Compromiso Social</h3>
                    <p class="text-gray-400 leading-relaxed text-lg">Proyectos que impactan positivamente en la sociedad.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Script de Animaciones (ScrollReveal) -->
<script>
    ScrollReveal().reveal('.reveal-fade', { delay: 200, distance: '0px', opacity: 0 });
    ScrollReveal().reveal('.reveal-up', { delay: 400, distance: '50px', origin: 'bottom', opacity: 0 });
    ScrollReveal().reveal('.reveal-card', { delay: 500, interval: 200, distance: '30px', origin: 'bottom', opacity: 0 });
</script>

<?php require_once 'includes/footer.php'; ?>