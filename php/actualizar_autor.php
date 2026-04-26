<?php
session_start();
include("../config/db.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$nacionalidad = $_POST['nacionalidad'];

$sql = "UPDATE autores 
        SET nombre='$nombre', nacionalidad='$nacionalidad'
        WHERE id=$id";

$conn->query($sql);

header("Location: ../views/autores.php");
?>