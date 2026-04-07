<?php
/**
 * Ambiente de Pruebas - Visualización de Datos Reales
 * Este archivo ahora se conecta al servidor de InfinityFree
 */

// 1. CONFIGURACIÓN DE CONEXIÓN (Datos de tu imagen de InfinityFree)
$host     = 'sql211.byetcluster.com';
$dbname   = 'if0_41440201_db_contacto'; // Tu base de datos real
$username = 'if0_41440201';             // Tu usuario de hosting
$password = 'TheJoc2046';       // Reemplaza por tu contraseña de la base de datos

try {
    // Conexión mediante PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 2. CONSULTA A LA TABLA REAL (Se llama 'contactos' según tu captura)
    $stmt = $pdo->query("SELECT * FROM contactos ORDER BY id DESC");
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Si falla la conexión, mostramos un error estilizado
    die("<div style='background:#fee2e2; color:#b91c1c; padding:20px; border-radius:10px; font-family:sans-serif;'>
            <strong>Error de conexión al servidor real:</strong> " . htmlspecialchars($e->getMessage()) . "
         </div>");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Contactos - Servidor Real</title>
    <!-- Tailwind CSS para el diseño -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com">
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto px-6 py-12 max-w-5xl">

        <!-- Encabezado -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-blue-900 mb-2">
                Panel de Visualización (InfinityFree)
            </h1>
            <p class="text-gray-600">Datos almacenados en la base de datos: <span class="font-mono text-blue-700"><?php echo $dbname; ?></span></p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8 mb-10 border border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">
                    <i class="fas fa-database mr-2 text-blue-800"></i> Registros de la Tabla 'contactos'
                </h2>
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-4 py-1 rounded-full">
                    Total: <?php echo count($registros); ?>
                </span>
            </div>

            <?php if (empty($registros)): ?>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-r-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl mr-4"></i>
                        <div>
                            <p class="font-bold text-yellow-800">No hay mensajes aún.</p>
                            <p class="text-yellow-700 text-sm">Ve al formulario principal, envía un mensaje y recarga esta página.</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border-collapse">
                        <thead>
                            <tr class="bg-blue-900 text-white uppercase text-sm leading-normal">
                                <th class="py-4 px-6 text-left rounded-tl-lg">ID</th>
                                <th class="py-4 px-6 text-left">Nombre</th>
                                <th class="py-4 px-6 text-left">Email</th>
                                <th class="py-4 px-6 text-left">Mensaje</th>
                                <th class="py-4 px-6 text-left rounded-tr-lg">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            <?php foreach ($registros as $row): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-6 font-bold text-blue-900">#<?php echo htmlspecialchars($row['id'] ?? $row['ID'] ?? '-'); ?></td>
                                    <td class="py-4 px-6 font-medium"><?php echo htmlspecialchars($row['nombre'] ?? '-'); ?></td>
                                    <td class="py-4 px-6 italic"><?php echo htmlspecialchars($row['email'] ?? '-'); ?></td>
                                    <td class="py-4 px-6">
                                        <div class="max-w-xs truncate text-gray-600" title="<?php echo htmlspecialchars($row['mensaje'] ?? ''); ?>">
                                            <?php echo htmlspecialchars($row['mensaje'] ?? '-'); ?>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500">
                                        <?php echo htmlspecialchars($row['fecha'] ?? $row['created_at'] ?? 'Reciente'); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Botones de Navegación -->
        <div class="flex flex-col md:flex-row justify-center gap-4 mt-10">
            <a href="../index.php" class="bg-blue-800 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-900 transition flex items-center justify-center">
                <i class="fas fa-home mr-2"></i> Inicio
            </a>
            <a href="javascript:location.reload()" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl font-bold hover:bg-gray-300 transition flex items-center justify-center">
                <i class="fas fa-sync-alt mr-2"></i> Actualizar Datos
            </a>
        </div>

    </div>

</body>
</html>