<?php
class Database {
    public static function getConnection() {
        // Verifica se as extensões PDO e pdo_mysql estão carregadas
        if (!extension_loaded('pdo') || !extension_loaded('pdo_mysql')) {
            throw new RuntimeException(
                "Extensão PDO MySQL não carregada. No Ubuntu: execute 'sudo apt update && sudo apt install -y php-mysql' e reinicie o servidor PHP. Verifique com 'php -m | grep -i pdo'."
            );
        }

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
            if (strpos($e->getMessage(), 'could not find driver') !== false) {
                throw new RuntimeException(
                    "Driver PDO para MySQL não encontrado. Instale a extensão 'php-mysql' (ex.: sudo apt update && sudo apt install -y php-mysql) e reinicie o PHP.",
                    0,
                    $e
                );
            }
            throw $e;
        }
    }
}

/* Exemplo de criação de tabela (mantido como comentário; não faça parte do PHP):
CREATE TABLE IF NOT EXISTS pontos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo VARCHAR(255) NOT NULL,
  descricao TEXT,
  latitude DECIMAL(10,8),
  longitude DECIMAL(11,8),
  foto VARCHAR(255),
  data_envio DATETIME
);
*/