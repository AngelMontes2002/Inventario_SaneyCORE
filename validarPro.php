<?php
    $codigo = $_POST['codi'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descrip'];
    $unidades = $_POST['uni'];
    $genero = $_POST['genero'];
    session_start();

    $conectar=mysqli_connect('localhost','root','','inventario_saney');

    $sql = "INSERT INTO producto (Codigo_pro,Nombre_pro,Describir,unidad,categoria) VALUES ( '$codigo','$nombre','$descripcion', '$unidades', '$genero')";
    $ejecutar=mysqli_query($conectar,$sql);

    if($ejecutar){
        echo'<script>
        alert("Registrado con exito");
        window.location.href="verProductos.php";
        </script>';

    }else{
        ?>
        <?php
        include("crearPro.php");
        ?>
      echo "<script>alert('Error en autenticacion')</script>";
        <?php
    }
mysqli_free_result($ejecutar);
mysqli_close($conectar);
?>