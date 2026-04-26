    <?php
session_start();
include("../config/db.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$rol = $_POST['rol'];

$sql = "UPDATE usuarios 
        SET nombre='$nombre', correo='$correo', rol='$rol'
        WHERE id=$id";

$conn->query($sql);

header("Location: ../views/usuarios.php");
?>