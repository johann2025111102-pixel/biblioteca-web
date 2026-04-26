<?php
$host = "sql111.infinityfree.com";
$user = "if0_41763417";   
$pass = "CroNos1499";
$db   = "if0_41763417_if0_12345678_biblioteca";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>