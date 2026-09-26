<?php
declare(strict_types=1);

class Database
{
    private string $host = 'localhost';
    private string $db_name = 'url-shortify';
    private string $username = 'root';
    private string $password = '';
    private string $charset = 'utf8mb4';

    private ?PDO $conn = null;

    public function getConnection(): PDO
    {
        if ($this->conn === null) {

            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
            ];

            try {
                $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            } catch (PDOException $e) {
                // In production, log this instead of showing
                die("Database Connection Failed: " . $e->getMessage());
            }
        }

        return $this->conn;
    }
}
