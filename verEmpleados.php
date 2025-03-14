<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <title>VER EMPLEADOS</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body class="main-layout"> <!-- Eliminé la segunda etiqueta <body> -->

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
                           <li class="nav-item"><a class="nav-link" href="inicioLo.php">Administrar</a></li>
                           <li class="nav-item"><a class="nav-link" href="crearPro.php">Crear Productos</a></li>
                           <li class="nav-item"><a class="nav-link" href="ModificarBorrar.php">Volver</a></li>
                           <li class="nav-item"><a class="nav-link" href="verProductos.php">Ver Productos</a></li>
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
         <div class="col-md-8 offset-md-2">
            <table class="table">
               <thead class="table-success table-striped">
                  <tr>
                     <th>N. Identidad</th>
                     <th>Nombres</th>
                     <th>Fecha de Nacimiento</th>
                     <th>Dirección</th>
                     <th>Tipo de Documento</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
                  if (!$conectar) {
                     die("Error de conexión: " . mysqli_connect_error());
                  }

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

</body>
</html>

