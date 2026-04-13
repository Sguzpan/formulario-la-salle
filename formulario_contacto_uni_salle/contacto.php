<?php
declare(strict_types=1);

require_once __DIR__ . '/Config/Database.php';
require_once __DIR__ . '/Models/Contact.php';
require_once __DIR__ . '/Factories/ContactFactory.php';
require_once __DIR__ . '/Repositories/ContactRepository.php';

// ── Conexión ──────────────────────────────────────────────
try {
    $pdo        = \Config\Database::getInstance()->getConnection();
    $repository = new ContactRepository($pdo);
} catch (Exception $e) {
    die('Error de conexión: ' . htmlspecialchars($e->getMessage()));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $contact = ContactFactory::createFromPost($_POST);
        if ($repository->save($contact)) {
            header('Location: formulario.php?success=1');
        } else {
            header('Location: formulario.php?error=' . urlencode('No se pudo guardar el mensaje.'));
        }
    } catch (Exception $e) {
        header('Location: formulario.php?error=' . urlencode($e->getMessage()));
    }
    exit; 
}

// ── Modo admin: verificar ANTES de cargar la vista ───────
$modo_admin = isset($_GET['admin']) && $_GET['admin'] === 'salle_pro_2024';

if (!$modo_admin) {
    header('Location: index.php');
    exit;
}

// ── Cargar datos ──────────────────────────────────────────
try {
    $contactos = $repository->findAll();
} catch (Exception $e) {
    $contactos   = [];
    $errorAdmin  = $e->getMessage();
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="min-h-screen bg-lasalle-dark py-12">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-10 flex justify-between items-end">
            <div>
                <h2 class="text-5xl font-black text-white">
                    Panel de <span class="text-lasalle-green neon-green">Registros</span>
                </h2>
                <p class="text-gray-400 mt-2">
                    Total: <span class="font-semibold text-lasalle-green">
                        <?php echo count($contactos); ?>
                    </span> contactos
                </p>
            </div>
            <a href="index.php" class="text-gray-400 hover:text-lasalle-green flex items-center gap-2">
                <i class="fas fa-home"></i> Volver
            </a>
        </div>

        <?php if (isset($errorAdmin)): ?>
            <div class="bg-red-900/30 border border-red-500 text-red-300 p-6 rounded-2xl mb-8">
                Error al cargar registros: <?php echo htmlspecialchars($errorAdmin); ?>
            </div>
        <?php endif; ?>

        <div class="bg-zinc-950 border border-white/10 rounded-3xl overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-black border-b border-lasalle-green/30">
                        <th class="p-6 text-left text-lasalle-green text-sm uppercase">ID</th>
                        <th class="p-6 text-left text-lasalle-green text-sm uppercase">Nombre</th>
                        <th class="p-6 text-left text-lasalle-green text-sm uppercase">Email</th>
                        <th class="p-6 text-left text-lasalle-green text-sm uppercase">Asunto</th>
                        <th class="p-6 text-left text-lasalle-green text-sm uppercase">Mensaje</th>
                        <th class="p-6 text-left text-lasalle-green text-sm uppercase">Fecha</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10 text-gray-200">
                    <?php if (empty($contactos)): ?>
                        <tr>
                            <td colspan="6" class="p-20 text-center text-gray-500">
                                Aún no hay registros.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($contactos as $c): ?>
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="p-6 font-mono text-lasalle-green">
                                    #<?php echo htmlspecialchars((string)($c->getId() ?? 0)); ?>
                                </td>
                                <td class="p-6 font-medium text-white">
                                    <?php echo htmlspecialchars($c->getNombre()); ?>
                                </td>
                                <td class="p-6 text-emerald-300">
                                    <?php echo htmlspecialchars($c->getEmail()); ?>
                                </td>
                                <td class="p-6 text-gray-300">
                                    <?php echo htmlspecialchars($c->getAsunto()); ?>
                                </td>
                                <td class="p-6 max-w-md text-gray-400">
                                    <?php
                                        $msg = $c->getMensaje();
                                        echo htmlspecialchars(
                                            mb_strlen($msg) > 120
                                                ? mb_substr($msg, 0, 120) . '...'
                                                : $msg
                                        );
                                    ?>
                                </td>
                                <td class="p-6 text-sm text-gray-500">
                                    <?php echo htmlspecialchars($c->getFecha() ?? '—'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
