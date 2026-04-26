<?php
session_start();
include("../config/db.php");

$nombre = $_POST['nombre'];
$nacionalidad = $_POST['nacionalidad'];

$sql = "INSERT INTO autores (nombre, nacionalidad)
        VALUES ('$nombre', '$nacionalidad')";

$conn->query($sql);

header("Location: ../views/autores.php");
?>