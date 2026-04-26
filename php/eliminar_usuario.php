<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];

$conn->query("DELETE FROM usuarios WHERE id=$id");

header("Location: ../views/usuarios.php");
?>