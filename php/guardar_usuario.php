<?php
session_start();
include("../config/db.php");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$rol = $_POST['rol'];

$sql = "INSERT INTO usuarios (nombre, correo, password, rol)
        VALUES ('$nombre', '$correo', '$password', '$rol')";

$conn->query($sql);

header("Location: ../views/usuarios.php");
?>