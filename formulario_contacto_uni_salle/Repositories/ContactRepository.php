<?php
declare(strict_types=1);

require_once __DIR__ . '/../Models/Contact.php';

class ContactRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Contact $contact): bool
    {
        $sql = "INSERT INTO contactos (nombre, email, asunto, mensaje)
                VALUES (:nombre, :email, :asunto, :mensaje)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute([
                ':nombre'  => $contact->getNombre(),
                ':email'   => $contact->getEmail(),
                ':asunto'  => $contact->getAsunto(),
                ':mensaje' => $contact->getMensaje(),
            ]);

            if ($success) {
                $id = (int)$this->pdo->lastInsertId();
                $contact->setId($id);

                $stmtFecha = $this->pdo->prepare("SELECT fecha FROM contactos WHERE id = ?");
                $stmtFecha->execute([$id]);
                $contact->setFecha($stmtFecha->fetchColumn());
            }
            return $success;
        } catch (PDOException $e) {
            error_log("Error guardando contacto: " . $e->getMessage());
            return false;
        }
    }

   public function findAll(): array
{
    $sql = "SELECT id, nombre, email, asunto, mensaje, 
                   DATE_FORMAT(fecha, '%d/%m/%Y %H:%i') as fecha
            FROM contactos ORDER BY fecha DESC";
    
    $stmt = $this->pdo->query($sql); // usa query() en vez de prepare+execute
    
    if (!$stmt) {
        error_log("Error en findAll: " . implode(' | ', $this->pdo->errorInfo()));
        return [];
    }
    
    $contacts = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        try {
            $contacts[] = $this->mapRowToContact($row);
        } catch (Exception $e) {
            error_log("Error mapeando contacto: " . $e->getMessage());
        }
    }
    return $contacts;
}

    private function mapRowToContact(array $row): Contact
    {
        $contact = new Contact(
            $row['nombre'] ?? '',
            $row['email'] ?? '',
            $row['asunto'] ?? '',
            $row['mensaje'] ?? ''
        );

        if (isset($row['id'])) $contact->setId((int)$row['id']);
        if (isset($row['fecha'])) $contact->setFecha((string)$row['fecha']);
        if (isset($row['leido']) && (int)$row['leido'] === 1) {
            $contact->markAsRead();
        }

        return $contact;
    }
}