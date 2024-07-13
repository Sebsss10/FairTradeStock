<?php
// Configuración de la conexión a la base de datos
$host =  "127.0.0.1:3306";   // Cambia esto si tu base de datos está en otro servidor
$username =  "u414995690_root";    // Cambia esto por tu nombre de usuario de la base de datos
$password = 'Compu123#';            // Cambia esto por tu contraseña de la base de datos
$dbname = "u414995690_fts"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array('error' => 'Error interno del servidor al conectar con la base de datos'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_salida'])) {
    $id_salida = $_GET['id_salida'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM salidas WHERE id_salida = :id");
        $stmt->bindParam(':id', $id_salida, PDO::PARAM_INT);
        $stmt->execute();
        $salida = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($salida) {
            header('Content-Type: application/json');
            echo json_encode($salida);
        } else {
            http_response_code(404);
            echo json_encode(array('error' => 'Salida no encontrada'));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor al obtener datos de la salida'));
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_salida = $_POST['idsalida'];
    $fecha = $_POST['fecha'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $destino = $_POST['destino'];

    // Consultar la cantidad disponible en inventario para el producto seleccionado
    $sql_inventario = "SELECT cantidad_disponible FROM inventario WHERE id_producto = ?";
    $stmt_inventario = $pdo->prepare($sql_inventario);
    $stmt_inventario->bindParam(1, $id_producto, PDO::PARAM_INT);
    $stmt_inventario->execute();
    $cantidad_disponible = $stmt_inventario->fetchColumn();
    $stmt_inventario->closeCursor(); // Cerrar el cursor para permitir otra consulta

    // Verificar si hay suficientes productos en el inventario
    if ($cantidad <= $cantidad_disponible) {
        try {
            $stmt = $pdo->prepare("UPDATE salidas SET fecha = :fecha, id_producto = :id_producto, cantidad = :cantidad, destino = :destino WHERE id_salida = :id");
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':destino', $destino);
            $stmt->bindParam(':id', $id_salida, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $response = array(
                    'code' => 200,
                    'message' => 'Salida actualizada exitosamente'
                );
            } else {
                $response = array(
                    'code' => 404,
                    'message' => 'No se encontró la salida para actualizar o no hubo cambios'
                );
            }
        } catch (PDOException $e) {
            $response = array(
                'code' => 500,
                'message' => 'Error interno del servidor al actualizar la salida'
            );
        }
    } else {
        // Si no hay suficientes productos en el inventario
        $response = array(
            'code' => 400,
            'message' => 'No hay suficientes productos en el inventario para realizar esta salida'
        );
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

http_response_code(400);
echo json_encode(array('error' => 'Solicitud no válida'));
exit;

?>
