<?php
session_start();

require_once "config/database.php";
require_once "controllers/AuthController.php";
require_once "controllers/EntrenamientoController.php";

$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? 'login_form';

switch ($action) {

    case 'login':
        $auth = new AuthController($db);
        $auth->login($_POST['email'], $_POST['password']);
        break;

    case 'panel_entrenador':
        require_once "views/entrenador/panel.php";
        break;

    case 'registrar_entrenamiento':
        require_once "views/entrenador/registrar_entrenamiento.php";
        break;

    case 'guardar_entrenamiento':
        $controller = new EntrenamientoController($db);
        $controller->guardar();
        break;

    case 'ver_entrenamientos':
        $controller = new EntrenamientoController($db);
        $lista = $controller->verEntrenamientos();
        require_once "views/entrenador/ver_entrenamientos.php";
        break;

    default:
        require_once "views/auth/login.php";
        break;
}
