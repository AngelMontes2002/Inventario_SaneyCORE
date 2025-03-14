<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "conexion.php";
    $con = conectar();

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Función para validar el usuario en una tabla específica
    function validarUsuario($conexion, $tabla, $usuario, $password) {
        $stmt = $conexion->prepare("SELECT password FROM $tabla WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return password_verify($password, $row['password']);
        }
        return false;
    }

    // Validar en la tabla "useradmin"
    if (validarUsuario($con, "useradmin", $usuario, $password)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: modificarBorrar.php");
        exit();
    }

    // Validar en la tabla "usuarios"
    if (validarUsuario($con, "usuarios", $usuario, $password)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: inicioLo.php");
        exit();
    }

    // Si no se encontró en ninguna tabla
    echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location.href = 'login.php'; 
          </script>";

    $con->close();
}
?>

