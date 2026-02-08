<?php

class Usuario {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && hash('sha256', $password) === $usuario['password']) {
            return $usuario;
        }

        return false;
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($datos) {
        $sql = "INSERT INTO usuarios (nombre, email, password, rol) 
            VALUES (:nombre, :email, :password, :rol)";
        $stmt = $this->conn->prepare($sql);
    return $stmt->execute($datos);
}
}
