<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria = $_POST['categoria'];
$anio = $_POST['anio'];
$stock = $_POST['stock'];

// REGEX
if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,}$/", $titulo)) {
    die("Título inválido");
}

// UPDATE
$sql = "UPDATE libros SET 
        titulo='$titulo',
        id_autor='$autor',
        categoria='$categoria',
        anio='$anio',
        stock='$stock'
        WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: ../views/libros.php");
} else {
    echo "Error";
}
?>