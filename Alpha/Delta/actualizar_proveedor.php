<?php
// Configuración de la conexión a la base de datos
$host =  "127.0.0.1:3306";   // Cambia esto si tu base de datos está en otro servidor
$username =  "u414995690_root";    // Cambia esto por tu nombre de usuario de la base de datos
$password = 'Compu123#';            // Cambia esto por tu contraseña de la base de datos
$dbname = "u414995690_fts"; 

try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array('error' => 'Error interno del servidor al conectar con la base de datos'));
    exit;
}

// Verificar si la solicitud es GET para obtener datos del proveedor por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_proveedor'])) {
    $id_proveedor = $_GET['id_proveedor'];

    try {
        // Preparar la consulta SQL para obtener los datos del proveedor por su ID
        $stmt = $pdo->prepare("SELECT * FROM proveedores WHERE id_proveedor = :id");
        $stmt->bindParam(':id', $id_proveedor, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los datos del proveedor como un arreglo asociativo
        $proveedor = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron datos del proveedor
        if ($proveedor) {
            // Devolver los datos del proveedor como JSON
            header('Content-Type: application/json');
            echo json_encode($proveedor);
        } else {
            // Si no se encuentra el proveedor, devolver un mensaje de error
            http_response_code(404);
            echo json_encode(array('error' => 'Proveedor no encontrado'));
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor al obtener datos del proveedor'));
    }
    exit;
}

// Verificar si la solicitud es POST para actualizar los datos del proveedor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_proveedor = $_POST['idPr'];
    $nombre = $_POST['nombrePr'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    try {
        // Preparar la consulta SQL UPDATE para actualizar los datos del proveedor
        $stmt = $pdo->prepare("UPDATE proveedores SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE id_proveedor = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id_proveedor, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->rowCount() > 0) {
            // Actualización exitosa
            $response = array(
                'code' => 200,
                'message' => 'Proveedor actualizado exitosamente'
            );
        } else {
            // No se actualizó ningún registro (el proveedor no existe o no se modificaron datos)
            $response = array(
                'code' => 404,
                'message' => 'No se encontró el proveedor para actualizar o no hubo cambios'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al actualizar el proveedor'
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
