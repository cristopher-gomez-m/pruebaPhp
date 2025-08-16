<?php
namespace Src\Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private ?PDO $pdo = null;
    private int $timeout = 30; // segundos

    public function __construct() {
        $this->connect();
    }

    private function connect(): void {
        // Cargar variables de entorno
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $port = $_ENV['DB_PORT'] ?? '3306';
        $dbname = $_ENV['DB_NAME'] ?? '';
        $user = $_ENV['DB_USER'] ?? '';
        $pass = $_ENV['DB_PASS'] ?? '';

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => $this->timeout
            ]);
            error_log('✅ Conexión PDO exitosa');
        } catch (PDOException $e) {
            error_log('❌ Error PDO: ' . $e->getMessage());
            // Intento de reconexión
            sleep(1);
            $this->reconnect($dsn, $user, $pass);
        }
    }

    private function reconnect(string $dsn, string $user, string $pass): void {
        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => $this->timeout
            ]);
            error_log('🔄 Reconexión PDO exitosa');
        } catch (PDOException $e) {
            error_log('❌ Reconexión fallida: ' . $e->getMessage());
            die("No se pudo conectar a la base de datos." . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        if (!$this->pdo) {
            $this->connect();
        }
        return $this->pdo;
    }

    public function closeConnection(): void {
        $this->pdo = null; // Cierra la conexión explícitamente
        error_log('🔒 Conexión PDO cerrada');
    }
}
