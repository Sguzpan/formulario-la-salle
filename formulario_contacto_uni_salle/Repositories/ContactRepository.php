<?php

declare(strict_types=1);

// Eliminamos el require de Database, ya que la conexión vendrá de afuera
require_once __DIR__ . '/../Models/Contact.php';

/**
 * Repositorio para la entidad Contact
 * Aplicamos Inyección de Dependencias para mejorar la testabilidad y seguridad
 */
class ContactRepository
{
    private PDO $pdo;

    /**
     * Ahora el constructor recibe la conexión PDO.
     * Esto desacopla el Repositorio de la clase Database.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Guarda un nuevo contacto utilizando sentencias preparadas (Protección SQL Injection)
     */
    public function save(Contact $contact): bool
    {
        $sql = "INSERT INTO contactos (nombre, email, asunto, mensaje)
                VALUES (:nombre, :email, :asunto, :mensaje)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute([
                ':nombre'  => htmlspecialchars($contact->getNombre()), // Protección XSS básica
                ':email'   => $contact->getEmail(),
                ':asunto'  => htmlspecialchars($contact->getAsunto()),
                ':mensaje' => htmlspecialchars($contact->getMensaje()),
            ]);

            if ($success) {
                $id = (int) $this->pdo->lastInsertId();
                $contact->setId($id);
                
                // Optimizamos: solo pedimos la fecha si realmente la necesitamos
                $stmtFecha = $this->pdo->prepare("SELECT fecha FROM contactos WHERE id = ?");
                $stmtFecha->execute([$id]);
                $contact->setFecha($stmtFecha->fetchColumn());
            }

            return $success;
        } catch (PDOException $e) {
            error_log("Error en ContactRepository::save -> " . $e->getMessage());
            return false;
        }
    }

    public function findById(int $id): ?Contact
    {
        $stmt = $this->pdo->prepare("SELECT * FROM contactos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        return $this->mapRowToContact($row);
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM contactos ORDER BY fecha DESC");
        $contacts = [];

        while ($row = $stmt->fetch()) {
            $contacts[] = $this->mapRowToContact($row);
        }

        return $contacts;
    }

    private function mapRowToContact(array $row): Contact
    {
        $contact = new Contact(
            $row['nombre'],
            $row['email'],
            $row['asunto'],
            $row['mensaje']
        );
        $contact->setId((int) $row['id']);
        $contact->setFecha($row['fecha']);
        if ((int)$row['leido'] === 1) {
            $contact->markAsRead();
        }
        return $contact;
    }

    public function markAsRead(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE contactos SET leido = 1 WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}