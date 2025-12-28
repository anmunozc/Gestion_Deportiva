<?php
session_start();

require_once "config/database.php";
require_once "controllers/AuthController.php";
require_once "controllers/EntrenamientoController.php";

// Conexión DB
$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? 'login_form';

switch ($action) {

    case 'login':
        $auth = new AuthController($db);
        $auth->login($_POST['email'], $_POST['password']);
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php");
        exit;

    case 'panel_entrenador':
        AuthController::verificarSesion();
        AuthController::verificarRol('entrenador');
        require_once "views/entrenador/panel.php";
        break;

    case 'registrar_entrenamiento':
        AuthController::verificarSesion();
        AuthController::verificarRol('entrenador');
        require_once "views/entrenador/registrar_entrenamiento.php";
        break;

    case 'guardar_entrenamiento':
        AuthController::verificarSesion();
        $controller = new EntrenamientoController();
        $controller->guardar();
        break;

    default:
        require_once "views/auth/login.php";
        break;
}
