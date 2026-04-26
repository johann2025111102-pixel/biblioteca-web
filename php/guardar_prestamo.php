<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$id_usuario = $_POST['usuario'];
$id_libro = $_POST['libro'];

// Verificar stock
$sqlStock = "SELECT stock FROM libros WHERE id = $id_libro";
$resultStock = $conn->query($sqlStock);
$row = $resultStock->fetch_assoc();

if ($row['stock'] <= 0) {
    die("No hay stock disponible");
}

// Insertar préstamo
$sqlPrestamo = "INSERT INTO prestamos (id_usuario, fecha_prestamo)
                VALUES ($id_usuario, NOW())";

if ($conn->query($sqlPrestamo)) {

    $id_prestamo = $conn->insert_id;

    // Insertar detalle
    $sqlDetalle = "INSERT INTO detalle_prestamo (id_prestamo, id_libro, cantidad)
                   VALUES ($id_prestamo, $id_libro, 1)";
    $conn->query($sqlDetalle);

    // Restar stock
    $sqlUpdate = "UPDATE libros SET stock = stock - 1 WHERE id = $id_libro";
    $conn->query($sqlUpdate);

    header("Location: ../views/prestamos.php");

} else {
    echo "Error al registrar préstamo";
}
?>