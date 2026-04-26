<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM autores WHERE id = $id");
$autor = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Autor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>Editar Autor</h2>

    <form action="../php/actualizar_autor.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $autor['id']; ?>">

        <input type="text" name="nombre" value="<?php echo $autor['nombre']; ?>">
        <input type="text" name="nacionalidad" value="<?php echo $autor['nacionalidad']; ?>">

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="autores.php">⬅ Volver</a>
</div>

</body>
</html>