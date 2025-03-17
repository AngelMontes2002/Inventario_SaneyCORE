<?php
session_start();
$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;
unset($_SESSION['error'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Registro de usuario</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <script>
      function validarContraseña() {
         let pass1 = document.getElementById('contraseña').value;
         let pass2 = document.getElementById('confirmar_contraseña').value;
         if (pass1.length < 6) {
            alert('La contraseña debe tener al menos 6 caracteres.');
            return false;
         }
         if (pass1 !== pass2) {
            alert('Las contraseñas no coinciden. Inténtalo de nuevo.');
            return false;
         }
         return true;
      }
   </script>
</head>
<body class="main-layout">

   <!-- Encabezado -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
         <a class="navbar-brand" href="#">Inventario SaneyCORE</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
               <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
            </ul>
         </div>
      </div>
   </nav>

   <div class="container" style="max-width: 400px; margin-top: 8%;">
      <h2 class="text-center">Registro de usuario</h2>

      <?php if ($error): ?>
         <div class="alert alert-danger text-center"><?= $error ?></div>
      <?php endif; ?>

      <?php if ($success): ?>
         <script>
            alert("<?= $success ?>");
            window.location.href = "login.php"; // Redirigir al login tras aceptar el mensaje
         </script>
      <?php endif; ?>

      <form action="inicio/validarRE.php" method="post" onsubmit="return validarContraseña()">
         <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= $_SESSION['nombre'] ?? '' ?>" required>
         </div>

         <div class="form-group">
            <label>Apellido:</label>
            <input type="text" name="apellido" class="form-control" value="<?= $_SESSION['apellido'] ?? '' ?>" required>
         </div>

         <div class="form-group">
            <label>Usuario:</label>
            <input type="text" name="usuario" class="form-control" value="<?= $_SESSION['usuario'] ?? '' ?>" required>
         </div>

         <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" class="form-control" required>
         </div>

         <div class="form-group">
            <label>Confirmar Contraseña:</label>
            <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" class="form-control" required>
         </div>

         <button type="submit" class="btn btn-success btn-block">Registrar</button>
      </form>
   </div>

   <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
