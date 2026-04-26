<?php
session_start();
include("../config/db.php");

// SOLO ADMIN
if ($_SESSION['rol'] != 'encargado') {
    echo "Acceso denegado";
    exit();
}

// Obtener autores
$autores = $conn->query("SELECT * FROM autores");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login-container">
    <h2>Agregar Libro</h2>

    <form action="../php/guardar_libro.php" method="POST" enctype="multipart/form-data" onsubmit="return validarForm()">

        <input type="text" name="titulo" id="titulo" placeholder="Título">

        <select name="autor">
            <?php while($a = $autores->fetch_assoc()): ?>
                <option value="<?php echo $a['id']; ?>">
                    <?php echo $a['nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="text" name="categoria" id="categoria" placeholder="Categoría">
        <input type="number" name="anio" id="anio" placeholder="Año">
        <input type="number" name="stock" id="stock" placeholder="Stock">
        <input type="file" name="imagen" accept="image/*">

        <button type="submit">Guardar</button>
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

    if (!regexNumero.test(anio) || anio < 1000 || anio > 2025) {
        error.innerText = "Año inválido";
        return false;
    }

    if (!regexNumero.test(stock) || stock < 0) {
        error.innerText = "Stock inválido";
        return false;
    }

    return true;
}
</script>

</body>
</html>