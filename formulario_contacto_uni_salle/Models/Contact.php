<?php
declare(strict_types=1);

class Contact
{
    private ?int $id = null;
    private string $nombre;
    private string $email;
    private string $asunto;
    private string $mensaje;
    private ?string $fecha = null;
    private int $leido = 0;

    
     // Constructor - Compatible con formulario y recuperación desde BD

    public function __construct(
        string $nombre = '',
        string $email = '',
        string $asunto = '',
        string $mensaje = ''
    ) {
        $this->nombre  = trim($nombre);
        $this->email   = trim($email);
        $this->asunto  = trim($asunto);
        $this->mensaje = trim($mensaje);
    }

    // Getters
    public function getId(): ?int     { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getEmail(): string  { return $this->email; }
    public function getAsunto(): string { return $this->asunto; }
    public function getMensaje(): string { return $this->mensaje; }
    public function getFecha(): ?string { return $this->fecha; }

    // Setters usados por el Repository
    public function setId(int $id): void
{
    $this->id = $id; 
}

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function markAsRead(): void
    {
        $this->leido = 1;
    }
}