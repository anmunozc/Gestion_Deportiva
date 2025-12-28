<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistema Patín</title>
</head>
<body>

<h2>Ingreso al sistema</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Credenciales incorrectas</p>
<?php endif; ?>

<form method="POST" action="index.php?action=login">
    <input type="email" name="email" placeholder="Correo" required><br><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>
    <button type="submit">Ingresar</button>
</form>

</body>
</html>
