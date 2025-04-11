<?php
$conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
if (!$conectar) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Eliminar usuario si se recibe el parámetro
if (isset($_GET['eliminar'])) {
    $idEliminar = mysqli_real_escape_string($conectar, $_GET['eliminar']);
    $eliminarSQL = "DELETE FROM usuarios WHERE id_use = '$idEliminar'";
    mysqli_query($conectar, $eliminarSQL);
}

// Solo seleccionamos los campos necesarios (sin contraseña)
$query = "SELECT id_use, nombre, telefono FROM usuarios WHERE rol = 'empleado'";
$resultado = mysqli_query($conectar, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Lista de Usuarios</h1>
        <h3>Usuarios Registrados</h3>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Usuario (Cédula)</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['id_use']) ?></td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td><?= htmlspecialchars($fila['telefono']) ?></td>
                        <td>
                            <a href="?eliminar=<?= $fila['id_use'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este usuario?');">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="inicioLo.php" class="btn btn-warning">Volver</a>
    </div>
</body>
</html>
