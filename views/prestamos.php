<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$sql = "SELECT prestamos.*, usuarios.nombre 
        FROM prestamos
        JOIN usuarios ON prestamos.id_usuario = usuarios.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Préstamos</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css?v=3">
</head>
<body class="login-body7">

<div class="login-container" style="width:90%;">
    <h2>Préstamos</h2>

    <a href="dashboard.php">⬅ Volver</a>

    <br><br>

    <button onclick="window.location.href='agregar_prestamo.php'">Nuevo Préstamo</button>

    <br><br>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Fecha préstamo</th>
            <th>Fecha devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['fecha_prestamo']; ?></td>
            <td><?php echo $row['fecha_devolucion']; ?></td>
            <td><?php echo $row['estado']; ?></td>
            <td>
                <?php if($row['estado'] == 'prestado'): ?>
                    <a href="../php/devolver.php?id=<?php echo $row['id']; ?>">Devolver</a>
                <?php else: ?>
                    ✔ Devuelto
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>