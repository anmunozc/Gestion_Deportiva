<?php
// Protección de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION['usuario']['rol'] !== 'entrenador') {
    echo "Acceso no autorizado";
    exit;
}

// Conexión y modelo
require_once "config/database.php";
require_once "models/Entrenamiento.php";

$database = new Database();
$db = $database->getConnection();

$entrenamiento = new Entrenamiento($db);
$lista = $entrenamiento->obtenerPorAtleta($_SESSION['usuario']['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Entrenamientos</title>
</head>
<body>

<h2>Historial de Entrenamientos</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>Fecha</th>
        <th>Duración (min)</th>
        <th>Distancia (km)</th>
        <th>Tipo</th>
        <th>Sensación</th>
        <th>Observaciones</th>
    </tr>

    <?php while ($row = $lista->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['fecha']) ?></td>
            <td><?= htmlspecialchars($row['duracion']) ?></td>
            <td><?= htmlspecialchars($row['distancia']) ?></td>
            <td><?= htmlspecialchars($row['tipo_entrenamiento']) ?></td>
            <td><?= htmlspecialchars($row['sensacion']) ?></td>
            <td><?= htmlspecialchars($row['observaciones']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<br>

<a href="index.php?action=panel_entrenador">⬅ Volver al panel</a>

</body>
</html>
