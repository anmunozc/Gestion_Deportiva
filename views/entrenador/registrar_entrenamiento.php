<?php
require_once "../../controllers/AuthController.php";
session_start();

AuthController::verificarSesion();
AuthController::verificarRol('entrenador');
?>

<h2>Registrar Entrenamiento</h2>

<form method="POST" action="../../index.php?action=guardar_entrenamiento">

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