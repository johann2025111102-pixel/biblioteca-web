<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css?v=3">
    <title>Login Biblioteca</title>
</head>

<script>
    function validarForm() {
        return true;
    }
</script>

<body class="login-body">
    

    <div class="login-container">
        <h1>Bienvenido a la biblioteca John MZ</h1>
        <h2>Iniciar Sesión</h2>

        <form action="php/login_process.php" method="POST" onsubmit="return validarForm()">
            <input type="text" name="correo" id="correo" placeholder="Correo">
            <input type="password" name="password" id="password" placeholder="Contraseña">
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>

</html>