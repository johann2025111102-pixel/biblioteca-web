<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$id_prestamo = $_GET['id'];

// Obtener libro del préstamo
$sqlDetalle = "SELECT id_libro FROM detalle_prestamo WHERE id_prestamo = $id_prestamo";
$result = $conn->query($sqlDetalle);
$detalle = $result->fetch_assoc();

$id_libro = $detalle['id_libro'];

// Actualizar préstamo
$sqlUpdate = "UPDATE prestamos 
              SET estado = 'devuelto', fecha_devolucion = NOW() 
              WHERE id = $id_prestamo";

$conn->query($sqlUpdate);

// Aumentar stock
$sqlStock = "UPDATE libros SET stock = stock + 1 WHERE id = $id_libro";
$conn->query($sqlStock);

header("Location: ../views/prestamos.php");
