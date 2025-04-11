<?php
session_start();

if (!isset($_GET['id'])) {
    echo "⛔ ID de orden no especificado.";
    exit;
}

$id = $_GET['id'];

$conexion = new mysqli("localhost", "root", "", "inventario_saneyCORE");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Consulta de productos retirados
$sql = "
    SELECT 
        p.Codigo_pro,
        p.Nombre_pro,
        p.Describir,
        p.categoria,
        d.cantidad_retirada,
        d.stock_restante
    FROM detalle_retiro d
    JOIN producto p ON d.producto_codigo = p.Codigo_pro
    WHERE d.retiro_id = ?
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0): ?>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Cantidad Retirada</th>
                <th>Stock Restante</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $fila['Codigo_pro'] ?></td>
                <td><?= htmlspecialchars($fila['Nombre_pro']) ?></td>
                <td><?= htmlspecialchars($fila['Describir']) ?></td>
                <td><?= htmlspecialchars($fila['categoria']) ?></td>
                <td><?= $fila['cantidad_retirada'] ?></td>
                <td><?= $fila['stock_restante'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info">📦 Esta orden no tiene productos retirados.</div>
<?php endif;

$conexion->close();
?>
