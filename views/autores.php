<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$result = $conn->query("SELECT * FROM autores");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Autores</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css?v=3">
</head>
<body class="login-body5">

<div class="login-container" style="width:90%;">
    <h2>Autores</h2>

    <a href="dashboard.php">⬅ Volver</a>

    <br><br>

    <button onclick="window.location.href='agregar_autor.php'">Agregar Autor</button>

    <br><br>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Nacionalidad</th>
            <th>Acciones</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['nacionalidad']; ?></td>
            <td>
                <a href="editar_autor.php?id=<?php echo $row['id']; ?>">Editar</a> |
                <a href="../php/eliminar_autor.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>