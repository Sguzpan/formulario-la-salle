<?php

declare(strict_types=1);

// Cargar dependencias (ajusta las rutas según tu estructura)
require_once __DIR__ . '/Config/Database.php';
require_once __DIR__ . '/Models/Contact.php';
require_once __DIR__ . '/Factories/ContactFactory.php';
require_once __DIR__ . '/Repositories/ContactRepository.php';
require_once __DIR__ . '/includes/header.php';  // Para mostrar la página con header y footer

// Solo procesamos si es un POST (envío del formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 1. Crear el objeto Contact validado desde los datos del formulario
        $contact = ContactFactory::createFromPost($_POST);

        // 2. Guardar en la base de datos usando el Repository
        $repository = new ContactRepository();
        $success = $repository->save($contact);

        if ($success) {
            // Mensaje de éxito + datos guardados (para feedback al usuario)
            $mensajeExito = "¡Mensaje enviado correctamente!";
            $detalleExito = "ID: " . $contact->getId() . " | Fecha: " . $contact->getFecha();
        } else {
            $error = "Hubo un problema al guardar el mensaje. Intenta de nuevo.";
        }
    } catch (InvalidArgumentException $e) {
        // Errores de validación del Factory
        $error = $e->getMessage();
    } catch (Exception $e) {
        // Otros errores (BD, conexión, etc.)
        $error = "Error inesperado: " . $e->getMessage();
    }
}

// Mostrar la página con el resultado (éxito o error)
?>

<main class="container">
    <section class="resultado">
        <?php if (isset($mensajeExito)): ?>
            <div class="alert success">
                <h2>¡Éxito!</h2>
                <p><?php echo htmlspecialchars($mensajeExito); ?></p>
                <p><?php echo htmlspecialchars($detalleExito); ?></p>
                <a href="formulario.php" class="btn">Volver al formulario</a>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert error">
                <h2>Error</h2>
                <p><?php echo htmlspecialchars($error); ?></p>
                <a href="formulario.php" class="btn">Volver e intentar de nuevo</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>