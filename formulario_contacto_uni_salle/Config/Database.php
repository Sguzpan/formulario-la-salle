<?php

/**
 * Clase Database - Singleton para la conexión a la base de datos
 * 
 * Uso:
 * $db = Database::getInstance();
 * $pdo = $db->getConnection();
 */

class Database {
    private static ?Database $instance = null;
    private ?PDO $connection = null;

    // Configuración para InfinityFree (producción) - VALORES REALES
    private string $host     = 'sql211.infinityfree.com';
    private string $dbname   = 'if0_41440201_db_contacto';
    private string $username = 'if0_41440201';
    private string $password = 'TheJoc2046';
    private string $charset  = 'utf8mb4';

    // Constructor privado para evitar instanciación directa
    private function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

        try {
            $this->connection = new PDO(
                $dsn,
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            // Mensaje amigable para producción (no exponer detalles)
            die("Error al conectar con la base de datos. Contacta al administrador.");
        }
    }

    /**
     * Obtiene la única instancia de la clase (Singleton)
     */
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Devuelve la conexión PDO activa
     */
    public function getConnection(): PDO {
        return $this->connection;
    }

    // Evitar clonación del singleton
    private function __clone() {}

    // Evitar deserialización
    public function __wakeup() {
        throw new Exception("No se puede deserializar una instancia singleton.");
    }
}