<?php
// Configuración de la conexión a la base de datos
$host =  "127.0.0.1:3306";   // Cambia esto si tu base de datos está en otro servidor
$username =  "u414995690_root";    // Cambia esto por tu nombre de usuario de la base de datos
$password = 'Compu123#';            // Cambia esto por tu contraseña de la base de datos
$dbname = "u414995690_fts";           // Nombre de la base de datos


try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array('error' => 'Error interno del servidor al conectar con la base de datos'));
    exit;
}

// Verificar si la solicitud es GET para obtener datos de la entrada por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_entrada'])) {
    $id_entrada = $_GET['id_entrada'];

    try {
        // Preparar la consulta SQL para obtener los datos de la entrada por su ID
        $sql = "SELECT * FROM entradas WHERE id_entrada = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id_entrada, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los datos de la entrada como un arreglo asociativo
        $entrada = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron datos de la entrada
        if ($entrada) {
            // Devolver los datos de la entrada como JSON
            header('Content-Type: application/json');
            echo json_encode($entrada);

        } else {
            // Si no se encuentra la entrada, devolver un mensaje de error
            http_response_code(404);
            echo json_encode(array('error' => 'Entrada no encontrada'));
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor al obtener datos de la entrada'));
    }
    exit;
}

// Verificar si la solicitud es POST para actualizar los datos de la entrada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_entrada = $_POST['id_entrada'];
    $fecha = $_POST['fecha'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $id_proveedor = $_POST['id_proveedor'];

    try {
        // Preparar la consulta SQL UPDATE para actualizar los datos de la entrada
        $sql = "UPDATE entradas SET fecha = :fecha, id_producto = :id_producto, cantidad = :cantidad, id_proveedor = :id_proveedor WHERE id_entrada = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id_entrada, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->rowCount() > 0) {
            // Actualización exitosa
            $response = array(
                'code' => 200,
                'message' => 'Entrada actualizada exitosamente'
            );
        } else {
            // No se actualizó ningún registro (la entrada no existe o no se modificaron datos)
            $response = array(
                'code' => 404,
                'message' => 'No se encontró la entrada para actualizar o no hubo cambios'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al actualizar la entrada'
        );
    }
    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Si la solicitud no es ni GET ni POST, devolver un error de solicitud no válida
http_response_code(400);
echo json_encode(array('error' => 'Solicitud no válida'));
exit;
?>
