<?php
session_start();

// Si ya está logueado, manda al dashboard
if (isset($_SESSION['usuario'])) {
    header("Location: views/dashboard.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>