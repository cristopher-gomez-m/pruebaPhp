<?php
namespace Src\Repositories;

use Src\Models\Cita;
use PDO;

class CitaRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(): array
    {
        $statement = $this->pdo->query("SELECT * FROM citas ORDER BY fecha ASC");
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            fn($row) =>
            new Cita($row['id'], $row['nombre'], $row['especialidad'], $row['fecha']),
            $rows
        );
    }

    public function findById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM citas WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC); // devuelve un array asociativo o false si no hay resultado
    }


    public function save(Cita $cita): bool
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO citas (nombre, especialidad, fecha) VALUES (?, ?, ?)"
        );
        return $statement->execute([$cita->nombre, $cita->especialidad, $cita->fecha]);
    }

    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM citas WHERE id = ?");
        return $statement->execute([$id]);
    }
}
