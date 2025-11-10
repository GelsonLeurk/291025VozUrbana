<?php
require_once "model/Database.php";
require_once "model/Ponto.php";

class PontoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Insere um novo ponto no banco
    public function inserir(Ponto $ponto) {
        $sql = "INSERT INTO problemas (tipo, descricao, latitude, longitude, foto, data_envio)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $ponto->tipo,
            $ponto->descricao,
            $ponto->latitude,
            $ponto->longitude,
            $ponto->foto,
            $ponto->data_envio
        ]);
    }

    // Retorna todos os pontos cadastrados
    public function todos() {
        $stmt = $this->pdo->query("SELECT * FROM problemas ORDER BY data_envio DESC");
        $pontos = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pontos[] = new Ponto(
                $row['id'],
                $row['tipo'],
                $row['descricao'],
                $row['latitude'],
                $row['longitude'],
                $row['foto'],
                $row['data_envio']
            );
        }

        return $pontos;
    }

    // Busca um ponto específico pelo ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM problemas WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Ponto(
                $row['id'],
                $row['tipo'],
                $row['descricao'],
                $row['latitude'],
                $row['longitude'],
                $row['foto'],
                $row['data_envio']
            );
        }

        return null;
    }
}
?>