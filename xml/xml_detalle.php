<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "inventario_saneyCORE");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Consulta con detalles de productos
$sql = "
    SELECT 
        r.numero_orden,
        r.fecha,
        u.nombre AS usuario,
        IFNULL(p.Nombre_pro, 'Sin producto') AS producto,
        IFNULL(d.cantidad_retirada, 0) AS cantidad_retirada
    FROM retiros r
    JOIN usuarios u ON r.usuario_id = u.id_use
    LEFT JOIN detalle_retiro d ON r.id = d.retiro_id
    LEFT JOIN producto p ON d.producto_codigo = p.Codigo_pro
    ORDER BY r.fecha DESC, r.numero_orden
";

$resultado = $conexion->query($sql);

// Encabezados para la descarga como CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="ordenes_retiro_detallado.csv"');

// Crear el archivo CSV en memoria
$output = fopen('php://output', 'w');

// Escribir encabezados
fputcsv($output, ['Número de Orden', 'Fecha', 'Usuario', 'Producto', 'Cantidad Retirada']);

// Escribir datos
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        fputcsv($output, [
            $row['numero_orden'],
            $row['fecha'],
            $row['usuario'],
            $row['producto'],
            $row['cantidad_retirada']
        ]);
    }
} else {
    fputcsv($output, ['No se encontraron datos']);
}

// Cerrar
fclose($output);
$conexion->close();
exit;
?>
