<?php
// Protección de ruta
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION['usuario']['rol'] !== 'entrenador') {
    echo "Acceso no autorizado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Entrenador</title>
</head>
<body>

<h1>Panel del Entrenador</h1>

<p>
    Bienvenido, <strong><?= $_SESSION['usuario']['nombre'] ?></strong>
</p>

<hr>

<ul>
    <li>
        <a href="index.php?action=registrar_entrenamiento">
            Registrar entrenamiento
        </a>
    </li>
    <li>
        <a href="index.php?action=ver_entrenamientos">
            Ver entrenamientos
        </a>
    </li>
    <li>
        <a href="index.php?action=logout">
            Cerrar sesión
        </a>
    </li>
</ul>

</body>
</html>
