<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <title>Login</title>

   <!-- CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
</head>

<body>
   <!-- Encabezado -->
   <header>
      <div class="header">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                  <div class="full">
                     <div class="logo">
                        <a href="index.php"><img src="images/logo2.png" width="70px" height="50px" /></a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                  <nav class="navigation navbar navbar-expand-md navbar-dark " style="padding: 0 250px;">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                     <ul class="navbar-nav mr-auto">
                              <li class="nav-item">
                                 <a class="nav-link" href="crearPro.php">Crear Productos</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="verProductos.php">Ver Productos</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="cerrar_sesion.php"><span class="yellow">Cerrar sesion</span></a>
                              </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </header>

   <!-- Formulario de Login -->
   <div class="container" style="margin-top: 5%;">
      <div class="row justify-content-center">
         <div class="col-md-4">
            <div class="card shadow-lg p-4">
               <h2 class="text-center" style="color: black;">Iniciar Sesión</h2>
               <form action="validarADMIN.php" method="POST">
                  <div class="form-group">
                     <label for="usuario">Usuario</label>
                     <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese su usuario" required autocomplete="off">
                  </div>
                  <div class="form-group">
                     <label for="password">Contraseña</label>
                     <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese su contraseña" required autocomplete="off">
                  </div>
                  <button type="submit" class="btn btn-success btn-block" name="btningresar">Ingresar</button>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Scripts de Bootstrap -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="js/bootstrap.min.js"></script>

</body>
</html>
