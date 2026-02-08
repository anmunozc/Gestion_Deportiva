<?php
session_start();

require_once "config/database.php";
require_once "controllers/AuthController.php";
require_once "controllers/EntrenamientoController.php";
require_once "controllers/UsuarioController.php"; 

$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? 'login_form';

//--- Capa de protección ---
$rutas_publicas = ['login_form', 'login'];
if (!isset($_SESSION['usuario']) && !in_array($action, $rutas_publicas)) {
    header("Location: index.php?action=login_form");
    exit();
}

switch ($action) {
    case 'login':
        $auth = new AuthController($db);
        $auth->login($_POST['email'], $_POST['password']);
        break;

    case 'panel_entrenador':
        $controller = new EntrenamientoController($db);
        $controller->mostrarPanel();
        break;

    case 'registrar_entrenamiento':
        $controller = new EntrenamientoController($db);
        $controller->registrarEntrenamiento(); 
        break;

    case 'guardar_entrenamiento':
        $controller = new EntrenamientoController($db);
        $controller->guardarEntrenamiento(); 
        break;

    // --- NUEVAS RUTAS DE BIBLIOTECA ---
    case 'ver_biblioteca':
        $controller = new EntrenamientoController($db);
        $controller->verBiblioteca();
        break;

    case 'ejecutar_asignacion':
        $controller = new EntrenamientoController($db);
        $controller->ejecutarAsignacion();
        break;
    // ---------------------------------

    case 'ver_entrenamientos':
        $controller = new EntrenamientoController($db);
        $controller->verEntrenamientos(); 
        break;

    case 'editar_entrenamiento':
        $controller = new EntrenamientoController($db);
        $controller->editar(); 
        break;

    case 'gestionar_atletas':
        $controller = new EntrenamientoController($db);
        $controller->gestionarAtletas(); 
        break;

    case 'registrar_atleta':
        $controller = new UsuarioController($db);
        $controller->registrarAtleta();
        break;    

    case 'logout':
        session_destroy();
        header("Location: index.php?action=login_form");
        break;

    default:
        require_once "views/auth/login.php";
        break;
}