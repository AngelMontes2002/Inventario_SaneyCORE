<?php
session_start();
require "../conexion.php"; // corregido para que encuentre bien el archivo
$con = conectar();

// Tomar datos del formulario
$id = $_POST['id_use'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'] ?? null;
$contraseña = $_POST['contraseña'];
$rol = 'empleado';

// Validación de contraseña
if (strlen($contraseña) < 6) {
    $_SESSION['error'] = "La contraseña debe tener al menos 6 caracteres.";
    header("Location: http://localhost/inventario_saneyCORE/registro.php");
    exit();
}

// Verificar si ya existe el usuario
$stmt = $con->prepare("SELECT * FROM usuarios WHERE id_use = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $_SESSION['error'] = "Ya existe un usuario registrado con esta cédula.";
    header("Location: http://localhost/inventario_saneyCORE/registro.php");
    exit();
}

// Hashear la contraseña
$hash = password_hash($contraseña, PASSWORD_DEFAULT);

// Insertar el nuevo usuario
$stmt = $con->prepare("INSERT INTO usuarios (id_use, nombre, contraseña, telefono, rol) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $id, $nombre, $hash, $telefono, $rol);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
} else {
    $_SESSION['error'] = "Error al registrar usuario.";
}

// Redirigir de vuelta al formulario
header("Location: http://localhost/inventario_saneyCORE/registro.php");
exit();
?>
