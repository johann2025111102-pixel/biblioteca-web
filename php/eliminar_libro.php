<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$id = $_GET['id'];

$sql = "DELETE FROM libros WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: ../views/libros.php");
} else {
    echo "Error al eliminar";
}
?>