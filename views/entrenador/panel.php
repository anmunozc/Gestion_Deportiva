<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Entrenador</title>
</head>
<body>

<h1>Panel del Entrenador</h1>
<p>Bienvenido, <?= $_SESSION['usuario']['nombre'] ?></p>

<hr>

<ul>
    <li><a href="index.php?action=registrar_entrenamiento">Registrar entrenamiento</a></li>
    <li><a href="index.php?action=logout">Cerrar sesión</a></li>
</ul>

</body>
</html>
