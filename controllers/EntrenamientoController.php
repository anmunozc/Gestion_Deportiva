<?php
require_once "models/Entrenamiento.php";
require_once "controllers/AuthController.php";

class EntrenamientoController {

    private $entrenamiento;

    public function __construct($db) {
        $this->entrenamiento = new Entrenamiento($db);
    }

    public function guardar() {

        AuthController::verificarSesion();
        AuthController::verificarRol('entrenador');

        $datos = [
            'usuario_id' => $_SESSION['usuario']['id'],
            'fecha' => $_POST['fecha'],
            'duracion' => $_POST['duracion'],
            'distancia' => $_POST['distancia'],
            'tipo_entrenamiento' => $_POST['tipo_entrenamiento'],
            'sensacion' => $_POST['sensacion'],
            'observaciones' => $_POST['observaciones']
        ];

        $this->entrenamiento->guardar($datos);

        header("Location: index.php?action=panel_entrenador");
        exit;
    }
}