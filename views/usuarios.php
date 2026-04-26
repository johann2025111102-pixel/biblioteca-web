<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$result = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css?v=3">
</head>
<body class="login-body6">

<div class="login-container" style="width:90%;">
    <h2>Usuarios</h2>

    <a href="dashboard.php">⬅ Volver</a>

    <br><br>

    <button onclick="window.location.href='agregar_usuario.php'">Agregar Usuario</button>

    <br><br>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['rol']; ?></td>
            <td>
                <a href="editar_usuario.php?id=<?php echo $row['id']; ?>">Editar</a> |
                <a href="../php/eliminar_usuario.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>