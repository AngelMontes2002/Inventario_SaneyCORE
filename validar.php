<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "conexion.php";
    $con = conectar();

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Buscar al usuario
    $stmt = $con->prepare("SELECT id_use, nombre, contraseña, rol FROM usuarios WHERE id_use = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuarioData = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($password, $usuarioData['contraseña'])) {
            $_SESSION['usuario'] = $usuarioData['id_use'];
            $_SESSION['nombre'] = $usuarioData['nombre'];
            $_SESSION['rol'] = $usuarioData['rol'];

            // Redirigir según el rol
            switch ($usuarioData['rol']) {
                case 'admin':
                    header("Location: modificarBorrar.php");
                    break;
                case 'supervisor':
                    header("Location: inicioLo.php");
                    break;
                case 'empleado':
                    header("Location: inicioEmple.php");
                    break;
                default:
                    echo "<script>
                            alert('Rol desconocido.');
                            window.location.href = 'http://localhost/Inventario_SaneyCORE/login.php';
                          </script>";
                    exit();
            }
        } else {
            // Contraseña incorrecta
            echo "<script>
                    alert('Contraseña incorrecta');
                    window.location.href = 'http://localhost/Inventario_SaneyCORE/login.php';
                  </script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>
                alert('Usuario no encontrado');
                window.location.href = 'http://localhost/Inventario_SaneyCORE/login.php';
              </script>";
    }

    $con->close();
}
?>
