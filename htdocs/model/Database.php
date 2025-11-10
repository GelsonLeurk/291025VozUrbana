<?php
class Database {
    public static function getConnection() {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $dbname = getenv('DB_NAME') ?: 'vozurbana';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';

        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]);
            return $pdo;
        } catch (PDOException $e) {
            // não exibir erros em produção; aqui apenas lança para dev
            throw $e;
        }
    }
}
?>