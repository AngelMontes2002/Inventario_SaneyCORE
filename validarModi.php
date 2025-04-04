<?php
session_start();
$conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');

if (!$conectar) {
    die('<script>
        alert("Error de conexión con la base de datos");
        window.location.href="ModificarBorrar.php";
        </script>');
}

$codigo = mysqli_real_escape_string($conectar, trim($_POST['codi']));
$nombre = trim($_POST['nombre']);
$descripcion = trim($_POST['descrip']);
$unidades = trim($_POST['uni']);
$genero = trim($_POST['genero']);

// Validación: Código no puede estar vacío
if (empty($codigo)) {
    echo '<script>
        alert("Error: Código del producto no válido");
        window.location.href="ModificarBorrar.php";
        </script>';
    exit();
}

// Verifica si el producto ya existe en la base de datos
$check_sql = "SELECT * FROM producto WHERE Codigo_pro='$codigo'";
$check_result = mysqli_query($conectar, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // Si el producto existe, lo actualiza
    $sql = "UPDATE producto SET 
                Nombre_pro='" . mysqli_real_escape_string($conectar, $nombre) . "', 
                Describir='" . mysqli_real_escape_string($conectar, $descripcion) . "', 
                unidad='" . mysqli_real_escape_string($conectar, $unidades) . "', 
                categoria='" . mysqli_real_escape_string($conectar, $genero) . "' 
            WHERE Codigo_pro='$codigo'";
} else {
    // Si no existe, lo inserta como nuevo
    $sql = "INSERT INTO producto (Codigo_pro, Nombre_pro, Describir, unidad, categoria) 
            VALUES ('$codigo', '$nombre', '$descripcion', '$unidades', '$genero')";
}

$ejecutar = mysqli_query($conectar, $sql);

if ($ejecutar) {
    echo '<script>
    alert("Operación exitosa: Producto actualizado o agregado correctamente");
    window.location.href="ModificarBorrar.php";
    </script>';
} else {
    echo '<script>
    alert("Error al ejecutar la operación: ' . mysqli_error($conectar) . '");
    window.location.href="ModificarBorrar.php";
    </script>';
}

mysqli_close($conectar);
?>
