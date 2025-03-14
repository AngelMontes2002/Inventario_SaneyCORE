<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "conexion.php";
    $con = conectar();

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Buscar usuario en la base de datos
    $stmt = $con->prepare("SELECT password FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['password']; // Contraseña en la base de datos

        // Verificar si la contraseña ingresada es correcta
        if (password_verify($password, $hash)) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: inicioLo.php"); // Redirigir a la página de inicio
            exit();
        } else {
            // Mensaje de error con redirección
            echo "<script>
                    alert('Usuario o contraseña incorrectos');
                    window.location.href = 'login.php'; 
                  </script>";
        }
    } else {
        // Mensaje de error con redirección
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location.href = 'login.php'; 
              </script>";
    }

    $stmt->close();
    $con->close();
}
?>

