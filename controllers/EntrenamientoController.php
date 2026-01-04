<?php
require_once __DIR__ . "/../models/Entrenamiento.php";

class EntrenamientoController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function guardar() {

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }

        $entrenamiento = new Entrenamiento($this->db);

        $datos = [
            'usuario_id' => $_SESSION['usuario']['id'],
            'fecha' => $_POST['fecha'],
            'duracion' => $_POST['duracion'],
            'distancia' => $_POST['distancia'],
            'tipo_entrenamiento' => $_POST['tipo_entrenamiento'],
            'sensacion' => $_POST['sensacion'],
            'observaciones' => $_POST['observaciones']
        ];

        $entrenamiento->guardar($datos);

        header("Location: index.php?action=ver_entrenamientos");
        exit;
    }

    public function verEntrenamientos() {

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }

        $entrenamiento = new Entrenamiento($this->db);
        return $entrenamiento->obtenerPorAtleta($_SESSION['usuario']['id']);
    }
}
