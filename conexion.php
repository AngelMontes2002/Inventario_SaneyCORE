<?php
function conectar() {
    $host = "localhost";  // Cambiar a la IP de la base de datos en la nube
    $user = "root";  // Usuario seguro
    $pass = "";  // Contraseña segura
    $bd = "inventario_saneycore";

    // Conexión con manejo de errores
    $con = new mysqli($host, $user, $pass, $bd);

    // Verificar si hay error en la conexión
    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }

    return $con;
}
?>