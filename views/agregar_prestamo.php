<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

// Obtener usuarios
$usuarios = $conn->query("SELECT * FROM usuarios");

// Obtener libros disponibles
$libros = $conn->query("SELECT * FROM libros WHERE stock > 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Préstamo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>Nuevo Préstamo</h2>

    <form action="../php/guardar_prestamo.php" method="POST">

        <select name="usuario">
            <?php while($u = $usuarios->fetch_assoc()): ?>
                <option value="<?php echo $u['id']; ?>">
                    <?php echo $u['nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <select name="libro">
            <?php while($l = $libros->fetch_assoc()): ?>
                <option value="<?php echo $l['id']; ?>">
                    <?php echo $l['titulo']; ?> (Stock: <?php echo $l['stock']; ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Registrar</button>
    </form>

    <br>
    <a href="prestamos.php">⬅ Volver</a>
</div>

</body>
</html>