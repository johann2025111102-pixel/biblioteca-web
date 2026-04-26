<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM usuarios WHERE id = $id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>Editar Usuario</h2>

    <form action="../php/actualizar_usuario.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>">
        <input type="text" name="correo" value="<?php echo $user['correo']; ?>">

        <select name="rol">
            <option value="usuario" <?php if($user['rol']=="usuario") echo "selected"; ?>>Usuario</option>
            <option value="encargado" <?php if($user['rol']=="encargado") echo "selected"; ?>>Encargado</option>
        </select>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="usuarios.php">⬅ Volver</a>
</div>

</body>
</html>