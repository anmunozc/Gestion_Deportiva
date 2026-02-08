<?php
require_once 'models/Usuario.php';

class UsuarioController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registrarAtleta() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuarioModel = new Usuario($this->db);
            
            // Recibimos datos del formulario de gestionar_atletas.php
            $datos = [
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                // Usamos password_hash para seguridad, o texto plano si aún no implementas hash
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'rol' => 'atleta'
            ];

            if ($usuarioModel->registrar($datos)) {
                header("Location: index.php?action=gestionar_atletas&status=success");
            } else {
                echo "Error al registrar el atleta.";
            }
        }
    }
}