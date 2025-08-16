<?php
namespace Src\Controllers;

use Src\Services\CitaService;
use Exception;

class CitaController
{
    private CitaService $service;

    public function __construct(CitaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $citas = $this->service->listar();
        include __DIR__ . '/../views/citas-list.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/citas-create.php';
    }


    public function store($post)
    {
        try {
            $nombre = $post['nombre'] ?? '';
            $especialidad = $post['especialidad'] ?? '';
            $fecha = $post['fecha'] ?? '';


            $this->service->crear($nombre, $especialidad, $fecha);

            header("Location: index.php?route=citas/index");
        } catch (Exception $e) {
            $error = $e->getMessage();
            include __DIR__ . '/../views/citas-create.php';
        }
    }

    public function delete($id)
    {
        $this->service->eliminar((int) $id);
        header('Location: index.php?deleted=1');
        exit;
    }
}
