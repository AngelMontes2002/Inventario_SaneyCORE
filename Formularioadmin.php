<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>SANEY - Registro</title>
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
   <div class="container" style="max-width: 400px; margin-top: 8%;">
      <h2 class="text-center">Registro de Usuario</h2>

      <?php
      session_start();
      if (isset($_SESSION['error'])) {
         echo "<div class='alert alert-danger text-center'>" . $_SESSION['error'] . "</div>";
         unset($_SESSION['error']);
      }
      ?>

      <form action="inicio/validarRE.php" method="post">
         <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>" required>
         </div>

         <div class="form-group">
            <label>Apellido:</label>
            <input type="text" name="apellido" class="form-control" value="<?php echo isset($_SESSION['apellido']) ? $_SESSION['apellido'] : ''; ?>" required>
         </div>

         <div class="form-group">
            <label>Usuario:</label>
            <input type="text" name="usuario" class="form-control" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>" required>
         </div>

         <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="contraseña" class="form-control" required>
         </div>

         <button type="submit" class="btn btn-success btn-block">Registrar</button>
      </form>
   </div>
</body>
</html>

