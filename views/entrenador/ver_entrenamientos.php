<?php
session_start();
require_once "../../config/database.php";
require_once "../../models/Entrenamiento.php";

if ($_SESSION['rol'] !== 'entrenador') {
    header("Location: ../auth/login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();

$entrenamiento = new Entrenamiento($db);
$lista = $entrenamiento->obtenerPorAtleta($_GET['atleta_id']);
?>

<h2>Historial de Entrenamientos</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>Fecha</th>
        <th>Duración (min)</th>
        <th>Distancia (km)</th>
        <th>Carga</th>
        <th>Sensaciones</th>
    </tr>

    <?php while ($row = $lista->fetch(PDO::FETCH_ASSOC)) : ?>
    <tr>
        <td><?= $row['fecha'] ?></td>
        <td><?= $row['duracion'] ?></td>
        <td><?= $row['distancia'] ?></td>
        <td><?= $row['carga'] ?></td>
        <td><?= $row['sensaciones'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>