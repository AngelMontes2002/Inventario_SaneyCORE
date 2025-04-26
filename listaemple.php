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
            <a href="modificarborrar.php" class="btn btn-warning">Volver</a>
        </div>
    </header>

    <div class="container mt-4">
        <h3>Usuarios Registrados</h3>
        <table class="table table-bordered">
            <thead class="table-dark text-white">
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
                if (!$conectar) {
                    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
                }

                $consulta = "SELECT id_use, nombre, telefono FROM usuarios WHERE rol = 'empleado'";
                $resultado = mysqli_query($conectar, $consulta);

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>{$fila['id_use']}</td>
                            <td>{$fila['nombre']}</td>
                            <td>{$fila['telefono']}</td>
                            <td>
                                <a href='listaemple.php?borrar={$fila['id_use']}' class='btn btn-danger' onclick='return confirm(\"¿Seguro que quieres eliminar este usuario?\")'>Eliminar</a>
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

        // 1. Verificar si el usuario tiene retiros
        $consulta_retiros = "SELECT id FROM retiros WHERE usuario_id = '$borrar_id'";
        $resultado_retiros = mysqli_query($conectar, $consulta_retiros);

        $retiros = [];
        while ($row = mysqli_fetch_assoc($resultado_retiros)) {
            $retiros[] = $row['id'];  // Guardamos los ID de los retiros
        }

        if (count($retiros) > 0) {
            // Si tiene retiros, mostrar los códigos en el mensaje
            $codigos_retiros = implode(", ", $retiros);
            echo "<script>alert('No se puede eliminar el usuario porque tiene retiros registrados. Códigos de retiros: $codigos_retiros'); window.location.href='listaemple.php';</script>";
        } else {
            // Si NO tiene retiros, se elimina el usuario
            $borrar_usuario = "DELETE FROM usuarios WHERE id_use = '$borrar_id'";
            $ejecutar = mysqli_query($conectar, $borrar_usuario);

            if ($ejecutar) {
                echo "<script>alert('Usuario eliminado correctamente'); window.location.href='listaemple.php';</script>";
            } else {
                echo "<script>alert('Error al eliminar el usuario'); window.location.href='listaemple.php';</script>";
            }
        }

        mysqli_close($conectar);
    }
    ?>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
