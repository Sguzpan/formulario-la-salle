<?php

declare(strict_types=1);

require_once __DIR__ . '/../Models/Contact.php';

/**
 * Clase ContactFactory - Patrón Factory para crear objetos Contact válidos
 * 
 * Responsabilidades:
 * - Validar todos los datos entrantes del formulario
 * - Crear instancia de Contact solo si pasa todas las validaciones
 * - Lanzar excepciones claras en caso de error (para que el controlador las maneje)
 */
class ContactFactory
{
    /**
     * Crea un nuevo Contact a partir de los datos del formulario ($_POST)
     *
     * @param array $data Datos crudos del formulario (normalmente $_POST)
     * @return Contact Objeto Contact válido
     * @throws InvalidArgumentException Si algún dato no pasa la validación
     */
    public static function createFromPost(array $data): Contact
    {
        // 1. Verificar que todos los campos requeridos existan
        $requiredFields = ['nombre', 'email', 'asunto', 'mensaje'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || !is_string($data[$field])) {
                throw new InvalidArgumentException("El campo '$field' es obligatorio y debe ser texto.");
            }
        }

        // 2. Limpiar y normalizar datos
        $nombre  = trim($data['nombre']);
        $email   = trim($data['email']);
        $asunto  = trim($data['asunto']);
        $mensaje = trim($data['mensaje']);

        // 3. Validaciones específicas
        self::validateNombre($nombre);
        self::validateEmail($email);
        self::validateAsunto($asunto);
        self::validateMensaje($mensaje);

        // 4. Todo pasó → crear el objeto
        return new Contact($nombre, $email, $asunto, $mensaje);
    }

    // ────────────────────────────────────────────────
    // Validaciones privadas (fáciles de extender/modificar)
    // ────────────────────────────────────────────────

    private static function validateNombre(string $nombre): void
    {
        if (empty($nombre)) {
            throw new InvalidArgumentException("El nombre no puede estar vacío.");
        }
        if (strlen($nombre) < 2) {
            throw new InvalidArgumentException("El nombre debe tener al menos 2 caracteres.");
        }
        if (strlen($nombre) > 100) {
            throw new InvalidArgumentException("El nombre no puede exceder 100 caracteres.");
        }
        // Opcional: solo letras y espacios (puedes quitar si quieres permitir más)
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
            throw new InvalidArgumentException("El nombre solo puede contener letras y espacios.");
        }
    }

    private static function validateEmail(string $email): void
    {
        if (empty($email)) {
            throw new InvalidArgumentException("El correo electrónico es obligatorio.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("El correo electrónico no es válido.");
        }
        if (strlen($email) > 120) {
            throw new InvalidArgumentException("El correo no puede exceder 120 caracteres.");
        }
    }

    private static function validateAsunto(string $asunto): void
    {
        if (empty($asunto)) {
            throw new InvalidArgumentException("El asunto no puede estar vacío.");
        }
        if (strlen($asunto) < 3) {
            throw new InvalidArgumentException("El asunto debe tener al menos 3 caracteres.");
        }
        if (strlen($asunto) > 150) {
            throw new InvalidArgumentException("El asunto no puede exceder 150 caracteres.");
        }
    }

    private static function validateMensaje(string $mensaje): void
    {
        if (empty($mensaje)) {
            throw new InvalidArgumentException("El mensaje no puede estar vacío.");
        }
        if (strlen($mensaje) < 10) {
            throw new InvalidArgumentException("El mensaje debe tener al menos 10 caracteres.");
        }
        if (strlen($mensaje) > 5000) {  // límite razonable para TEXT en BD
            throw new InvalidArgumentException("El mensaje es demasiado largo (máximo 5000 caracteres).");
        }
    }

    /**
     * Versión alternativa: retorna errores en lugar de lanzar excepciones
     * Útil si prefieres manejar errores en el controlador sin try-catch
     */
    public static function createFromPostWithErrors(array $data): array
    {
        try {
            $contact = self::createFromPost($data);
            return ['success' => true, 'contact' => $contact];
        } catch (InvalidArgumentException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}