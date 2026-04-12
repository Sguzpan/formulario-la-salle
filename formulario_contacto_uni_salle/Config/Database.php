<?php
namespace Config;

use PDO;
use PDOException;
use Exception;

require_once __DIR__ . '/config.php';

class Database {
    private static ?self $instance = null;
    private ?PDO $connection = null;

    /**
     * Constructor privado - Singleton Pattern
     */
    private function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

        try {
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_PERSISTENT         => false,     // Mejor en hosting compartido
            ]);
        } catch (PDOException $e) {
            error_log("❌ Error de conexión a BD: " . $e->getMessage());
            throw new Exception("Error interno del servidor. Por favor, intente más tarde.");
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }

    // === PROTECCIONES DEL SINGLETON ===
    private function __clone() {
        throw new Exception("No se permite clonar el objeto Database.");
    }

    public function __wakeup() {
        throw new Exception("No se permite deserializar el objeto Database.");
    }
}