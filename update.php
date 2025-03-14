<?php
include("conexion.php");
$con = conectar();

if (!$con) {
    die('<script>
        alert("Error de conexión con la base de datos");
        window.location.href="ModificarBorrar.php";
        </script>');
}

$codigo = mysqli_real_escape_string($con, trim($_POST['codi']));
$nombre = trim($_POST['nombre']);
$descripcion = trim($_POST['descrip']);
$unidades = trim($_POST['uni']);
$genero = trim($_POST['genero']);

if (empty($codigo)) {
    echo '<script>
        alert("Error: Código del producto no válido");
        window.location.href="ModificarBorrar.php";
        </script>';
    exit();
}

$updates = [];
if (!empty($nombre)) {
    $updates[] = "Nombre_pro='" . mysqli_real_escape_string($con, $nombre) . "'";
}
if (!empty($descripcion)) {
    $updates[] = "Describir='" . mysqli_real_escape_string($con, $descripcion) . "'";
}
if (!empty($unidades) && is_numeric($unidades)) {
    $updates[] = "unidad='" . mysqli_real_escape_string($con, $unidades) . "'";
}
if (!empty($genero)) {
    $updates[] = "categoria='" . mysqli_real_escape_string($con, $genero) . "'";
}

if (count($updates) > 0) {
    $sql = "UPDATE producto SET " . implode(", ", $updates) . " WHERE Codigo_pro='$codigo'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        echo '<script>
        alert("Producto actualizado correctamente");
        window.location.href="ModificarBorrar.php";
        </script>';
    } else {
        echo '<script>
        alert("Error al actualizar el producto: ' . mysqli_error($con) . '");
        window.location.href="ModificarBorrar.php";
        </script>';
    }
} else {
    echo '<script>
    alert("No se realizaron cambios");
    window.location.href="ModificarBorrar.php";
    </script>';
}

mysqli_close($con);
?>
