<?php
    $user = $_GET['user'];

    $password = $_GET['password'];
 
 
    if (($user == "admin") AND ($password == "0000")){
 
        echo'<script>
        alert("Bienvenido Administrador");
        window.location.href="ModificarBorrar.php";
        </script>';
    }
 
    else{
 
        $var="Datos incorrectos!!!";
        echo "<script>alert('$var');window.history.back();</script>";

    }
 
 ?>
