<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'entrenador') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Entrenamientos</title>
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
            <td><?= $row['fecha'] ?></td>
            <td><?= $row['duracion'] ?></td>
            <td><?= $row['distancia'] ?></td>
            <td><?= $row['tipo_entrenamiento'] ?></td>
            <td><?= $row['sensacion'] ?></td>
            <td><?= $row['observaciones'] ?></td>
        </tr>
    <?php endwhile; ?>

</table>

<br>
<a href="index.php?action=panel_entrenador">Volver al panel</a>

</body>
</html>