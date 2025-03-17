<?php
session_start(); // Iniciar sesión para recordar los datos

$nombre = $_POST['nombre'];
$documento = $_POST['documento'];
$email = $_POST['email'];
$celular = $_POST['cel'];
$direccion = $_POST['direccion'];
$tipoDoc = $_POST['TipoDoc'];

// Guardar datos en sesión en caso de error
$_SESSION['form_data'] = [
    'nombre' => $nombre,
    'documento' => $documento,
    'email' => $email,
    'celular' => $celular,
    'direccion' => $direccion,
    'tipoDoc' => $tipoDoc
];

// Conexión a la base de datos
$conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');

if (!$conectar) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Verificar si el documento o correo ya existen
$sql_verificar = "SELECT * FROM cliente WHERE identi_cliente = '$documento' OR correo = '$email'";
$resultado = mysqli_query($conectar, $sql_verificar);

if (mysqli_num_rows($resultado) > 0) {
    // Si el documento o correo ya existen, redirigir al formulario manteniendo los datos
    $_SESSION['error_message'] = "Error: El cliente ya está registrado con ese documento o correo.";
    header("Location: http://localhost/inventario_saneyCORE/contacto.php");
    exit();
} else {
    // Insertar solo si el documento y el correo no existen
    $sql_insertar = "INSERT INTO cliente (identi_cliente, nombre, direccion, correo, numero, tipoDoc) 
                     VALUES ('$documento', '$nombre', '$direccion', '$email', '$celular', '$tipoDoc')";
    $ejecutar = mysqli_query($conectar, $sql_insertar);

    if ($ejecutar) {
        unset($_SESSION['form_data']); // Limpiar datos de sesión si el registro es exitoso
        echo "<script>
                alert('Datos enviados correctamente');
                window.location.href = 'http://localhost/inventario_saneyCORE/index.php';
              </script>";
        exit();
    } else {
        $_SESSION['error_message'] = "Error al registrar los datos.";
        header("Location: http://localhost/inventario_saneyCORE/contacto.php");
        exit();
    }
}

// Liberar resultado y cerrar conexión
mysqli_free_result($resultado);
mysqli_close($conectar);
?>
