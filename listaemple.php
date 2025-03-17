<?php
include("conexion.php");
$con = conectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="main-layout">
    <header class="bg-dark py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="text-white">Lista de Usuarios</h1>
            <a href="inicioLo.php" class="btn btn-warning">Volver</a>
        </div>
    </header>

    <div class="container mt-4">
        <h3>Usuarios Registrados</h3>
        <table class="table table-bordered">
            <thead class="table-dark text-white">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
                if (!$conectar) {
                    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
                }

                $consulta = "SELECT * FROM usuarios";
                $resultado = mysqli_query($conectar, $consulta);

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>{$fila['Usuario']}</td>
                            <td>{$fila['nombre']}</td>
                            <td>{$fila['apellido']}</td>
                            <td>
                                <a href='listaemple.php?borrar={$fila['Usuario']}' class='btn btn-danger' onclick='return confirm(\"¿Seguro que quieres eliminar este usuario?\")'>Eliminar</a>
                            </td>
                          </tr>";
                }

                mysqli_close($conectar);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Lógica para Eliminar -->
    <?php
    if (isset($_GET['borrar'])) {
        $borrar_id = $_GET['borrar'];
        $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');

        if (!$conectar) {
            die("Error en la conexión a la base de datos: " . mysqli_connect_error());
        }

        $borrar_id = mysqli_real_escape_string($conectar, $borrar_id);
        $borrar = "DELETE FROM usuarios WHERE Usuario = '$borrar_id'";
        $ejecutar = mysqli_query($conectar, $borrar);

        if ($ejecutar) {
            echo "<script>alert('Usuario eliminado correctamente'); window.location.href='listaemple.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar el usuario');</script>";
        }

        mysqli_close($conectar);
    }
    ?>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
