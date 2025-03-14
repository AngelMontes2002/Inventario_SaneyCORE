<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Contactos</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

</head>
<!-- body -->

<body class="main-layout contact_page">
   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div>
   <!-- end loader -->
   <!-- header -->
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
                           <li class="nav-item active">
                              <a class="nav-link" href="index.php">Home</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#">Quienes somos</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="contacto.php">Contactos</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="login.php"><span class="yellow">Login</span></a>
                           </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- end header inner -->
   <!-- end header -->
   <div class="blue_bg">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2><img src="images/heading_iconw.png" alt="#" />contacto</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- contact section -->
   <div id="contact" class="contact">
      <div class="con_bg">
         <div class="container-fluid">
            <div class="row ">
               <div class="col-md-6">
                  <form id="request" action="inicio/validarCliente.php" class="main_form" method="POST">
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Nombre Completo" type="type" name="nombre" required>
                        </div>
                        <div class="col-md-12">
                        <p>
                           Tipo de Documento:
                           <select name="TipoDoc">
                              <option>Cedula de Ciudadania</option>
                              <option>Cedula de Extrangeria</option>
                           </select>
                        </p>
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Numero de Identidad" type="number" name="documento" required>
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" type="type" name="email" required>
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Celular" type="number" name="cel" required>
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Direccion" type="text" name="direccion" required>
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn">Enviar</button>
                           <button class="send_btn" type="reset">Borrar</button>
                        </div>
                     </div>
                  </form>
               </div>

            </div>
         </div>
      </div>
   </div>

   <!-- end contact section -->
   <!--  footer -->
   <footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <a class="logo2" href="index.html">
                     <h1 style="color: white;">SANEY</h1>
                  </a>
                  <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it </p>
               </div>
               <div class="col-md-4">
                  <div class="fid_box">
                     <h3>Contact </h3>
                     <ul class="location_icon">
                        <li><a href="Javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> It is a long established fact that a <br>reader will be distracted</li>
                        <li><a href="Javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a><br>
                           (+57) 1234567890<br> (+57) 1234567890
                        </li>
                        <li><a href="Javascript:void(0)"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> demo@gmail.com</li>
                     </ul>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </footer>
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <script>
      function openNav() {
         document.getElementById("mySidepanel").style.width = "250px";
      }

      function closeNav() {
         document.getElementById("mySidepanel").style.width = "0";
      }
   </script>
</body>

</html>