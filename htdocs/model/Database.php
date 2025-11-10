<?php
class Database {
    private static $instance = null;

    // Construtor privado para evitar múltiplas instâncias
    private function __construct() {}

    // Método estático para obter a conexão
    public static function getConnection() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO( 
                    "mysql:host=sql100.infinityfree.com;dbname=if0_40287163_problemas;charset=utf8",
                    "if0_40287163",
                    "IgRbA9j1rN"
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Exibe erro genérico para o usuário e registra o erro técnico
                error_log("Erro na conexão com o banco: " . $e->getMessage());
                die("Não foi possível conectar ao banco de dados.");
            }
        }
        return self::$instance;
    }
}
?>