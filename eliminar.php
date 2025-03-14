<?php
include("conexion.php");
$con = conectar();

if(isset($_GET['codi'])) {
    $codigo = mysqli_real_escape_string($con, $_GET['codi']);
    $sql = "DELETE FROM producto WHERE Codigo_pro='$codigo'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        echo '<script>
        alert("Dato Eliminado");
        window.location.href="ModificarBorrar.php";
        </script>';
    } else {
        echo '<script>
        alert("Error al eliminar el dato");
        window.location.href="ModificarBorrar.php";
        </script>';
    }
}
?>