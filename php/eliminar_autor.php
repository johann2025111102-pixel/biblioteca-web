<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];

$conn->query("DELETE FROM autores WHERE id = $id");

header("Location: ../views/autores.php");
?>