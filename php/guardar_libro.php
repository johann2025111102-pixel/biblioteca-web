<?php
session_start();
include("../config/db.php");

// SOLO ADMIN
if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria = $_POST['categoria'];
$anio = $_POST['anio'];
$stock = $_POST['stock'];

// REGEX BACKEND
if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,}$/", $titulo)) {
    die("Título inválido");
}

if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,}$/", $categoria)) {
    die("Categoría inválida");
}

if (!preg_match("/^[0-9]+$/", $anio)) {
    die("Año inválido");
}

if (!preg_match("/^[0-9]+$/", $stock)) {
    die("Stock inválido");
}

// INSERTAR
// MANEJO DE IMAGEN
$imagen = $_FILES['imagen']['name'];
$ruta = "../uploads/" . $imagen;
// Mover archivo
move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
$sql = "INSERT INTO libros (titulo, id_autor, categoria, anio, stock, imagen)
        VALUES ('$titulo', '$autor', '$categoria', '$anio', '$stock', '$imagen')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/libros.php");
} else {
    echo "Error: " . $conn->error;
}
?>