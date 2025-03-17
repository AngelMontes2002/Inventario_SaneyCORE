<?php
session_start();

// Conectar a la base de datos
$conectar = new mysqli('localhost', 'root', '', 'inventario_saneyCORE');

if ($conectar->connect_error) {
    die("Error en la conexión: " . $conectar->connect_error);
}

// Recibir datos
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$usuario = trim($_POST['usuario'] ?? '');
$contraseña = trim($_POST['contraseña'] ?? '');
$confirmar_contraseña = trim($_POST['confirmar_contraseña'] ?? '');

// Guardar en sesión por si hay errores
$_SESSION['nombre'] = $nombre;
$_SESSION['apellido'] = $apellido;
$_SESSION['usuario'] = $usuario;

// Validaciones
if (empty($usuario) || empty($contraseña) || empty($confirmar_contraseña) || empty($nombre) || empty($apellido)) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header("Location: /inventario_saneyCORE/registro.php");
    exit();
}

if ($contraseña !== $confirmar_contraseña) {
    $_SESSION['error'] = "Las contraseñas no coinciden.";
    header("Location: /inventario_saneyCORE/registro.php");
    exit();
}

// Verificar si el usuario ya existe
$sql_check_usuario = "SELECT usuario FROM usuarios WHERE usuario = ?";
$stmt_check_usuario = $conectar->prepare($sql_check_usuario);
$stmt_check_usuario->bind_param("s", $usuario);
$stmt_check_usuario->execute();
$stmt_check_usuario->store_result();

if ($stmt_check_usuario->num_rows > 0) {
    $_SESSION['error'] = "El usuario ya está registrado.";
    header("Location: /inventario_saneyCORE/registro.php");
    exit();
}
$stmt_check_usuario->close();

// Verificar si el nombre y apellido ya están en uso
$sql_check_nombre = "SELECT nombre, apellido FROM usuarios WHERE nombre = ? AND apellido = ?";
$stmt_check_nombre = $conectar->prepare($sql_check_nombre);
$stmt_check_nombre->bind_param("ss", $nombre, $apellido);
$stmt_check_nombre->execute();
$stmt_check_nombre->store_result();

if ($stmt_check_nombre->num_rows > 0) {
    $_SESSION['error'] = "El nombre y apellido ya están registrados.";
    header("Location: /inventario_saneyCORE/registro.php");
    exit();
}
$stmt_check_nombre->close();

// Hashear la contraseña
$hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

// Insertar nuevo usuario
$sql_insert = "INSERT INTO usuarios (usuario, password, nombre, apellido) VALUES (?, ?, ?, ?)";
$stmt_insert = $conectar->prepare($sql_insert);

if ($stmt_insert) {
    $stmt_insert->bind_param("ssss", $usuario, $hashed_password, $nombre, $apellido);
    if ($stmt_insert->execute()) {
        unset($_SESSION['nombre'], $_SESSION['apellido'], $_SESSION['usuario']);
        $_SESSION['success'] = "Te registraste con éxito!";
        echo "<script>
                alert('Te registraste con éxito! Serás redirigido al login.');
                window.location.href = '/inventario_saneyCORE/login.php';
              </script>";
        exit();
    } else {
        $_SESSION['error'] = "Error en el registro.";
        header("Location: /inventario_saneyCORE/registro.php");
        exit();
    }
    $stmt_insert->close();
} else {
    $_SESSION['error'] = "Error en la consulta.";
    header("Location: /inventario_saneyCORE/registro.php");
    exit();
}

$conectar->close();
?>

