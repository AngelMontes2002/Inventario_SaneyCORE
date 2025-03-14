/** 
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $feNacimiento = $_POST['fecha_na'];
    $direccion = $_POST['direccion'];
    $tipoDoc = $_POST['TipoDoc'];

    session_start();

    $conectar=mysqli_connect('localhost','root','','inventario_saney');

    $sql = "INSERT INTO empleado (n_identi , nombre_emp, fe_nacimiento, direccion, tipoDocu) VALUES ( '$documento','$nombre','$direccion', '$feNacimiento', '$tipoDoc')";
    $ejecutar=mysqli_query($conectar,$sql);

    if($ejecutar){
        $pdo->commit();
        echo "<script>alert('Datos Enviados')</script>";
        header("Location: http://localhost/inventario_saney/ModificarBorrar.php");

    }else{
        ?>
        ?php
        include("registro.php");
        ?>
      echo "<script>alert('Error en autenticacion')</script>";
        ?php
    }
//mysqli_free_result($ejecutar);
//mysqli_close($conectar);
/*