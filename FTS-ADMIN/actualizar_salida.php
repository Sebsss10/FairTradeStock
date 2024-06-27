<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';       // Cambia esto si tu base de datos está en otro servidor
$username = 'root';        // Cambia esto por tu nombre de usuario de la base de datos
$password = '';            // Cambia esto por tu contraseña de la base de datos
$dbname = 'fts';           // Nombre de la base de datos

try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array('error' => 'Error interno del servidor al conectar con la base de datos'));
    exit;
}

// Verificar si la solicitud es GET para obtener datos de salida por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_salida'])) {
    $id_salida = $_GET['id_salida'];

    try {
        // Preparar la consulta SQL para obtener los datos de salida por su ID
        $stmt = $pdo->prepare("SELECT * FROM salidas WHERE id_salida = :id");
        $stmt->bindParam(':id', $id_salida, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los datos de la salida como un arreglo asociativo
        $salida = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron datos de la salida
        if ($salida) {
            // Devolver los datos de la salida como JSON
            header('Content-Type: application/json');
            echo json_encode($salida);
        } else {
            // Si no se encuentra la salida, devolver un mensaje de error
            http_response_code(404);
            echo json_encode(array('error' => 'Salida no encontrada'));
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor al obtener datos de la salida'));
    }
    exit;
}

// Verificar si la solicitud es POST para actualizar los datos de la salida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_salida = $_POST['idsalida'];
    $fecha = $_POST['fecha'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $destino = $_POST['destino'];

    try {
        // Preparar la consulta SQL UPDATE para actualizar los datos de la salida
        $stmt = $pdo->prepare("UPDATE salidas SET fecha = :fecha, id_producto = :id_producto, cantidad = :cantidad, destino = :destino WHERE id_salida = :id");
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':destino', $destino);
        $stmt->bindParam(':id', $id_salida, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->rowCount() > 0) {
            // Actualización exitosa
            $response = array(
                'code' => 200,
                'message' => 'Salida actualizada exitosamente'
            );
        } else {
            // No se actualizó ningún registro (la salida no existe o no se modificaron datos)
            $response = array(
                'code' => 404,
                'message' => 'No se encontró la salida para actualizar o no hubo cambios'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al actualizar la salida'
        );
    }
    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Si la solicitud no es GET ni POST, devolver un error de solicitud no válida
http_response_code(400);
echo json_encode(array('error' => 'Solicitud no válida'));
exit;
?>
