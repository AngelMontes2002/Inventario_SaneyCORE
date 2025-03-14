<?php
include("conexion.php");
$con = conectar();

$codigo = $_GET['codigo'];

$consulta = "SELECT * FROM producto WHERE Codigo_pro = '$codigo'";
$resultado = mysqli_query($con, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    echo "existe";
} else {
    echo "no_existe";
}
?>
