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

// Verificar si la solicitud es GET para obtener datos de la categoría por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];

    try {
        // Preparar la consulta SQL para obtener los datos de la categoría por su ID
        $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id_categoria = :id");
        $stmt->bindParam(':id', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los datos de la categoría como un arreglo asociativo
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron datos de la categoría
        if ($categoria) {
            // Devolver los datos de la categoría como JSON
            header('Content-Type: application/json');
            echo json_encode($categoria);
        } else {
            // Si no se encuentra la categoría, devolver un mensaje de error
            http_response_code(404);
            echo json_encode(array('error' => 'Categoría no encontrada'));
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor al obtener datos de la categoría'));
    }
    exit;
}

// Verificar si la solicitud es POST para insertar una nueva categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_categoria = $_POST['idCat'];
    $nombre_categoria = $_POST['nombreCat'];
    $descripcion_categoria = $_POST['descripcionCat'];

    try {
        // Preparar la consulta SQL para insertar la categoría
        $stmt = $pdo->prepare("INSERT INTO categorias (id_categoria, nombre_categoria, descripcion_categoria) 
                               VALUES (:id, :nombre, :descripcion)");
        $stmt->bindParam(':id', $id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre_categoria);
        $stmt->bindParam(':descripcion', $descripcion_categoria);
        $stmt->execute();

        // Verificar si se realizó la inserción correctamente
        if ($stmt->rowCount() > 0) {
            // Inserción exitosa
            $response = array(
                'code' => 200,
                'message' => 'Categoría agregada exitosamente'
            );
        } else {
            // Error al insertar la categoría
            $response = array(
                'code' => 500,
                'message' => 'Error al agregar la categoría'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al agregar la categoría'
        );
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Verificar si la solicitud es POST para actualizar los datos de una categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id_categoria'])) {
    // Obtener los datos del formulario
    $id_categoria = $_GET['id_categoria'];
    $nombre_categoria = $_POST['nombreCat'];
    $descripcion_categoria = $_POST['descripcionCat'];

    try {
        // Preparar la consulta SQL para actualizar los datos de la categoría
        $stmt = $pdo->prepare("UPDATE categorias SET nombre_categoria = :nombre, descripcion_categoria = :descripcion 
                               WHERE id_categoria = :id");
        $stmt->bindParam(':nombre', $nombre_categoria);
        $stmt->bindParam(':descripcion', $descripcion_categoria);
        $stmt->bindParam(':id', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->rowCount() > 0) {
            // Actualización exitosa
            $response = array(
                'code' => 200,
                'message' => 'Categoría actualizada exitosamente'
            );
        } else {
            // No se actualizó ningún registro (la categoría no existe o no se modificaron datos)
            $response = array(
                'code' => 404,
                'message' => 'No se encontró la categoría para actualizar o no hubo cambios'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al actualizar la categoría'
        );
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Verificar si la solicitud es POST para eliminar una categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id_categoria']) && isset($_POST['delete'])) {
    // Obtener el ID de la categoría a eliminar
    $id_categoria = $_GET['id_categoria'];

    try {
        // Preparar la consulta SQL para eliminar la categoría
        $stmt = $pdo->prepare("DELETE FROM categorias WHERE id_categoria = :id");
        $stmt->bindParam(':id', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se eliminó la categoría correctamente
        if ($stmt->rowCount() > 0) {
            // Eliminación exitosa
            $response = array(
                'code' => 200,
                'message' => 'Categoría eliminada exitosamente'
            );
        } else {
            // No se eliminó ningún registro (la categoría no existe)
            $response = array(
                'code' => 404,
                'message' => 'No se encontró la categoría para eliminar'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al eliminar la categoría'
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
