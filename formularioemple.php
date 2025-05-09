<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Registro</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="main-layout contact_page">
   <header>
      <div class="header">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-md-2">
                  <div class="logo">
                     <a href="index.php"><img src="images/logo2.png" width="70px" height="50px" alt="Logo" /></a>
                  </div>
               </div>
               <div class="col-md-10">
                  <nav class="navbar navbar-expand-md navbar-dark">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                           <li class="nav-item active">
                              <a class="nav-link" href="login.php">Home</a>
                           </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </header>
   <div class="container mt-5">
      <h2 class="text-center">Registro</h2>
      <form id="request" action="trasaccion/trasaction.php" method="POST" class="mt-4">
         <div class="form-group">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre completo" required>
         </div>
         <div class="form-group">
            <label for="tipoDoc">Tipo de Documento:</label>
            <select class="form-control" id="tipoDoc" name="TipoDoc" required>
               <option value="CC">Cédula de Ciudadanía</option>
               <option value="CE">Cédula de Extranjería</option>
            </select>
         </div>
         <div class="form-group">
            <label for="documento">Número de Identidad:</label>
            <input type="number" class="form-control" id="documento" name="documento" placeholder="Ingrese su número de identificación" required>
         </div>
         <div class="form-group">
            <label for="fecha_na">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fecha_na" name="fecha_na" required>
         </div>
         <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su dirección" required>
         </div>
         <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
         </div>
      </form>
   </div>
   <footer class="text-center mt-5 p-3 bg-dark text-white">
      <p>&copy; 2025 SANEY. Todos los derechos reservados.</p>
   </footer>
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>