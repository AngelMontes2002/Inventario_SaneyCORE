<?php
include("conexion.php");
$con = conectar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body class="main-layout">

    <header>
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                        <div class="full">
                            <div class="logo">
                                <a href="#">
                                    <h1 style="color: white; padding: 5px 150px;">Bienvenido</h1>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                        <nav class="navigation navbar navbar-expand-md navbar-dark" style="padding: 0 250px;">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item"><a class="nav-link" href="formularioemple.php">Crear Empleado</a></li>
                                    <li class="nav-item"><a class="nav-link" href="formularioAdmin.php">Crear Usuario Admin</a></li>
                                    <li class="nav-item"><a class="nav-link" href="verEmpleados.php">Ver lista de empleados</a></li>
                                    <li class="nav-item"><a class="nav-link" href="inicioLo.php"><span class="yellow">Volver</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="cerrar_sesion.php"><span class="yellow">Cerrar sesión</span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <div class="row">
            <!-- Formulario de Modificación -->
            <div class="col-md-4">
                <h3>Modificar Producto</h3>
                <form action="validarModi.php" method="POST">
                    <input type="number" class="form-control mb-3" name="codi" placeholder="Código" required>
                    <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre" required>
                    <input type="text" class="form-control mb-3" name="descrip" placeholder="Descripción">
                    <input type="number" class="form-control mb-3" name="uni" placeholder="Cantidad" required>
                    <label for="categoria">Categoría</label>
                    <select name="genero" class="form-control mb-3">
                        <option>Casa</option>
                        <option>Canasta Familiar</option>
                        <option>Bebida</option>
                        <option>Tecnología</option>
                        <option>Juguete</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>

            <!-- Tabla de productos -->
            <div class="col-md-8">
                <h3>Lista de Productos</h3>
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Unidades</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saney');
                        if (!$conectar) {
                            die("Error en la conexión a la base de datos: " . mysqli_connect_error());
                        }

                        $consulta = "SELECT * FROM producto";
                        $ejecutar = mysqli_query($conectar, $consulta);

                        while ($fila = mysqli_fetch_array($ejecutar)) {
                            echo "<tr>
                                    <td>{$fila['Codigo_pro']}</td>
                                    <td>{$fila['Nombre_pro']}</td>
                                    <td>{$fila['Describir']}</td>
                                    <td>{$fila['unidad']}</td>
                                    <td>{$fila['categoria']}</td>
                                    <td>
                                        <a href='ModificarBorrar.php?borrar={$fila['Codigo_pro']}' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>Eliminar</a>
                                    </td>
                                  </tr>";
                        }
                        mysqli_close($conectar);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Lógica para Eliminar -->
    <?php
    if (isset($_GET['borrar'])) {
        $borrar_id = $_GET['borrar'];
        $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saney');

        if (!$conectar) {
            die("Error en la conexión a la base de datos: " . mysqli_connect_error());
        }

        $borrar_id = mysqli_real_escape_string($conectar, $borrar_id);
        $borrar = "DELETE FROM producto WHERE Codigo_pro = '$borrar_id'";
        $ejecutar = mysqli_query($conectar, $borrar);

        if ($ejecutar) {
            echo "<script>alert('Producto eliminado correctamente'); window.location.href='ModificarBorrar.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar el producto');</script>";
        }

        mysqli_close($conectar);
    }
    ?>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
