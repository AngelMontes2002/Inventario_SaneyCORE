<?php
include('verificar_sesion.php'); // Incluir la verificación de sesión

$conexion = new mysqli("localhost", "root", "", "inventario_saneyCORE");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Establecemos el orden por defecto (descendente)
$order = 'DESC'; 

// Si se recibe un parámetro para cambiar el orden, lo actualizamos
if (isset($_GET['order']) && $_GET['order'] == 'asc') {
    $order = 'ASC';
}

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

        .order-btn {
            font-size: 1.2rem;
            cursor: pointer;
            background-color: transparent;
            border: 1px solid #ccc;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .order-btn:hover {
            background-color: #e0e0e0;
        }

        .order-btn:focus {
            outline: none;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-light">

    <header class="bg-primary text-white p-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Órdenes de Retiro</h4>
        <div>
            <a href="modificarborrar.php" class="btn btn-warning me-2">← Volver</a>
            <a href="cerrar_sesion.php" class="btn btn-danger">⎋ Cerrar sesión</a>
        </div>
    </header>

    <div class="container mt-4">
        <input type="text" class="form-control mb-4" id="buscador" placeholder="🔍 Buscar por número de orden (ej: SAN000002)">
        
        <!-- Botones de orden -->
        <div class="btn-group">
            <button class="btn btn-outline-secondary order-btn" onclick="window.location.href='ver_retiros.php?order=asc'">🔼 Orden Ascendente</button>
            <button class="btn btn-outline-secondary order-btn" onclick="window.location.href='ver_retiros.php?order=desc'">🔽 Orden Descendente</button>
        </div>

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
                            <button class="btn btn-outline-secondary btn-sm ms-2 ver-detalles" data-id="<?= $fila['id'] ?>">
                                👁
                            </button>
                        </div>
                    </div>
                    <div class="detalle-retiro mt-3" id="detalle-<?= $fila['id'] ?>"></div>
                </div>
            </div>
        <?php endwhile; ?>
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
