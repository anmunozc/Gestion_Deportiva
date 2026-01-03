<?php
require_once "models/Entrenamiento.php";
require_once "config/database.php";

class EntrenamientoController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function guardar() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }

        $datos = [
            'usuario_id' => $_SESSION['usuario']['id'],
            'fecha' => $_POST['fecha'],
            'duracion' => $_POST['duracion'],
            'distancia' => $_POST['distancia'],
            'tipo_entrenamiento' => $_POST['tipo_entrenamiento'],
            'sensacion' => $_POST['sensacion'],
            'observaciones' => $_POST['observaciones']
        ];

        $entrenamiento = new Entrenamiento($this->db);
        $entrenamiento->guardar($datos);

        header("Location: index.php?action=ver_entrenamientos");
        exit;
    }

    public function verEntrenamientos() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }

        $entrenamiento = new Entrenamiento($this->db);
        $lista = $entrenamiento->obtenerPorUsuario($_SESSION['usuario']['id']);

        require_once "views/entrenador/ver_entrenamientos.php";
    }
}