<?php
require_once "../../controllers/AuthController.php";
session_start();

AuthController::verificarSesion();
AuthController::verificarRol('entrenador');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Entrenador</title>
</head>
<body>

<h1>Panel del Entrenador</h1>
<p>Bienvenida, <?= $_SESSION['usuario']['nombre'] ?></p>

<hr>

<ul>
    <li><a href="../../index.php?action=registrar_entrenamiento">Registrar entrenamiento</a></li>
    <li><a href="../../index.php?action=ver_entrenamientos">Ver entrenamientos</a></li>
    <li><a href="../../index.php?action=logout">Cerrar sesión</a></li>
</ul>

</body>
</html>