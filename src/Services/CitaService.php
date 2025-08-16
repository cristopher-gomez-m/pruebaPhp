<?php
namespace Src\Services;

use Src\Repositories\CitaRepository;
use Src\Models\Cita;
use Exception;

class CitaService
{
    private CitaRepository $repo;

    public function __construct(CitaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listar(): array
    {
        return $this->repo->all();
    }

    public function crear(string $nombre, string $especialidad, string $fecha): bool
    {
        // Validación: solo letras y espacios
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
            throw new Exception("El nombre solo puede contener letras y espacios");
        }

        // Validación de fecha
        if (strtotime($fecha) < strtotime(date("Y-m-d"))) {
            throw new Exception("La fecha no puede estar en el pasado");
        }

        $cita = new Cita(null, $nombre, $especialidad, $fecha);
        return $this->repo->save($cita);
    }

    public function eliminar(int $id): bool
    {
        $cita = $this->repo->findById($id);
        if (!$cita) {
            throw new Exception("Cita no encontrada");
        }
        return $this->repo->delete($id);
    }
}
