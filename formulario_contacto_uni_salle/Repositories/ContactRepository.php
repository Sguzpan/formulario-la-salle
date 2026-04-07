<?php

declare(strict_types=1);

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Models/Contact.php';

/**
 * Repositorio para la entidad Contact
 * Maneja todas las operaciones de persistencia relacionadas con contactos
 */
class ContactRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * Guarda un nuevo contacto en la base de datos
     *
     * @param Contact $contact Objeto Contact a persistir
     * @return bool True si se guardó correctamente
     * @throws PDOException Si hay error en la BD
     */
    public function save(Contact $contact): bool
    {
        $sql = "
            INSERT INTO contactos 
            (nombre, email, asunto, mensaje)
            VALUES 
            (:nombre, :email, :asunto, :mensaje)
        ";

        $stmt = $this->pdo->prepare($sql);

        $success = $stmt->execute([
            ':nombre'  => $contact->getNombre(),
            ':email'   => $contact->getEmail(),
            ':asunto'  => $contact->getAsunto(),
            ':mensaje' => $contact->getMensaje(),
        ]);

        if ($success) {
            // Recuperar el ID generado y la fecha asignada por la BD
            $id = (int) $this->pdo->lastInsertId();
            $contact->setId($id);

            // Opcional: recuperar la fecha exacta si quieres precisión
            $stmtFecha = $this->pdo->prepare("SELECT fecha FROM contactos WHERE id = :id");
            $stmtFecha->execute([':id' => $id]);
            $fecha = $stmtFecha->fetchColumn();
            $contact->setFecha($fecha);
        }

        return $success;
    }

    /**
     * Busca un contacto por su ID
     *
     * @param int $id ID del contacto
     * @return Contact|null El contacto o null si no existe
     */
    public function findById(int $id): ?Contact
    {
        $stmt = $this->pdo->prepare("SELECT * FROM contactos WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $contact = new Contact(
            $row['nombre'],
            $row['email'],
            $row['asunto'],
            $row['mensaje']
        );

        $contact->setId((int) $row['id']);
        $contact->setFecha($row['fecha']);

        if ($row['leido'] === 1) {
            $contact->markAsRead();
        }

        return $contact;
    }

    /**
     * Obtiene todos los contactos (útil para una futura lista o administración)
     *
     * @return Contact[]
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM contactos ORDER BY fecha DESC");
        $results = $stmt->fetchAll();

        $contacts = [];

        foreach ($results as $row) {
            $contact = new Contact(
                $row['nombre'],
                $row['email'],
                $row['asunto'],
                $row['mensaje']
            );

            $contact->setId((int) $row['id']);
            $contact->setFecha($row['fecha']);

            if ($row['leido'] === 1) {
                $contact->markAsRead();
            }

            $contacts[] = $contact;
        }

        return $contacts;
    }

    /**
     * Marca un contacto como leído
     *
     * @param int $id ID del contacto
     * @return bool
     */
    public function markAsRead(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE contactos SET leido = 1 WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}