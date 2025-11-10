<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "controller/PontoController.php";

$controller = new PontoController();

$action = $_GET['action'] ?? 'home';

if (method_exists($controller, $action)) {
    if ($action === 'mapa' && isset($_GET['id'])) {
        $controller->mapa($_GET['id']);
    } else {
        $controller->$action();
    }
} else {
    $controller->home();
}
