<?php
require_once 'models/Entrenamiento.php';
require_once 'models/Usuario.php';

class EntrenamientoController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function mostrarPanel() {
        $entrenamientoModel = new Entrenamiento($this->db);
        $usuario_id = $_SESSION['usuario']['id'];
        $atletas = $entrenamientoModel->obtenerAtletas();
        $resumenSemanal = $entrenamientoModel->obtenerResumenSemanal($usuario_id);
        require_once "views/entrenador/panel.php"; 
    }

    // --- NUEVO: Ver la Biblioteca (Solo plantillas: atleta_id es NULL) ---
    public function verBiblioteca() {
        $entrenamientoModel = new Entrenamiento($this->db);
        $usuario_id = $_SESSION['usuario']['id'];
        
        // Obtenemos solo los registros donde NO hay atleta asignado
        $biblioteca = $entrenamientoModel->obtenerPlantillas($usuario_id);
        $atletas = $entrenamientoModel->obtenerAtletas();
        
        require_once "views/entrenador/biblioteca.php";
    }

    public function verEntrenamientos() {
        $entrenamientoModel = new Entrenamiento($this->db);
        $usuario_id = $_SESSION['usuario']['id'];
        $lista = $entrenamientoModel->obtenerPorEntrenador($usuario_id);
        $atletas = $entrenamientoModel->obtenerAtletas();
        require_once "views/entrenador/ver_entrenamientos.php";
    }

    public function registrarEntrenamiento() {
        $entrenamientoModel = new Entrenamiento($this->db);
        $atletas = $entrenamientoModel->obtenerAtletas();
        require_once "views/entrenador/registrar_entrenamiento.php";
    }

    public function guardarEntrenamiento() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $entrenamientoModel = new Entrenamiento($this->db);
            
            // Si el atleta_id viene vacío del formulario, se guarda como NULL (Plantilla)
            $atleta_id = !empty($_POST['atleta_id']) ? $_POST['atleta_id'] : null;
            
            $datos = [
                'usuario_id' => $_SESSION['usuario']['id'],
                'atleta_id' => $atleta_id,
                'fecha' => $_POST['fecha'],
                'duracion' => $_POST['duracion'],
                'distancia' => $_POST['distancia'],
                'tipo_entrenamiento' => $_POST['tipo_entrenamiento'],
                'observaciones' => $_POST['observaciones']
            ];
            
            $entrenamientoModel->guardar($datos);
            
            // Redirección inteligente
            if ($atleta_id === null) {
                header("Location: index.php?action=ver_biblioteca&status=saved");
            } else {
                header("Location: index.php?action=ver_entrenamientos");
            }
        }
    }

    // --- NUEVO: Ejecutar la asignación de una plantilla a un atleta ---
    public function ejecutarAsignacion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $entrenamientoModel = new Entrenamiento($this->db);
            
            // Creamos un registro nuevo basado en la plantilla, pero con atleta y fecha nueva
            $datos = [
                'usuario_id' => $_SESSION['usuario']['id'],
                'atleta_id' => $_POST['atleta_id'],
                'fecha' => $_POST['fecha'],
                'duracion' => $_POST['duracion'],
                'distancia' => $_POST['distancia'],
                'tipo_entrenamiento' => $_POST['tipo_entrenamiento'],
                'observaciones' => $_POST['observaciones']
            ];
            
            $entrenamientoModel->guardar($datos);
            header("Location: index.php?action=ver_entrenamientos&assigned=true");
        }
    }

    public function gestionarAtletas() {
        $entrenamientoModel = new Entrenamiento($this->db);
        $atletas = $entrenamientoModel->obtenerAtletas();
        require_once "views/entrenador/gestionar_atletas.php";
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $entrenamientoModel = new Entrenamiento($this->db);
            $id = $_POST['id'];
            $datos = [
                'atleta_id' => $_POST['atleta_id'],
                'fecha' => $_POST['fecha'],
                'duracion' => $_POST['duracion'],
                'distancia' => $_POST['distancia'],
                'tipo_entrenamiento' => $_POST['tipo_entrenamiento'],
                'observaciones' => $_POST['observaciones']
            ];
            $entrenamientoModel->actualizar($id, $datos);
            header("Location: index.php?action=ver_entrenamientos");
        }
    }
}