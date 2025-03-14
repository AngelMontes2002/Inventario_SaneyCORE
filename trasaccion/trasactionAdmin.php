<?php
$conectar = mysqli_connect('localhost', 'root', '', 'inventario_saneyCORE');
if (!$conectar) {
    die("Error de conexión: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$tipoDoc = $_POST['TipoDoc'];
$documento = $_POST['documento'];
$fecha_na = $_POST['fecha_na'];
$direccion = $_POST['direccion'];

// Convertir tipo de documento
if ($tipoDoc == "Cedula de Ciudadania") {
    $tipoDoc = "CC";
} elseif ($tipoDoc == "Cedula de Extrangeria") {
    $tipoDoc = "CE";
}

// Verificar si el número de identidad ya existe
$verificar = "SELECT * FROM admin WHERE n_identi = '$documento'";
$resultado = mysqli_query($conectar, $verificar);

if (mysqli_num_rows($resultado) > 0) {
    echo "Error: El Administrador con número de identidad $documento ya existe.";
} else {
    // Insertar solo si no existe
    $consulta = "INSERT INTO admin (nombre_emp, tipoDocu, n_identi, fe_nacimiento, direccion) 
                 VALUES ('$nombre', '$tipoDoc', '$documento', '$fecha_na', '$direccion')";

    if (mysqli_query($conectar, $consulta)) {
        echo "Empleado registrado con éxito.";
    } else {
        echo "Error: " . mysqli_error($conectar);
    }
}

mysqli_close($conectar);
?>
