<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <title>SANEY</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="icon" href="images/fevicon.png" type="image/gif">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
   </head>
   <body class="main-layout">
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="Cargando"></div>
      </div>
      <header>
         <div class="header">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-2">
                     <div class="logo">
                        <a href="index.php"><img src="images/logo2.png" width="70" height="50" alt="Logo"></a>
                     </div>
                  </div>
                  <div class="col-lg-10">
                     <nav class="navbar navbar-expand-md navbar-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarMenu">
                           <ul class="navbar-nav ml-auto">
                              <li class="nav-item active"><a class="nav-link" href="index.php">Inicio</a></li>
                              <li class="nav-item"><a class="nav-link" href="Quienessomos.php">Quiénes somos</a></li>
                              <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
                              <li class="nav-item"><a class="nav-link text-warning" href="login.php">Login</a></li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <section class="banner_main">
         <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#bannerCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#bannerCarousel" data-slide-to="1"></li>
               <li data-target="#bannerCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="carousel-caption">
                        <h1><span class="yellow"> Inventario</span> de tus sueños</h1>
                        <p>Administra tu inventario de manera eficiente con nuestra plataforma.</p>
                        <a class="btn btn-primary" href="contacto.php">Contacto</a>
                        <a class="btn btn-secondary" href="#">Más</a>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
            </a>
         </div>
      </section>
      <footer>
         <div class="footer bg-dark text-white py-4">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <h3>SANEY</h3>
                     <p>Administración eficiente de inventarios con tecnología avanzada.</p>
                  </div>
                  <div class="col-md-6">
                     <h3>Contacto</h3>
                     <ul class="list-unstyled">
                        <li><i class="fa fa-map-marker"></i> Ubicación específica</li>
                        <li><i class="fa fa-phone"></i> (+57) 1234567890</li>
                        <li><i class="fa fa-envelope"></i> SaneyInven@gmail.com</li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>
