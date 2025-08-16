<?php
namespace Src\Models;
class Cita {
    public ?int $id;
    public string $nombre;
    public string $especialidad;
    public string $fecha;

    public function __construct(?int $id, string $nombre, string $especialidad, string $fecha) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->especialidad = $especialidad;
        $this->fecha = $fecha;
    }
}
