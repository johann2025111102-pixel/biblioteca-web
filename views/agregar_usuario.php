<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>Agregar Usuario</h2>

    <form action="../php/guardar_usuario.php" method="POST" onsubmit="return validarForm()">

        <input type="text" name="nombre" id="nombre" placeholder="Nombre">
        <input type="text" name="correo" id="correo" placeholder="Correo">
        <input type="password" name="password" id="password" placeholder="Contraseña">

        <select name="rol">
            <option value="usuario">Usuario</option>
            <option value="encargado">Encargado</option>
        </select>

        <button type="submit">Guardar</button>
    </form>

    <p id="error" style="color:red;"></p>

    <br>
    <a href="usuarios.php">⬅ Volver</a>
</div>

<script>
function validarForm() {
    let nombre = document.getElementById("nombre").value;
    let correo = document.getElementById("correo").value;
    let password = document.getElementById("password").value;
    let error = document.getElementById("error");

    let regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,}$/;
    let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let regexPass = /^(?=.*[A-Z])(?=.*\d).{6,}$/;

    if (!regexNombre.test(nombre)) {
        error.innerText = "Nombre inválido";
        return false;
    }

    if (!regexCorreo.test(correo)) {
        error.innerText = "Correo inválido";
        return false;
    }

    if (!regexPass.test(password)) {
        error.innerText = "Contraseña débil";
        return false;
    }

    return true;
}
</script>

</body>
</html>