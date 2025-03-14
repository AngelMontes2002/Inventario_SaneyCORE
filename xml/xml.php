<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'inventario_saneyCORE');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta a la base de datos
$sql = "SELECT * FROM empleado";
$result = $conexion->query($sql);

// Configurar cabeceras para la descarga como CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="empleados.csv"');

// Crear salida de CSV
$output = fopen('php://output', 'w');

// Escribir la primera fila con los encabezados
fputcsv($output, ['N. Identidad', 'Nombres', 'Fecha de Nacimiento', 'Dirección', 'Tipo de Documento']);

// Escribir los datos de cada empleado en el CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [$row['n_identi'], $row['nombre_emp'], $row['fe_nacimiento'], $row['direccion'], $row['tipoDocu']]);
}

// Cerrar el archivo temporal
fclose($output);
exit;
?>
