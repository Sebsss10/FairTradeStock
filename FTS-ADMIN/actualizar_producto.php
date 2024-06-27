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

// Verificar si la solicitud es GET para obtener datos del producto por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    try {
        // Preparar la consulta SQL para obtener los datos del producto por su ID
        $stmt = $pdo->prepare("SELECT * FROM productos WHERE id_producto = :id");
        $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los datos del producto como un arreglo asociativo
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron datos del producto
        if ($producto) {
            // Devolver los datos del producto como JSON
            header('Content-Type: application/json');
            echo json_encode($producto);
        } else {
            // Si no se encuentra el producto, devolver un mensaje de error
            http_response_code(404);
            echo json_encode(array('error' => 'Producto no encontrado'));
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor al obtener datos del producto'));
    }
    exit;
}

// Verificar si la solicitud es POST para actualizar los datos del producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $id_categoria = $_POST['id_categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $id_proveedor = $_POST['id_proveedor'];

    try {
        // Preparar la consulta SQL UPDATE para actualizar los datos del producto
        $stmt = $pdo->prepare("UPDATE productos SET nombre = :nombre, id_categoria = :id_categoria, descripcion = :descripcion, precio = :precio, id_proveedor = :id_proveedor WHERE id_producto = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->rowCount() > 0) {
            // Actualización exitosa
            $response = array(
                'code' => 200,
                'message' => 'Producto actualizado exitosamente'
            );
        } else {
            // No se actualizó ningún registro (el producto no existe o no se modificaron datos)
            $response = array(
                'code' => 404,
                'message' => 'No se encontró el producto para actualizar o no hubo cambios'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al actualizar el producto'
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
