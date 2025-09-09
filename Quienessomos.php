<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Contactos</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="main-layout contact_page">
   <!-- Header -->
   <header class="bg-dark py-3">
      <div class="container d-flex justify-content-between align-items-center">
         <a href="index.php"><img src="images/logo2.png" width="70" height="50" alt="Logo"></a>
         <nav>
            <ul class="nav">
               <li class="nav-item"><a class="nav-link text-white" href="index.php">Inicio</a></li>
               <li class="nav-item"><a class="nav-link text-white" href="Quienessomos.php">Quiénes somos</a></li>
               <li class="nav-item"><a class="nav-link text-white" href="contacto.php">Contacto</a></li>
               <li class="nav-item"><a class="nav-link text-warning" href="login.php">Login</a></li>
            </ul>
         </nav>
      </div>
   </header>

<!-- Banner Principal -->
<section class="banner_main" style="background-image: url('images/banner.png'); background-size: cover;">
   <div id="banner1" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
         <li data-bs-target="#banner1" data-bs-slide-to="0" class="active"></li>
         <li data-bs-target="#banner1" data-bs-slide-to="1"></li>
         <li data-bs-target="#banner1" data-bs-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container">
               <div class="carousel-caption">
                  <div class="row">
                     <div class="col-md-7">
                        <div class="text-bg">
                           <h1><span class="yellow">Inventario</span> <br>de tus sueños</h1>
                           <p>Contamos con un inventario robusto y adaptado a tus necesidades, garantizando la mejor calidad y servicio.</p>
                           <a class="read_more" href="contacto.php">Contáctanos</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</section>

   <!-- Sección de Servicios -->
   <div class="service py-5">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               <h2><img src="images/heading_icon.png" alt="#"> <span class="yellow">Todo Contigo</span><br><span class="appp_l">Comercial & Servicios</span></h2>
               <p>En Todo Contigo, combinamos calidad, innovación y compromiso para ofrecerte siempre lo mejor.</p>
            </div>
         </div>
         <div class="row text-center">
            <div class="col-md-4">
               <div class="service_box">
                  <img src="images/service_icon1.png" alt="#">
                  <h3>Productos</h3>
                  <p>Disponemos de un amplio catálogo adaptado a tus necesidades, con inventarios actualizados y entregas rápidas.</p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="service_box">
                  <img src="images/service_icon2.png" alt="#">
                  <h3>Lo mejor a tu alcance</h3>
                  <p>Calidad garantizada en cada producto, ofreciéndote siempre lo mejor para ti y tu familia.</p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="service_box">
                  <img src="images/service_icon4.png" alt="#">
                  <h3>Seguridad & Alertas</h3>
                  <p>Comprometidos con tu bienestar, ofrecemos soluciones de seguridad confiables y eficientes.</p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Sección Acerca de Nosotros -->
   <div id="about" class="about py-5 bg-light">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               <h2><img src="images/heading_icon.png" alt="#">Conócenos</h2>
               <p>Somos una empresa que nació de la pasión por servir y crear soluciones a medida para nuestros clientes. Día a día, innovamos para brindarte lo mejor.</p>
            </div>
            <div class="col-md-12 text-center mt-4">
               <figure><img src="images/about_imglo.png" class="img-fluid" alt="Conócenos"></figure>
            </div>
         </div>
      </div>
   </div>

   <!-- Sección de Productos -->
   <div id="project" class="project py-5">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               <h2><img src="images/heading_iconw.png" alt="#">Nuestros Productos</h2>
               <p>Te ofrecemos un portafolio diverso, adaptado a tus necesidades personales y profesionales.</p>
            </div>
         </div>
         <div class="row text-center">
            <div class="col-md-4">
               <div class="project_box">
                  <figure><img src="images/project_img1fe.jpg" alt="Ferretería"></figure>
                  <h3>Ferretería</h3>
               </div>
            </div>
            <div class="col-md-4">
               <div class="project_box">
                  <figure><img src="images/project_img2canasta.jpg" alt="Canasta Familiar"></figure>
                  <h3>Canasta Familiar</h3>
               </div>
            </div>
            <div class="col-md-4">
               <div class="project_box">
                  <figure><img src="images/project_img3tec.jpg" alt="Tecnología"></figure>
                  <h3>Tecnología</h3>
               </div>
            </div>
         </div>
         <div class="text-center mt-4">
            <a class="read_more" href="index.php">Volver al Inicio</a>
         </div>
      </div>
   </div>
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
</body>
</html>
