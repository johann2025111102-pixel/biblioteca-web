<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// PROTEGER ACCESO
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css?v=3">
</head>
<body class="login-body2">

<div class="login-container">
    <h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>
    <p>Rol: <?php echo $_SESSION['rol']; ?></p>

    <hr>

    <?php if($_SESSION['rol'] == 'encargado'): ?>
        <h3>Panel Administrador</h3>
        <ul>
            <li><a href="libros.php">Gestionar Libros</a></li>
            <li><a href="autores.php">Gestionar Autores</a></li>
            <li><a href="usuarios.php">Gestionar Usuarios</a></li>
            <li><a href="prestamos.php">Gestionar Préstamos</a></li>
        </ul>
    <?php else: ?>
        <h3>Panel Usuario</h3>
        <ul>
            <li><a href="libros.php">Ver Libros</a></li>
            <li><a href="mis_prestamos.php">Mis Préstamos</a></li>
        </ul>
    <?php endif; ?>

    <br>
    <a href="../php/logout.php">Cerrar sesión</a>
</div>

</body>
</html>