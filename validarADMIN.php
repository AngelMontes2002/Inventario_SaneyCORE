<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "conexion.php";
    $con = conectar();

    $user = $_POST['user'] ?? '';  
    $password = $_POST['password'] ?? '';

    // Verificar si los campos están vacíos
    if (empty($user) || empty($password)) {
        header("Location: admincontra.php?error=vacio");
        exit();
    }

    // Consulta segura con Prepared Statements
    $stmt = $con->prepare("SELECT password FROM admin WHERE usuario = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($password === $hash) {  // O usa password_verify($password, $hash) si está encriptado
        session_start();
        $_SESSION['admin'] = $user;
    
        echo "<script>
                alert('Bienvenido Administrador');
                window.location.href = 'ModificarBorrar.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location.href = 'admincontra.php';
              </script>";
        exit();
    }    
}
?>