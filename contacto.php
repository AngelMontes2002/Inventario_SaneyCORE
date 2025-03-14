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
   <header class="bg-dark py-3">
      <div class="container d-flex justify-content-between align-items-center">
         <a href="index.php"><img src="images/logo2.png" width="70px" height="50px" alt="Logo"></a>
         <nav>
            <ul class="nav">
               <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
               <li class="nav-item"><a class="nav-link text-white" href="Quienessomos.php">Quienes somos</a></li>
               <li class="nav-item"><a class="nav-link text-white" href="contacto.php">Contactos</a></li>
               <li class="nav-item"><a class="nav-link text-warning" href="login.php">Login</a></li>
            </ul>
         </nav>
      </div>
   </header>
   <section class="container mt-5">
      <div class="row">
         <div class="col-md-8 offset-md-2">
            <h2 class="text-center">Contacto</h2>
            <form action="inicio/validarCliente.php" method="POST" class="p-4 border rounded bg-light">
               <div class="mb-3">
                  <label class="form-label">Nombre Completo</label>
                  <input type="text" class="form-control" name="nombre" required>
               </div>
               <div class="mb-3">
                  <label class="form-label">Tipo de Documento</label>
                  <select class="form-select" name="TipoDoc" required>
                     <option value="CC">Cédula de Ciudadanía</option>
                     <option value="CE">Cédula de Extranjería</option>
                  </select>
               </div>
               <div class="mb-3">
                  <label class="form-label">Número de Identidad</label>
                  <input type="number" class="form-control" name="documento" required>
               </div>
               <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" required>
               </div>
               <div class="mb-3">
                  <label class="form-label">Celular</label>
                  <input type="tel" class="form-control" name="cel" required>
               </div>
               <div class="mb-3">
                  <label class="form-label">Dirección</label>
                  <input type="text" class="form-control" name="direccion" required>
               </div>
               <div class="text-center">
                  <button type="submit" class="btn btn-primary">Enviar</button>
                  <button type="reset" class="btn btn-secondary">Borrar</button>
               </div>
            </form>
         </div>
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

