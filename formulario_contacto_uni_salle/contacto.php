// solucion de conexion entre Database.php, ContactRepository.php y 
<?php

declare(strict_types=1);

// Cargar dependencias
require_once __DIR__ . '/Config/Database.php';
require_once __DIR__ . '/Models/Contact.php';
require_once __DIR__ . '/Factories/ContactFactory.php';
require_once __DIR__ . '/Repositories/ContactRepository.php';
require_once __DIR__ . '/includes/header.php';

// IMPORTANTE: usar el namespace correcto
use Config\Database;

// Solo procesamos si es un POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 1. Crear el objeto Contact validado
        $contact = ContactFactory::createFromPost($_POST);

        // 2. Obtener conexión correctamente (Singleton)
        $pdo = Database::getInstance()->getConnection();

        // 3. Crear el repository con la conexión
        $repository = new ContactRepository($pdo);

        // 4. Guardar en la base de datos
        $success = $repository->save($contact);

        if ($success) {
            $mensajeExito = "¡Mensaje enviado correctamente!";
            $detalleExito = "ID: " . $contact->getId() . " | Fecha: " . $contact->getFecha();
        } else {
            $error = "Hubo un problema al guardar el mensaje. Intenta de nuevo.";
        }

    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();

    } catch (Exception $e) {
        $error = "Error inesperado: " . $e->getMessage();
    }
}

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
