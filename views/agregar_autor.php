<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Autor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>Agregar Autor</h2>

    <form action="../php/guardar_autor.php" method="POST">

        <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="nacionalidad" placeholder="Nacionalidad">

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="autores.php">⬅ Volver</a>
</div>

</body>
</html>