<?php
require_once 'includes/header.php';

$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>

<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl py-12">

    <!-- Sección intro -->
    <div class="text-center mb-12">
        <h2 class="text-4xl sm:text-5xl font-extrabold text-lasalle-green mb-4">
            Contáctanos
        </h2>
        <p class="text-lg sm:text-xl text-gray-400 max-w-3xl mx-auto leading-relaxed">
            Estamos aquí para responder tus dudas, sugerencias o consultas. Completa el formulario y nos pondremos en contacto pronto.
        </p>
    </div>

    <!-- Mensajes de feedback -->
    <?php if ($success): ?>
        <div class="bg-lasalle-green/10 border-l-4 border-lasalle-green text-lasalle-green p-6 mb-10 rounded-r-xl shadow-sm">
            <p class="font-bold text-lg">¡Mensaje enviado con éxito!</p>
            <p class="mt-2"><?php echo htmlspecialchars($success); ?></p>
            <a href="index.php" class="mt-4 inline-block text-lasalle-green hover:underline">Enviar otro mensaje</a>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 p-6 mb-10 rounded-r-xl shadow-sm">
            <p class="font-bold text-lg">Error al enviar</p>
            <p class="mt-2"><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <div class="card-dark rounded-2xl shadow-2xl p-8 sm:p-10 lg:p-12 border border-lasalle-green/20">
        <form id="contact-form" action="contacto.php" method="POST" class="space-y-8">

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-base font-semibold text-gray-300 mb-2">
                    Nombre completo <span class="text-red-400">*</span>
                </label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    required
                    class="w-full px-5 py-4 bg-[#1a1a1a] border border-lasalle-green/30 text-white rounded-xl focus:ring-2 focus:ring-lasalle-green focus:border-lasalle-green outline-none transition-all duration-200 placeholder-gray-500"
                    placeholder="Ej: Juan David Pérez"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-base font-semibold text-gray-300 mb-2">
                    Correo electrónico <span class="text-red-400">*</span>
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-5 py-4 bg-[#1a1a1a] border border-lasalle-green/30 text-white rounded-xl focus:ring-2 focus:ring-lasalle-green focus:border-lasalle-green outline-none transition-all duration-200 placeholder-gray-500"
                    placeholder="tu.correo@lasalle.edu.co"
                >
            </div>

            <!-- Asunto -->
            <div>
                <label for="asunto" class="block text-base font-semibold text-gray-300 mb-2">
                    Asunto <span class="text-red-400">*</span>
                </label>
                <input
                    type="text"
                    id="asunto"
                    name="asunto"
                    required
                    class="w-full px-5 py-4 bg-[#1a1a1a] border border-lasalle-green/30 text-white rounded-xl focus:ring-2 focus:ring-lasalle-green focus:border-lasalle-green outline-none transition-all duration-200 placeholder-gray-500"
                    placeholder="Consulta académica, sugerencia, etc."
                >
            </div>

            <!-- Mensaje -->
            <div>
                <label for="mensaje" class="block text-base font-semibold text-gray-300 mb-2">
                    Mensaje <span class="text-red-400">*</span>
                </label>
                <textarea
                    id="mensaje"
                    name="mensaje"
                    rows="7"
                    required
                    class="w-full px-5 py-4 bg-[#1a1a1a] border border-lasalle-green/30 text-white rounded-xl focus:ring-2 focus:ring-lasalle-green focus:border-lasalle-green outline-none transition-all duration-200 placeholder-gray-500 resize-y"
                    placeholder="Escribe aquí tu mensaje en detalle..."
                ></textarea>
                <div class="flex justify-between items-center mt-2">
                    <span id="char-hint" class="text-sm text-red-400">Mínimo 10 caracteres</span>
                    <span id="char-counter" class="text-sm text-gray-500">0 caracteres</span>
                </div>
            </div>

            <!-- Botón Enviar -->
            <div class="text-center pt-4">
                <button
                    type="submit"
                    id="submit-btn"
                    class="bg-lasalle-green text-black px-12 py-5 rounded-xl font-bold text-lg hover:bg-lasalle-green-dark transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-lasalle-green/40 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Enviar Mensaje
                </button>
            </div>
        </form>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>