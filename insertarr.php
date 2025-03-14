<?php
if(isset($_POST['insert'])){
   $conectar = mysqli_connect('localhost', 'root', '', 'inventario_saney');
   
   $codigo = mysqli_real_escape_string($conectar, $_POST['codi']);
   $nombre = mysqli_real_escape_string($conectar, $_POST['nombre']);
   $descripcion = mysqli_real_escape_string($conectar, $_POST['descrip']);
   $unidad = mysqli_real_escape_string($conectar, $_POST['uni']);
   
   $insertar = "INSERT INTO producto (Codigo_pro, Nombre_pro, Describir, unidad) VALUES ('$codigo', '$nombre', '$descripcion', '$unidad')";
   $ejecutar = mysqli_query($conectar, $insertar);
   
   if($ejecutar){
      echo "<center><h2>Registro Insertado</h2></center>";
   } else {
      echo "<center><h2>Error al insertar</h2></center>";
   }
}
?>