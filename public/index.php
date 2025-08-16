<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Src\Config\Database;
use Src\Repositories\CitaRepository;
use Src\Services\CitaService;
use Src\Controllers\CitaController;

// Inicializar DB
$db = new Database();
$pdo = $db->getConnection();

// Inyectar dependencias
$citaRepo = new CitaRepository($pdo);
$citaService = new CitaService($citaRepo);
$citaController = new CitaController($citaService);

// Ruteo simple usando ?action=
$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'create':
        $citaController->create();
        break;
    case 'store':
        $citaController->store($_POST);
        break;
    case 'delete':
        $citaController->delete($_POST['id']);
        break;
    case 'list':
    default:
        $citaController->index();
        break;
}

// Cerrar conexión
$db->closeConnection();
