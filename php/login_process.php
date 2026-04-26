<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

$correo = $_POST['correo'];
$password = $_POST['password'];

// VALIDACIONES CON REGEX (BACKEND)
if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $correo)) {
    die("Correo inválido");
}

if (!preg_match("/^(?=.*[A-Z])(?=.*\d).{6,}$/", $password)) {
    die("Contraseña insegura");
}

// CONSULTA
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if ($password === $user['password']) {

        $_SESSION['usuario'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];

        header("Location: ../views/dashboard.php");
        exit();

    } else {
        echo "Contraseña incorrecta";
    }

} else {
    echo "Usuario no encontrado";
}
?>