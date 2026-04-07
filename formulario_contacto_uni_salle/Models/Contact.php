<?php

declare(strict_types=1);

/**
 * Clase Contact - Representa un mensaje de contacto enviado desde el formulario
 * 
 * Esta clase es un modelo de dominio (Entity / Value Object).
 * Contiene los datos exactos que se almacenan en la tabla 'contactos'.
 */
class Contact
{
    private ?int $id = null;           // null hasta que se guarde en BD
    private string $nombre;
    private string $email;
    private string $asunto;
    private string $mensaje;
    private ?string $fecha = null;     // null hasta que BD lo asigne
    private int $leido = 0;            // 0 = pendiente, 1 = revisado

    /**
     * Constructor principal para crear un nuevo contacto desde el formulario
     */
    public function __construct(
        string $nombre,
        string $email,
        string $asunto,
        string $mensaje
    ) {
        $this->nombre  = trim($nombre);
        $this->email   = trim($email);
        $this->asunto  = trim($asunto);
        $this->mensaje = trim($mensaje);
    }

    // ────────────────────────────────────────────────
    // Getters
    // ────────────────────────────────────────────────

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAsunto(): string
    {
        return $this->asunto;
    }

    public function getMensaje(): string
    {
        return $this->mensaje;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function isLeido(): bool
    {
        return $this->leido === 1;
    }

    // ────────────────────────────────────────────────
    // Setters (solo los necesarios – id y fecha los pone la BD)
    // ────────────────────────────────────────────────

    /**
     * Solo lo usa el Repository al recuperar de BD
     */
    public function setId(int $id): void
    {
        if ($this->id !== null) {
            throw new Exception("No se puede modificar el ID de un contacto existente.");
        }
        $this->id = $id;
    }

    /**
     * Solo lo usa el Repository al recuperar de BD
     */
    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * Marcar como leído (para futura funcionalidad de administración)
     */
    public function markAsRead(): void
    {
        $this->leido = 1;
    }

    // ────────────────────────────────────────────────
    // Métodos útiles (para validación o presentación)
    // ────────────────────────────────────────────────

    public function toArray(): array
    {
        return [
            'id'      => $this->id,
            'nombre'  => $this->nombre,
            'email'   => $this->email,
            'asunto'  => $this->asunto,
            'mensaje' => $this->mensaje,
            'fecha'   => $this->fecha,
            'leido'   => $this->leido,
        ];
    }
}