<?php
class Ponto {
    public $id;
    public $tipo;
    public $descricao;
    public $latitude;
    public $longitude;
    public $foto;
    public $data_envio;

    public function __construct($id, $tipo, $descricao, $latitude, $longitude, $foto = null, $data_envio = null) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->foto = $foto;
        $this->data_envio = $data_envio;
    }
}
?>