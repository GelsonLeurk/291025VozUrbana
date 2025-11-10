<?php 
require_once "model/Ponto.php";
require_once "model/PontoDAO.php";

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

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $nomeArquivo = uniqid() . "." . $extensao;
                $caminho = "public/img/uploads/" . $nomeArquivo;

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho)) {
                    $foto = $caminho;
                }
            }

            $ponto = new Ponto(
                null,
                $_POST['tipo'],
                $_POST['descricao'],
                $_POST['latitude'],
                $_POST['longitude'],
                $foto,
                date("Y-m-d H:i:s")
            );

            $this->dao->inserir($ponto);
        }

        header("Location: index.php?action=listar");
    }

    // Lista todos os pontos cadastrados
    public function listar() {
        $pontos = $this->dao->todos();
        include "view/lista.php";
    }

    // Exibe um ponto específico no mapa (opcional)
    public function mapa($id) {
        $ponto = $this->dao->buscarPorId($id);
        include "view/mapa.php";
    }
}
?>