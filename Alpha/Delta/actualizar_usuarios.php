<?php
// Configuración de la conexión a la base de datos
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

// Verificar si la solicitud es GET para obtener datos del usuario por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];

    try {
        // Preparar la consulta SQL para obtener los datos del usuario por su ID
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener los datos del usuario como un arreglo asociativo
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron datos del usuario
        if ($usuarioData) {
            // Devolver los datos del usuario como JSON
            header('Content-Type: application/json');
            echo json_encode($usuarioData);
        } else {
            // Si no se encuentra el usuario, devolver un mensaje de error
            http_response_code(404);
            echo json_encode(array('error' => 'Usuario no encontrado'));
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor al obtener datos del usuario'));
    }
    exit;
}

// Verificar si la solicitud es POST para actualizar los datos del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    try {
        // Preparar la consulta SQL UPDATE para actualizar los datos del usuario
        $stmt = $pdo->prepare("UPDATE usuarios SET contrasena = :contrasena, rol = :rol WHERE usuario = :usuario");
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->rowCount() > 0) {
            // Actualización exitosa
            $response = array(
                'code' => 200,
                'message' => 'Usuario actualizado exitosamente'
            );
        } else {
            // No se actualizó ningún registro (el usuario no existe o no se modificaron datos)
            $response = array(
                'code' => 404,
                'message' => 'No se encontró el usuario para actualizar o no hubo cambios'
            );
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error interno del servidor al actualizar el usuario'
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
