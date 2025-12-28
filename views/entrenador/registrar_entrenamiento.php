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
    <title>Registrar Entrenamiento</title>
</head>
<body>

<h2>Registrar Entrenamiento</h2>

<form method="POST" action="index.php?action=guardar_entrenamiento">

    <label>Fecha</label><br>
    <input type="date" name="fecha" required><br><br>

    <label>Duración (minutos)</label><br>
    <input type="number" name="duracion" required><br><br>

    <label>Distancia (km)</label><br>
    <input type="number" step="0.01" name="distancia"><br><br>

    <label>Tipo de entrenamiento</label><br>
    <input type="text" name="tipo_entrenamiento"><br><br>

    <label>Sensación</label><br>
    <select name="sensacion">
        <option value="Buena">Buena</option>
        <option value="Media">Media</option>
        <option value="Mala">Mala</option>
    </select><br><br>

    <label>Observaciones</label><br>
    <textarea name="observaciones"></textarea><br><br>

    <button type="submit">Guardar entrenamiento</button>

</form>

<br>
<a href="index.php?action=panel_entrenador">⬅ Volver al panel</a>

</body>
</html>