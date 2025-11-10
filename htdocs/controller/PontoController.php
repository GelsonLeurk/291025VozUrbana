<?php
require_once __DIR__ . '/../model/PontoDAO.php';
require_once __DIR__ . '/../model/Ponto.php';

class PontoController {
    private $dao;

    public function __construct() {
        $this->dao = new PontoDAO();
    }

    // Página inicial (opcional)
    public function home() {
        include "view/home.php";
    }

    // Exibe o formulário de cadastro
    public function form() {
        include "view/form.php";
    }

    // Processa o envio do formulário
    public function salvar() {
        if (
            isset($_POST['tipo']) &&
            isset($_POST['descricao']) &&
            isset($_POST['latitude']) &&
            isset($_POST['longitude'])
        ) {
            $foto = null;

            // caminho físico do diretório de uploads
            $uploadDir = __DIR__ . '/../public/img/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $nomeArquivo = uniqid('img_', true) . '.' . $extensao;
                $caminhoFisico = $uploadDir . $nomeArquivo;
                $caminhoRelativo = 'public/img/uploads/' . $nomeArquivo;

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoFisico)) {
                    $foto = $caminhoRelativo;
                }
            }

            // validações básicas de lat/lng
            $lat = filter_var($_POST['latitude'], FILTER_VALIDATE_FLOAT);
            $lng = filter_var($_POST['longitude'], FILTER_VALIDATE_FLOAT);

            $ponto = new Ponto(
                null,
                trim($_POST['tipo']),
                trim($_POST['descricao']),
                $lat !== false ? $lat : $_POST['latitude'],
                $lng !== false ? $lng : $_POST['longitude'],
                $foto,
                date("Y-m-d H:i:s")
            );

            $this->dao->inserir($ponto);
        }

        header("Location: index.php?action=listar");
        exit;
    }

    // Lista todos os pontos cadastrados
    public function listar() {
        $pontos = $this->dao->todos();
        include "view/lista.php";
    }

    // Exibe um ponto específico no mapa (opcional)
    public function mapa($id) {
        $ponto = $this->dao->buscarPorId($id);
        if (!$ponto) {
            header("Location: index.php?action=listar");
            exit;
        }
        include __DIR__ . '/../view/mapa.php';
    }
}
?>