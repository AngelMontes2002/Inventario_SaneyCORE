<?php
session_start();

// Verifica que el usuario esté logueado y tenga el rol adecuado
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    // Si no está logueado o no tiene el rol adecuado, redirige a la página de login
    header("Location: login.php");
    exit; // Asegúrate de que no siga ejecutándose el código después de la redirección
}
?>
