<?php
$conn = new mysqli('localhost', 'root', '', 'inventario_saneyCORE');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $usuario_id = isset($data['id_usuario']) ? $conn->real_escape_string($data['id_usuario']) : null;
    $productos = isset($data['productos']) ? $data['productos'] : [];

    if (empty($usuario_id)) {
        echo json_encode(['error' => '❌ Falta el ID del usuario.']);
        exit;
    }

    if (empty($productos)) {
        echo json_encode(['error' => '❌ No se han seleccionado productos.']);
        exit;
    }

    // Insertamos retiro vacío primero
    $insert_retiro = $conn->query("INSERT INTO retiros (usuario_id) VALUES ('$usuario_id')");
    if (!$insert_retiro) {
        echo json_encode(['error' => '❌ Error al insertar retiro: ' . $conn->error]);
        exit;
    }

    $retiro_id = $conn->insert_id;
    $numero_orden = 'SAN' . str_pad($retiro_id, 5, '0', STR_PAD_LEFT);
    $conn->query("UPDATE retiros SET numero_orden = '$numero_orden' WHERE id = $retiro_id");

    foreach ($productos as $producto) {
        $codigo = intval($producto['id']);
        $cantidad = intval($producto['cantidad']);

        // Validar que el producto exista antes de continuar
        $resultado = $conn->query("SELECT unidad FROM producto WHERE Codigo_pro = $codigo");
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $stock_actual = intval($fila['unidad']);

            if ($cantidad > $stock_actual) {
                echo json_encode(['error' => "❌ No hay suficiente stock para el producto con código $codigo."]);
                exit;
            }

            $nuevo_stock = $stock_actual - $cantidad;

            // Insertar en detalle_retiro
            $insert_detalle = $conn->query("
                INSERT INTO detalle_retiro (retiro_id, producto_codigo, cantidad_retirada, stock_restante) 
                VALUES ($retiro_id, $codigo, $cantidad, $nuevo_stock)
            ");

            if (!$insert_detalle) {
                echo json_encode(['error' => "❌ Error al insertar detalle de retiro: " . $conn->error]);
                exit;
            }

            // Actualizar stock en producto
            $update_stock = $conn->query("UPDATE producto SET unidad = $nuevo_stock WHERE Codigo_pro = $codigo");

            if (!$update_stock) {
                echo json_encode(['error' => "❌ Error al actualizar stock: " . $conn->error]);
                exit;
            }
        } else {
            echo json_encode(['error' => "❌ El producto con código $codigo no existe en la base de datos."]);
            exit;
        }
    }

    echo json_encode(['success' => '✅ Retiro procesado con éxito.', 'orden' => $numero_orden]);
}
?>
