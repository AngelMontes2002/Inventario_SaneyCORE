<?php
$conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
if (!$conectar) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se ha solicitado eliminar un empleado
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']); // Sanitiza la entrada
    $query = "DELETE FROM empleado WHERE n_identi = '$id'";
    $resultado = mysqli_query($conectar, $query);

    if ($resultado) {
        echo "<script>
                alert('Empleado eliminado correctamente');
                window.location.href='/inventario_saneyCORE/verEmpleados.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al eliminar el empleado');
                window.location.href='/inventario_saneyCORE/verEmpleados.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>VER EMPLEADOS</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body class="main-layout">

   <header>
      <div class="header">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                  <div class="full">
                     <div class="logo">
                        <a href="inicioLo.php">
                           <h1 style="color: white; padding: 5px 150px;">Bienvenido</h1>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                  <nav class="navigation navbar navbar-expand-md navbar-dark " style="padding: 0 250px;">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item"><a class="nav-link" href="ModificarBorrar.php">Volver</a></li>
                           <li class="nav-item"><a class="nav-link" href="cerrar_sesion.php"><span class="yellow">Cerrar sesión</span></a></li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </header>

   <div class="container">
      <div class="row p-2">
         <div class="col-md-10 offset-md-1">
            <h2 class="text-center">Lista de Empleados</h2>
            <table class="table">
               <thead class="table-success table-striped">
                  <tr>
                     <th>N. Identidad</th>
                     <th>Nombres</th>
                     <th>Fecha de Nacimiento</th>
                     <th>Dirección</th>
                     <th>Tipo de Documento</th>
                     <th>Acciones</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $consulta = "SELECT * FROM empleado";
                  $ejecutar = mysqli_query($conectar, $consulta);

                  if (!$ejecutar) {
                     die("Error en la consulta: " . mysqli_error($conectar));
                  }

                  while ($fila = mysqli_fetch_assoc($ejecutar)) {
                  ?>
                     <tr>
                        <td><?php echo htmlspecialchars($fila['n_identi']); ?></td>
                        <td><?php echo htmlspecialchars($fila['nombre_emp']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fe_nacimiento']); ?></td>
                        <td><?php echo htmlspecialchars($fila['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($fila['tipoDocu']); ?></td>
                        <td>
                           <a href="<?php echo $_SERVER['PHP_SELF']; ?>?eliminar=<?php echo $fila['n_identi']; ?>" 
                              class="btn btn-danger btn-sm"
                              onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                              Eliminar
                           </a>
                        </td>
                     </tr>
                  <?php } ?>
               </tbody>
            </table>

            <!-- Botón de descarga corregido -->
            <div class="text-center mt-3">
               <a href="xml/xml.php" class="btn btn-primary">DESCARGAR XML</a>
            </div>

         </div>
      </div>
   </div>

   <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
