<?php
session_start();
$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;
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
<header>
        <div class="header bg-dark text-white">
            <div class="container-fluid py-3">
                <div class="row align-items-center">
                    <!-- Logo / Título -->
                    <div class="col-md-3 text-center text-md-left">
                        <h1 class="h4 mb-0"><i class="fa fa-user-circle"></i> Bienvenido</h1>
                    </div>

                    <!-- Navegación -->
                    <div class="col-md-9">
                        <nav class="navbar navbar-expand-md navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                    <!-- Grupo: Navegación -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="modificarBorrar.php"><i class="fa fa-arrow-left"></i>Volver</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" href="cerrar_sesion.php"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
<body class="main-layout">

   <div class="container" style="max-width: 400px; margin-top: 8%;">
      <h2 class="text-center">Registro de usuario Empleado</h2>

      <?php if ($error): ?>
         <div class="alert alert-danger text-center"><?= $error ?></div>
      <?php endif; ?>

      <?php if ($success): ?>
         <script>
            alert("<?= $success ?>");
            window.location.href = "login.php";
         </script>
      <?php endif; ?>

      <form action="/inventario_saneyCORE/inicio/validarRe.php" method="post" onsubmit="return validarContraseña()">
         <div class="form-group">
            <label>Cédula:</label>
            <input type="text" name="id_use" class="form-control" required>
         </div>

         <div class="form-group">
            <label>Nombre completo:</label>
            <input type="text" name="nombre" class="form-control" required>
         </div>

         <div class="form-group">
            <label>Teléfono:</label>
            <input type="text" name="telefono" class="form-control">
         </div>

         <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" class="form-control" required>
         </div>

         <div class="form-group">
            <label>Confirmar Contraseña:</label>
            <input type="password" id="confirmar_contraseña" class="form-control" required>
         </div>

         <button type="submit" class="btn btn-success btn-block">Registrar</button>
      </form>
   </div>

   <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
unset($_SESSION['error'], $_SESSION['success']);
?>
