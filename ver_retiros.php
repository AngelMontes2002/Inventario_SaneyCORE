<?php
include('verificar_sesion.php');

$conexion = new mysqli("localhost", "root", "", "inventario_saneyCORE");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

$order = (isset($_GET['order']) && $_GET['order'] == 'asc') ? 'ASC' : 'DESC';

// Paginación
$por_pagina = 20;
$pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$inicio = ($pagina - 1) * $por_pagina;

// Contar total de registros
$sql_total = "
    SELECT COUNT(DISTINCT r.id) AS total
    FROM retiros r
    JOIN usuarios u ON r.usuario_id = u.id_use
    LEFT JOIN detalle_retiro d ON r.id = d.retiro_id
";
$total_resultado = $conexion->query($sql_total);
$total_filas = $total_resultado->fetch_assoc()['total'];
$total_paginas = ceil($total_filas / $por_pagina);

// Consulta paginada
$sql = "
    SELECT 
        r.id,
        r.numero_orden,
        r.fecha,
        u.nombre AS usuario,
        IFNULL(SUM(d.cantidad_retirada), 0) AS total_retirado
    FROM retiros r
    JOIN usuarios u ON r.usuario_id = u.id_use
    LEFT JOIN detalle_retiro d ON r.id = d.retiro_id
    GROUP BY r.id
    ORDER BY r.fecha $order
    LIMIT $inicio, $por_pagina
";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Órdenes de Retiro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .detalle-retiro {
            display: none;
            margin-top: 10px;
        }
        .card + .card {
            margin-top: 20px;
        }
        .btn-group {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
            gap: 10px;
        }
        .order-btn {
            font-size: 1rem;
        }
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body class="bg-light">

<header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Órdenes de Retiro</h4>
    <div>
        <a href="modificarborrar.php" class="btn btn-outline-warning me-2">← Volver</a>
        <a href="cerrar_sesion.php" class="btn btn-outline-danger">⎋ Cerrar sesión</a>
    </div>
</header>

<div class="container mt-4">
    <input type="text" class="form-control mb-4" id="buscador" placeholder="🔍 Buscar por número de orden (ej: SAN000002)">

    <div class="btn-group">
        <a href="ver_retiros.php?order=asc" class="btn btn-outline-secondary order-btn">🔼 Ascendente</a>
        <a href="ver_retiros.php?order=desc" class="btn btn-outline-secondary order-btn">🔽 Descendente</a>
        <a href="xml/xml.php" class="btn btn-success">XML Resumido</a>
        <a href="xml/xml_detalle.php" class="btn btn-success">XML Completo</a>
    </div>

    <?php if ($resultado->num_rows === 0): ?>
        <p>No se encontraron órdenes de retiro.</p>
    <?php else: ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Número de Orden:</strong> <?= htmlspecialchars($fila['numero_orden']) ?><br>
                            <strong>Fecha:</strong> <?= htmlspecialchars($fila['fecha']) ?><br>
                            <strong>Usuario:</strong> <?= htmlspecialchars($fila['usuario']) ?>
                        </div>
                        <div>
                            <strong>Total Productos:</strong> <?= intval($fila['total_retirado']) ?>
                            <button class="btn btn-outline-secondary btn-sm ms-2 ver-detalles" data-id="<?= $fila['id'] ?>">👁</button>
                        </div>
                    </div>
                    <div class="detalle-retiro mt-3" id="detalle-<?= $fila['id'] ?>"></div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

    <!-- Paginación -->
    <nav aria-label="Paginación">
        <ul class="pagination mt-4">
            <?php if ($pagina > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $pagina - 1 ?>&order=<?= $order ?>">Anterior</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($pagina < $total_paginas): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $pagina + 1 ?>&order=<?= $order ?>">Siguiente</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script>
    document.querySelectorAll('.ver-detalles').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const contenedor = document.getElementById('detalle-' + id);
            if (contenedor.style.display === 'none' || contenedor.innerHTML === '') {
                fetch('ver_detalles.php?id=' + id)
                    .then(res => res.text())
                    .then(html => {
                        contenedor.innerHTML = html;
                        contenedor.style.display = 'block';
                    });
            } else {
                contenedor.style.display = 'none';
            }
        });
    });

    document.getElementById('buscador').addEventListener('keyup', function () {
        const texto = this.value.toLowerCase();
        document.querySelectorAll('.card').forEach(card => {
            const contenido = card.textContent.toLowerCase();
            card.style.display = contenido.includes(texto) ? '' : 'none';
        });
    });
</script>

</body>
</html>

<?php $conexion->close(); ?>
