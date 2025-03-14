<?php
include("conexion.php");
$con = conectar();

// Verifica si se envió el código en la URL
if (isset($_GET['editar'])) {
    $codigo = mysqli_real_escape_string($con, $_GET['editar']);

    // Obtener los datos actuales del producto
    $sql = "SELECT * FROM producto WHERE Codigo_pro='$codigo'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['Nombre_pro'];
        $descripcion = $row['Describir'];
        $unidad = $row['unidad'];
        $genero = $row['categoria'];
    } else {
        echo "<script>alert('Producto no encontrado'); window.location.href='ModificarBorrar.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Código no especificado'); window.location.href='ModificarBorrar.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Editar Producto</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="codi" value="<?php echo $codigo; ?>">
            
            <label>Nombre:</label>
            <input type="text" class="form-control mb-3" name="nombre" value="<?php echo $nombre; ?>">

            <label>Descripción:</label>
            <input type="text" class="form-control mb-3" name="descrip" value="<?php echo $descripcion; ?>">

            <label>Cantidad:</label>
            <input type="number" class="form-control mb-3" name="uni" value="<?php echo $unidad; ?>">

            <label>Categoría:</label>
            <select name="genero" class="form-control mb-3">
                <option <?php if($genero=="Casa") echo "selected"; ?>>Casa</option>
                <option <?php if($genero=="Canasta Familiar") echo "selected"; ?>>Canasta Familiar</option>
                <option <?php if($genero=="bebida") echo "selected"; ?>>bebida</option>
                <option <?php if($genero=="tecnologia") echo "selected"; ?>>tecnologia</option>
                <option <?php if($genero=="Juguete") echo "selected"; ?>>Juguete</option>
            </select>
            
            <input type="submit" class="btn btn-primary" value="Actualizar">
 

</body>
</html>

