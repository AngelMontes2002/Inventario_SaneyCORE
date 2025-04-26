<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$idUsuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Ver Productos</title>

   <!-- CSS locales -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/font-awesome.min.css">
   <style>
      body {
         background: #f7f7f7 !important;
      }
      .product-card {
         background: white;
         border-radius: 12px;
         box-shadow: 0 4px 8px rgba(0,0,0,0.1);
         padding: 20px;
         margin-bottom: 20px;
         transition: 0.3s;
         cursor: pointer;
         border: 2px solid transparent;
      }
      .product-card.selected {
         border-color: #0d6efd;
         background-color: #e9f2ff;
      }
      .product-card:hover {
         transform: translateY(-5px);
         box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      }
      .product-icon {
         font-size: 32px;
         color: #0d6efd;
         margin-right: 10px;
      }
      #carrito {
         position: fixed;
         top: 80px;
         right: 0;
         width: 300px;
         background: #fff;
         border-left: 2px solid #ccc;
         padding: 15px;
         height: 90vh;
         overflow-y: auto;
         box-shadow: -4px 0 10px rgba(0,0,0,0.1);
         z-index: 999;
      }
      #carrito h4 {
         font-weight: bold;
         margin-bottom: 10px;
      }
      .carrito-item {
         margin-bottom: 10px;
         border-bottom: 1px solid #eee;
         padding-bottom: 8px;
      }
      .header {
         background: #000;
         padding: 10px 0;
      }
      .header .logo h1 {
         color: white;
         margin: 0;
      }
      .navbar-dark .navbar-nav .nav-link {
         color: white !important;
         font-weight: bold;
         font-size: 16px;
         padding: 8px 15px;
      }
      .navbar-dark .navbar-nav .nav-link:hover {
         color: #ffc107 !important;
      }
      .yellow {
         color: #ffc107 !important;
      }
   </style>
</head>
<body class="main-layout">

<!-- ENCABEZADO -->
<header>
   <div class="header">
      <div class="container-fluid">
         <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
               <div class="full">
                  <div class="logo">
                     <a href="inicioLo.php">
                        <h1 style="color: white; padding: 5px 150px;">Bienvenido</h1>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
               <nav class="navigation navbar navbar-expand-md navbar-dark" style="padding: 0 250px;">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarsExample04">
                     <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-cogs"></i>Login Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-plus-square"></i>Login Supervisor</a></li>
                        <li class="nav-item"><a class="nav-link" href="cerrar_sesion.php"><span class="yellow"><i class="fa fa-sign-out"></i> Cerrar sesión</span></a></li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- LISTA PRODUCTOS -->
<div class="container mt-5">
   <h2 class="text-center mb-4">Listado de Productos</h2>
   <div class="row">
      <?php
      $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
      if (!$conectar) {
         die("Error de conexión: " . mysqli_connect_error());
      }

      $consulta = "SELECT * FROM producto";
      $ejecutar = mysqli_query($conectar, $consulta);

      while ($fila = mysqli_fetch_array($ejecutar)) {
         $codigo = htmlspecialchars($fila['Codigo_pro']);
         $nombre = htmlspecialchars($fila['Nombre_pro']);
         $descripcion = htmlspecialchars($fila['Describir']);
         $unidad = htmlspecialchars($fila['unidad']);
         $categoria = htmlspecialchars($fila['categoria']);
      ?>
         <div class="col-md-6 col-lg-4">
            <div class="product-card" id="prod_<?php echo $codigo; ?>" onclick="alternarProducto('<?php echo $codigo; ?>', '<?php echo addslashes($nombre); ?>')">
               <div class="d-flex align-items-center mb-2">
                  <i class="fa fa-cube product-icon"></i>
                  <h5 class="mb-0"><?php echo $nombre; ?></h5>
               </div>
               <p><strong>Código:</strong> <?php echo $codigo; ?></p>
               <p><strong>Descripción:</strong> <?php echo $descripcion; ?></p>
               <p><strong>Unidades:</strong> <?php echo $unidad; ?></p>
               <p><strong>Categoría:</strong> <?php echo $categoria; ?></p>
            </div>
         </div>
      <?php } ?>
   </div>
</div>

<!-- VENTANA DE CARRITO -->
<div id="carrito">
   <h4>Productos Seleccionados</h4>
   <div id="listaCarrito"></div>
   <button class="btn btn-primary mt-3 w-100" onclick="procesarRetiro()">Procesar Retiro</button>
   <div id="respuestaServidor" class="mt-3 text-success font-weight-bold"></div>
</div>

<!-- JS -->
<script>
   const ID_USUARIO = "<?php echo addslashes($idUsuario); ?>";
   const carrito = {};

   function alternarProducto(codigo, nombre) {
      const card = document.getElementById('prod_' + codigo);
      if (carrito[codigo]) {
         delete carrito[codigo];
         card.classList.remove('selected');
      } else {
         carrito[codigo] = { nombre: nombre, cantidad: 1 };
         card.classList.add('selected');
      }
      renderizarCarrito();
   }

   function actualizarCantidad(codigo, nuevaCantidad) {
      if (carrito[codigo]) {
         carrito[codigo].cantidad = parseInt(nuevaCantidad);
         renderizarCarrito();
      }
   }

   function renderizarCarrito() {
      const lista = document.getElementById('listaCarrito');
      lista.innerHTML = '';
      for (const codigo in carrito) {
         const item = carrito[codigo];
         lista.innerHTML += `
            <div class="carrito-item">
               <strong>${item.nombre}</strong><br>
               Cantidad: 
               <input type="number" min="1" value="${item.cantidad}" onchange="actualizarCantidad('${codigo}', this.value)" style="width: 60px;">
            </div>
         `;
      }
   }

   function procesarRetiro() {
    const productos = [];
    for (const codigo in carrito) {
        productos.push({ id: codigo, cantidad: carrito[codigo].cantidad });
    }

    fetch('procesar_retiro.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id_usuario: ID_USUARIO,
            productos: productos
        })
    })
    .then(res => res.json())  // Cambié .text() a .json() porque el servidor devuelve un JSON
    .then(data => {
        if (data.success) {
            document.getElementById('respuestaServidor').innerText = data.success;

            // Mostrar una ventana emergente con el número de retiro
            alert("¡Retiro exitoso! Número de orden: " + data.orden);

            // Recargar la página para actualizar la interfaz
            location.reload();
        } else {
            document.getElementById('respuestaServidor').innerText = data.error;
        }
    })
    .catch(error => {
        document.getElementById('respuestaServidor').innerText = "❌ Error al procesar el retiro";
        console.error('Error:', error);
    });
}


   function carritoReset() {
      for (const codigo in carrito) {
         const card = document.getElementById('prod_' + codigo);
         if (card) card.classList.remove('selected');
         delete carrito[codigo];
      }
      renderizarCarrito();
   }
</script>
</body>
</html>
