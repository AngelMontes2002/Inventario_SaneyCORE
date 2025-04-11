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
    <title>Modificar Producto</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body class="main-layout">

    <header>
        <div class="header bg-dark text-white">
            <div class="container-fluid py-3">
                <div class="row align-items-center">
                    <!-- Logo / Título -->
                    <div class="col-md-3 text-center text-md-left">
                        <h1 class="h4 mb-0"><i class="fa fa-user-circle"></i> Bienvenido</h1>
                    </div>

                    <!-- Navegación -->
                    <div class="col-md-9">
                        <nav class="navbar navbar-expand-md navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">

                                    <!-- Grupo: Gestión de Usuarios -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="usuariosDropdown" role="button" data-toggle="dropdown">
                                            <i class="fa fa-users"></i> Gestión de Usuarios
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="registro.php"><i class="fa fa-user-plus"></i> Crear Usuario de ventas</a>
                                            <a class="dropdown-item" href="formularioAdmin.php"><i class="fa fa-user-secret"></i> Crear Admin</a>
                                            <a class="dropdown-item" href="registroSupervi.php"><i class="fa fa-user"></i> Crear Supervisor</a>
                                            <a class="dropdown-item" href="listaemple.php"><i class="fa fa-list"></i> Ver Usuarios</a>
                                            <a class="dropdown-item" href="ver_retiros.php"><i class="fa fa-list"></i> Registro de ventas</a>
                                        </div>
                                    </li>

                                    <!-- Grupo: Navegación -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="inicioLo.php"><i class="fa fa-arrow-left"></i> Volver</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" href="cerrar_sesion.php"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Contenido principal -->
    <main class="container mt-5">
        <div class="row">

            <!-- Formulario de modificación -->
            <div class="col-md-4">
                <h3>Modificar Producto</h3>
                <form action="validarModi.php" method="POST">
                    <input type="number" name="codi" class="form-control mb-3" placeholder="Código" required>
                    <input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre" required>
                    <input type="text" name="descrip" class="form-control mb-3" placeholder="Descripción">
                    <input type="number" name="uni" class="form-control mb-3" placeholder="Cantidad" required>
                    <label for="categoria">Categoría</label>
                    <select name="genero" class="form-control mb-3">
                        <option value="Casa">Casa</option>
                        <option value="Canasta Familiar">Canasta Familiar</option>
                        <option value="Bebida">Bebida</option>
                        <option value="Tecnología">Tecnología</option>
                        <option value="Juguete">Juguete</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </form>
            </div>

            <!-- Tabla de productos -->
            <div class="col-md-8">
                <h3>Lista de Productos</h3>
                <table class="table table-bordered table-hover">
                    <thead class="thead-success bg-success text-white">
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
                        $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
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
                                        <a href='ModificarBorrar.php?borrar={$fila['Codigo_pro']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>Eliminar</a>
                                    </td>
                                  </tr>";
                        }

                        mysqli_close($conectar);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Script de eliminación -->
    <?php
    if (isset($_GET['borrar'])) {
        $borrar_id = $_GET['borrar'];
        $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');

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

    <!-- Scripts JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Scripts JS necesarios para que funcione el dropdown de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

</body>

</html>
