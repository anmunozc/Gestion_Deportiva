<?php
class Entrenamiento {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function guardar($datos) {
        $sql = "INSERT INTO entrenamientos 
                (usuario_id, atleta_id, fecha, duracion, distancia, tipo_entrenamiento, observaciones)
                VALUES 
                (:usuario_id, :atleta_id, :fecha, :duracion, :distancia, :tipo_entrenamiento, :observaciones)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($datos);
    }

    public function obtenerAtletas() {
        $sql = "SELECT id, nombre, email FROM usuarios WHERE rol = 'atleta' ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // NUEVO: Obtener solo las plantillas (donde atleta_id es NULL)
    public function obtenerPlantillas($usuario_id) {
        $sql = "SELECT * FROM entrenamientos 
                WHERE usuario_id = :usuario_id 
                AND atleta_id IS NULL 
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorEntrenador($usuario_id) {
        // Cambiamos JOIN por LEFT JOIN para que se vean los entrenamientos 
        // aunque el atleta_id sea NULL (plantillas) en el listado general
        $sql = "SELECT e.*, u.nombre as nombre_atleta 
                FROM entrenamientos e
                LEFT JOIN usuarios u ON e.atleta_id = u.id
                WHERE e.usuario_id = :usuario_id
                ORDER BY e.fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerResumenSemanal($usuario_id) {
        // Nota: Solo sumamos minutos de entrenamientos asignados a atletas reales
        $sql = "SELECT DATE(fecha) as dia, SUM(duracion) as total_minutos 
                FROM entrenamientos 
                WHERE usuario_id = :usuario_id 
                AND atleta_id IS NOT NULL
                AND fecha >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                GROUP BY DATE(fecha) 
                ORDER BY DATE(fecha) ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $datos) {
        $sql = "UPDATE entrenamientos SET 
                atleta_id = :atleta_id,
                fecha = :fecha, 
                duracion = :duracion, 
                distancia = :distancia, 
                tipo_entrenamiento = :tipo_entrenamiento, 
                observaciones = :observaciones 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $datos['id'] = $id; 
        return $stmt->execute($datos);
    }
}