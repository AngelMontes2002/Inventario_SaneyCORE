<?php
include("conexion.php");
$con = conectar();

$conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
if (!$conectar) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

$por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 10;
if (!in_array($por_pagina, [10, 50])) {
    $por_pagina = 10;
}

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina < 1) $pagina = 1;

$total_resultados = mysqli_num_rows(mysqli_query($conectar, "SELECT * FROM producto"));
$total_paginas = ceil($total_resultados / $por_pagina);
$inicio = ($pagina - 1) * $por_pagina;

$consulta = "SELECT * FROM producto LIMIT $inicio, $por_pagina";
$ejecutar = mysqli_query($conectar, $consulta);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modificar Producto</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />

    <style>
        /* Mejora del formulario */
        .form-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgb(0 0 0 / 0.1);
        }

        .form-section h3 {
            color: #28a745;
            margin-bottom: 20px;
            font-weight: 700;
            border-bottom: 2px solid #28a745;
            padding-bottom: 5px;
        }

        /* Mejoras para la tabla */
        .table thead {
            background-color: #28a745;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #e6f4ea;
        }

        .btn-danger {
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Contenedor principal para mejor separación */
        main.container {
            margin-top: 40px;
            margin-bottom: 60px;
        }

        /* Controles de paginación */
        .pagination .page-item.active .page-link {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* Selector productos por página */
        .form-inline label {
            font-weight: 600;
            margin-right: 10px;
            color: #333;
        }

        /* Ajuste en selects y botones */
        select.form-control {
            max-width: 100px;
        }
    </style>
</head>

<body class="main-layout">

    <!-- Header sin cambios -->

    <header>
        <div class="header bg-dark text-white">
            <div class="container-fluid py-3">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center text-md-left">
                        <h1 class="h4 mb-0"><i class="fa fa-user-circle"></i> Bienvenido</h1>
                    </div>
                    <div class="col-md-9">
                        <nav class="navbar navbar-expand-md navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
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

    <main class="container">
        <div class="row">
            <!-- Formulario en columna más pequeña -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="form-section">
                    <h3>Modificar Producto</h3>
                    <form action="validarModi.php" method="POST" autocomplete="off">
                        <div class="form-group">
                            <input type="number" name="codi" class="form-control" placeholder="Código" required />
                        </div>
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required />
                        </div>
                        <div class="form-group">
                            <input type="text" name="descrip" class="form-control" placeholder="Descripción" />
                        </div>
                        <div class="form-group">
                            <input type="number" name="uni" class="form-control" placeholder="Cantidad" required />
                        </div>
                        <div class="form-group">
                            <label for="categoria" class="font-weight-bold">Categoría</label>
                            <select name="genero" class="form-control" id="categoria">
                                <option value="Hogar">Hogar</option>
                                <option value="Electronica">Electronica</option>
                                <option value="Alimentos y Bebida">Alimentos y Bebida</option>
                                <option value="Fereteria">Fereteria</option>
                                <option value="Oficina y papeleria">Oficina y papeleria</option>
                                <option value="Salud y farmacia">Salud y farmacia</option>
                                <option value="Muebles y decoracion">Muebles y decoracion</option>
                                <option value="Repuesto y accesorio">Repuesto y accesorio</option>
                                <option value="Oficina y papeleria">Oficina y papeleria</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-3">Modificar</button>
                    </form>
                </div>
            </div>

            <!-- Tabla y paginación en columna más amplia -->
            <div class="col-lg-8 col-md-6">
                <h3 class="mb-3 text-success font-weight-bold">Lista de Productos</h3>

                <form method="get" class="form-inline mb-3 justify-content-end">
                    <label for="por_pagina" class="mr-2">Productos por página:</label>
                    <select name="por_pagina" id="por_pagina" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="10" <?php if ($por_pagina == 10) echo 'selected'; ?>>10</option>
                        <option value="50" <?php if ($por_pagina == 50) echo 'selected'; ?>>50</option>
                    </select>
                    <noscript><input type="submit" value="Mostrar" class="btn btn-success" /></noscript>
                </form>

                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Unidades</th>
                                <th>Categoría</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($fila = mysqli_fetch_array($ejecutar)) {
                                echo "<tr>
                                    <td>{$fila['Codigo_pro']}</td>
                                    <td>{$fila['Nombre_pro']}</td>
                                    <td>{$fila['Describir']}</td>
                                    <td>{$fila['unidad']}</td>
                                    <td>{$fila['categoria']}</td>
                                    <td class='text-center'>
                                        <a href='ModificarBorrar.php?borrar={$fila['Codigo_pro']}&pagina=$pagina&por_pagina=$por_pagina' class='btn btn-danger btn-sm' title='Eliminar' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Navegación paginada -->
                <nav aria-label="Paginación" class="mt-3">
                    <ul class="pagination justify-content-center">
                        <?php if ($pagina > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>&por_pagina=<?php echo $por_pagina; ?>">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <?php
                        // Mostrar solo un rango razonable de páginas
                        $max_links = 7;
                        $start = max(1, $pagina - intval($max_links / 2));
                        $end = min($total_paginas, $start + $max_links - 1);

                        if ($start > 1) {
                            echo "<li class='page-item'><a class='page-link' href='?pagina=1&por_pagina=$por_pagina'>1</a></li>";
                            if ($start > 2) echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                        }

                        for ($i = $start; $i <= $end; $i++) {
                            $active = ($i == $pagina) ? 'active' : '';
                            echo "<li class='page-item $active'><a class='page-link' href='?pagina=$i&por_pagina=$por_pagina'>$i</a></li>";
                        }

                        if ($end < $total_paginas) {
                            if ($end < $total_paginas - 1) echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$total_paginas&por_pagina=$por_pagina'>$total_paginas</a></li>";
                        }
                        ?>

                        <?php if ($pagina < $total_paginas): ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>&por_pagina=<?php echo $por_pagina; ?>">Siguiente</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Scripts JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
if (isset($_GET['borrar'])) {
    $id_borrar = (int)$_GET['borrar'];

    // Eliminar relaciones para evitar errores FK
    $consulta_detalle = "DELETE FROM detalle_retiro WHERE Codigo_pro = $id_borrar";
    mysqli_query($conectar, $consulta_detalle);

    // Eliminar producto
    $consulta_borrar = "DELETE FROM producto WHERE Codigo_pro = $id_borrar";
    $ejecutar_borrar = mysqli_query($conectar, $consulta_borrar);

    $pagina_redir = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $por_pagina_redir = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 10;

    if ($ejecutar_borrar) {
        echo "<script>alert('Producto eliminado correctamente'); window.location.href = 'ModificarBorrar.php?pagina=$pagina_redir&por_pagina=$por_pagina_redir';</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto'); window.location.href = 'ModificarBorrar.php?pagina=$pagina_redir&por_pagina=$por_pagina_redir';</script>";
    }
}
?>
