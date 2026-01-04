<?php
require_once __DIR__ . "/../models/Usuario.php";

class AuthController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($email, $password) {

        $usuario = new Usuario($this->db);
        $resultado = $usuario->login($email, $password);

        if ($resultado) {
            $_SESSION['usuario'] = $resultado;

            if ($resultado['rol'] === 'entrenador') {
                header("Location: index.php?action=panel_entrenador");
                exit;
            } else {
                header("Location: index.php?action=panel_atleta");
                exit;
            }
        } else {
            header("Location: index.php?error=1");
            exit;
        }
    }
}
