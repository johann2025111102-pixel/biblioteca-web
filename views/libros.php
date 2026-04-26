<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

// PROTEGER ACCESO
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// CONSULTA
$sql = "SELECT libros.*, autores.nombre AS autor 
        FROM libros 
        LEFT JOIN autores ON libros.id_autor = autores.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Libros</title>
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css?v=3">
</head>

<script>
    function filtrarTabla() {
        let input = document.getElementById("busqueda").value.toLowerCase();
        let categoria = document.getElementById("filtroCategoria").value.toLowerCase();
        let autor = document.getElementById("filtroAutor").value.toLowerCase();

        let filas = document.querySelectorAll("#tablaLibros tr");

        filas.forEach((fila, index) => {
            if (index === 0) return;

            let texto = fila.innerText.toLowerCase();
            let cat = fila.cells[3].innerText.toLowerCase();
            let aut = fila.cells[2].innerText.toLowerCase();

            let coincideBusqueda = texto.includes(input);
            let coincideCategoria = categoria === "" || cat.includes(categoria);
            let coincideAutor = autor === "" || aut.includes(autor);

            if (coincideBusqueda && coincideCategoria && coincideAutor) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    }
</script>
<script>
    window.onload = function() {
        let categorias = new Set();
        let autores = new Set();

        let filas = document.querySelectorAll("#tablaLibros tr");

        filas.forEach((fila, index) => {
            if (index === 0) return;

            categorias.add(fila.cells[3].innerText);
            autores.add(fila.cells[2].innerText);
        });

        let selectCat = document.getElementById("filtroCategoria");
        let selectAut = document.getElementById("filtroAutor");

        categorias.forEach(cat => {
            let option = document.createElement("option");
            option.value = cat;
            option.text = cat;
            selectCat.appendChild(option);
        });

        autores.forEach(aut => {
            let option = document.createElement("option");
            option.value = aut;
            option.text = aut;
            selectAut.appendChild(option);
        });
    }
</script>

<body class="login-body3">

    <div class="login-container" style="width: 90%;">
        <h2>Gestión de Libros</h2>

        <br>

        <input type="text" id="busqueda" placeholder="Buscar libro..." onkeyup="filtrarTabla()">

        <select id="filtroCategoria" onchange="filtrarTabla()">
            <option value="">Todas las categorías</option>
        </select>

        <select id="filtroAutor" onchange="filtrarTabla()">
            <option value="">Todos los autores</option>
        </select>

        <br><br>

        <a href="dashboard.php">⬅ Volver</a>

        <br><br>

        <?php if ($_SESSION['rol'] == 'encargado'): ?>
            <button onclick="window.location.href='agregar_libro.php'">Agregar Libro</button>
        <?php endif; ?>

        <br><br>

        <table border="1" width="100%" id="tablaLibros">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Categoría</th>
                <th>Año</th>
                <th>Stock</th>
                <th>Portada</th>
                <?php if ($_SESSION['rol'] == 'encargado'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['autor']; ?></td>
                    <td><?php echo $row['categoria']; ?></td>
                    <td><?php echo $row['anio']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td>
                        <img src="../uploads/<?php echo $row['imagen']; ?>" style="width:100px; height:150px; object-fit:cover; border-radius:8px;">
                    </td>

                    <?php if ($_SESSION['rol'] == 'encargado'): ?>
                        <td>
                            <a href="editar_libro.php?id=<?php echo $row['id']; ?>">Editar</a> |
                            <a href="../php/eliminar_libro.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>

        </table>

    </div>

</body>

</html>