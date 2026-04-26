<?php
session_start();
include("../config/db.php");

if ($_SESSION['rol'] != 'encargado') {
    die("Acceso denegado");
}

$id = $_GET['id'];

// Obtener libro
$sql = "SELECT * FROM libros WHERE id = $id";
$result = $conn->query($sql);
$libro = $result->fetch_assoc();

// Obtener autores
$autores = $conn->query("SELECT * FROM autores");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Libro</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>Editar Libro</h2>

    <form action="../php/actualizar_libro.php" method="POST" onsubmit="return validarForm()">

        <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">

        <input type="text" name="titulo" id="titulo" value="<?php echo $libro['titulo']; ?>">

        <select name="autor">
            <?php while($a = $autores->fetch_assoc()): ?>
                <option value="<?php echo $a['id']; ?>" 
                    <?php if($a['id'] == $libro['id_autor']) echo "selected"; ?>>
                    <?php echo $a['nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="text" name="categoria" id="categoria" value="<?php echo $libro['categoria']; ?>">
        <input type="number" name="anio" id="anio" value="<?php echo $libro['anio']; ?>">
        <input type="number" name="stock" id="stock" value="<?php echo $libro['stock']; ?>">

        <button type="submit">Actualizar</button>
    </form>

    <p id="error" style="color:red;"></p>

    <br>
    <a href="libros.php">⬅ Volver</a>
</div>

<script>
function validarForm() {
    let titulo = document.getElementById("titulo").value;
    let categoria = document.getElementById("categoria").value;
    let anio = document.getElementById("anio").value;
    let stock = document.getElementById("stock").value;
    let error = document.getElementById("error");

    let regexTexto = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,}$/;
    let regexNumero = /^[0-9]+$/;

    if (!regexTexto.test(titulo)) {
        error.innerText = "Título inválido";
        return false;
    }

    if (!regexTexto.test(categoria)) {
        error.innerText = "Categoría inválida";
        return false;
    }

    if (!regexNumero.test(anio)) {
        error.innerText = "Año inválido";
        return false;
    }

    if (!regexNumero.test(stock)) {
        error.innerText = "Stock inválido";
        return false;
    }

    return true;
}
</script>

</body>
</html>