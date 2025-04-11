<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SANEY</title>

   <!-- Estilos externos -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />

   <style>
      .header {
         background-color: #212529;
         padding: 15px 0;
      }
      .navbar .nav-link {
         color: white !important;
         font-weight: 500;
         margin-right: 15px;
         transition: color 0.3s ease;
      }
      .navbar .nav-link:hover {
         color: #ffc107 !important;
      }
      .navbar-brand img {
         height: 50px;
      }
      .navbar-toggler {
         border-color: #fff;
      }
      .navbar-toggler-icon {
         background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
      }
   </style>
</head>

<body class="main-layout">

   <!-- ENCABEZADO -->
   <header class="header">
      <div class="container-fluid">
         <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">
               <img src="images/logo2.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a class="nav-link" href="admincontra.php"><i class="fa fa-lock"></i> Login Admin</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="crearPro.php"><i class="fa fa-plus-square"></i> Crear Productos</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="verProductos.php"><i class="fa fa-eye"></i> Ver Productos</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="registro.php"><i class="fa fa-user-plus"></i> Crear Usuario de Ventas</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-danger" href="cerrar_sesion.php"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
                  </li>
               </ul>
            </div>
         </nav>
      </div>
   </header>

   <!-- BANNER -->
   <section class="banner_main" style="background-image: url('images/banner.png'); background-size: cover; background-position: center;">
      <div id="banner1" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#banner1" data-slide-to="0" class="active"></li>
            <li data-target="#banner1" data-slide-to="1"></li>
            <li data-target="#banner1" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-7">
                           <div class="text-bg">
                              <h1><span class="yellow">Inventario</span><br>De tus sueños</h1>
                              <p>Gestiona tu inventario con precisión y facilidad gracias a nuestra plataforma moderna.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Puedes agregar más slides aquí -->
         </div>
      </div>
   </section>

   <!-- SCRIPTS NECESARIOS -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
