<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "conexion.php";
    $con = conectar();

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Función para validar usuario y obtener su nombre
    function validarUsuario($conexion, $tabla, $usuario, $password) {
        $stmt = $conexion->prepare("SELECT usuario, password FROM $tabla WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return $row['usuario']; // Retorna el nombre de usuario si la contraseña es válida
            }
        }
        return false;
    }

    // Validar en la tabla "useradmin"
    $nombreAdmin = validarUsuario($con, "useradmin", $usuario, $password);
    if ($nombreAdmin) {
        $_SESSION['usuario'] = $nombreAdmin;
        $_SESSION['rol'] = "admin";
        echo "<script>
                alert('Bienvenido Administrador: $nombreAdmin');
                window.location.href = 'modificarBorrar.php'; 
              </script>";
        exit();
    }

    // Validar en la tabla "usuarios"
    $nombreUsuario = validarUsuario($con, "usuarios", $usuario, $password);
    if ($nombreUsuario) {
        $_SESSION['usuario'] = $nombreUsuario;
        $_SESSION['rol'] = "usuario";
        echo "<script>
                alert('Bienvenido Usuario: $nombreUsuario');
                window.location.href = 'inicioLo.php'; 
              </script>";
        exit();
    }

    // Si no se encontró en ninguna tabla
    echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location.href = 'admincontra.php'; 
          </script>";

    $con->close();
}
?>
