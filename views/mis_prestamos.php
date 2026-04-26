<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Obtener ID del usuario
$sqlUser = "SELECT id FROM usuarios WHERE nombre = '$usuario'";
$resultUser = $conn->query($sqlUser);
$user = $resultUser->fetch_assoc();

$id_usuario = $user['id'];

// Obtener préstamos del usuario
$sql = "SELECT prestamos.*, libros.titulo
        FROM prestamos
        JOIN detalle_prestamo ON prestamos.id = detalle_prestamo.id_prestamo
        JOIN libros ON detalle_prestamo.id_libro = libros.id
        WHERE prestamos.id_usuario = $id_usuario";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mis Préstamos</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css?v=3">
</head>
<body class="login-body4">

<div class="login-container" style="width:90%;">
    <h2>Mis Préstamos</h2>

    <a href="dashboard.php">⬅ Volver</a>

    <br><br>

    <table border="1" width="100%">
        <tr>
            <th>Libro</th>
            <th>Fecha préstamo</th>
            <th>Fecha devolución</th>
            <th>Estado</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['fecha_prestamo']; ?></td>
            <td><?php echo $row['fecha_devolucion']; ?></td>
            <td><?php echo $row['estado']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>