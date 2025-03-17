<?php
session_start();

// Verificar si los datos fueron enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $conectar = new mysqli('localhost', 'root', '', 'inventario_saneyCORE');

    // Verificar la conexión
    if ($conectar->connect_error) {
        die("Error en la conexión: " . $conectar->connect_error);
    }

    // Recibir y validar datos
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : null;
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : null;
    $contraseña = isset($_POST['contraseña']) ? trim($_POST['contraseña']) : null;

    if (empty($usuario) || empty($contraseña) || empty($nombre) || empty($apellido)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.location='registro.php';</script>";
        exit();
    }

    // Comprobar si el usuario ya existe
    $sql_check = "SELECT usuario FROM usuarios WHERE usuario = ?";
    $stmt_check = $conectar->prepare($sql_check);
    $stmt_check->bind_param("s", $usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Usuario ya existe
        echo "<script>alert('El usuario ya está registrado, intenta con otro.'); window.location='/inventario_saneyCORE/registro.php';</script>";
        exit();
    }
    $stmt_check->close();

    // Hashear la contraseña
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (usuario, password, nombre, apellido) VALUES (?, ?, ?, ?)";
    $stmt = $conectar->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssss", $usuario, $hashed_password, $nombre, $apellido);
        $ejecutar = $stmt->execute();
        $stmt->close();

        if ($ejecutar) {
            echo "<script>alert('Registro exitoso. Bienvenido'); window.location='http://localhost/inventario_saneyCORE/login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error en el registro'); window.location='/inventario_saneyCORE/registro.php';</script>";
        }
    } else {
        echo "<script>alert('Error en la consulta SQL'); window.location='/inventario_saneyCORE/registro.php';</script>";
    }

    // Cerrar conexión
    $conectar->close();
}

