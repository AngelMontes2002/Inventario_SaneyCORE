<?php
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $email = $_POST['email'];
    $celular = $_POST['cel'];
    $direccion = $_POST['direccion'];
    $tipoDoc = $_POST['TipoDoc'];

    session_start();

    $conectar=mysqli_connect('localhost','root','','inventario_saney');

    $sql = "INSERT INTO cliente (identi_cliente , nombre, direccion, correo, numero,tipoDoc) VALUES ( '$documento','$nombre','$direccion', '$email', '$celular', '$tipoDoc')";
    $ejecutar=mysqli_query($conectar,$sql);

    if($ejecutar){
        echo "<script>alert('Datos Enviados')</script>";
        header("Location: http://localhost/inventario_saney/index.php");

    }else{
        ?>
        <?php
        include("registro.php");
        ?>
      echo "<script>alert('Error en autenticacion')</script>";
        <?php
    }
mysqli_free_result($ejecutar);
mysqli_close($conectar);
?>