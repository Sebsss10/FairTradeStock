<?php
include 'conexion.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    // Preparar la consulta SQL para insertar el usuario
    $sql = "INSERT INTO usuarios (usuario, contrasena, rol) 
            VALUES (?, ?, ?)";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parámetros a la declaración preparada
        $stmt->bind_param('sss', $usuario, $contrasena, $rol);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // Si la inserción fue exitosa
            $response = array(
                'code' => 200,
                'message' => 'Usuario agregado exitosamente'
            );
        } else {
            // Si hubo un error en la consulta SQL
            $response = array(
                'code' => 500,
                'message' => 'Error al agregar el usuario: ' . $stmt->error
            );
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        $response = array(
            'code' => 500,
            'message' => 'Error al preparar la consulta: ' . $conn->error
        );
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
