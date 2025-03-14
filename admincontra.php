<!DOCTYPE html>
<html lang="es">
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">

   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">

   <title>Login</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<?php
if (isset($_GET['error'])) {
   $error = $_GET['error'];
   if ($error == "incorrecto") {
      echo "<script>alert('EL USUARIO O CONTRASEÑA INCORRECTOS')</script>";
   }
   if ($error == "vacio") {
      echo "<script>alert('Los datos estan vacios')</script>";
   }
}


?>
<header>

   <div class="header">
      <div class="container-fluid">
         <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
               <div class="full">
                  <div class="logo">
                     <a href="inicioLo.php">
                        <h1 style="color: white; padding: 5px 150px;">Administrador</h1>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</header>

<body>
<form action="validarADMIN.php" method="POST" style="text-align: center ; margin: 8% 20px;">
      <h1 class="h1" style="color: black;">Inicio Administrador</h1>
      <p>Usuario</p><input type="text" placeholder="Ingrese su usuario" name="user">
      <p>password</p><input type="password" placeholder="Ingrese su contarseña" name="password"><br><br>
      <input type="submit" class="btn btn-success" value="Ingresar" name="btningresar">
   </form>
</body>

</html>