<?php

class Entrenamiento {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function guardar($datos) {
        $sql = "INSERT INTO entrenamientos 
        (usuario_id, fecha, duracion, distancia, tipo_entrenamiento, sensacion, observaciones)
        VALUES 
        (:usuario_id, :fecha, :duracion, :distancia, :tipo_entrenamiento, :sensacion, :observaciones)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($datos);
    }

    public function obtenerPorUsuario($usuario_id) {
        $sql = "SELECT * 
                FROM entrenamientos 
                WHERE usuario_id = :usuario_id 
                ORDER BY fecha DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        return $stmt;
    }
}