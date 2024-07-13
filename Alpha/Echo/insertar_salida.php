<?php
include 'conexion.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idsalida = $_POST['idsalida'];  // Esto debería estar oculto en el formulario y generado automáticamente
    $fecha = $_POST['fecha'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $destino = $_POST['destino'];

    // Consultar la cantidad disponible en inventario para el producto seleccionado
    $sql_inventario = "SELECT cantidad_disponible FROM inventario WHERE id_producto = ?";
    $stmt_inventario = $conn->prepare($sql_inventario);
    $stmt_inventario->bind_param('i', $id_producto);
    $stmt_inventario->execute();
    $stmt_inventario->bind_result($cantidad_disponible);
    $stmt_inventario->fetch();
    $stmt_inventario->close();

    // Verificar si hay suficientes productos en el inventario
    if ($cantidad <= $cantidad_disponible) {
        // Preparar la consulta SQL para insertar la salida
        $sql_insertar = "INSERT INTO salidas (id_salida, fecha, id_producto, cantidad, destino) 
                         VALUES (?, ?, ?, ?, ?)";
        $stmt_insertar = $conn->prepare($sql_insertar);
        
        if ($stmt_insertar) {
            // Vincular parámetros a la declaración preparada
            $stmt_insertar->bind_param('isiss', $idsalida, $fecha, $id_producto, $cantidad, $destino);

            // Ejecutar la declaración
            if ($stmt_insertar->execute()) {
                // Si la inserción fue exitosa
                $response = array(
                    'code' => 200,
                    'message' => 'Salida registrada exitosamente',
                    'idsalida' => $idsalida  // Incluir el ID de la salida insertada
                );
            } else {
                // Si hubo un error en la consulta SQL para insertar
                $response = array(
                    'code' => 500,
                    'message' => 'Error al registrar la salida: ' . $stmt_insertar->error
                );
            }

            // Cerrar la declaración preparada
            $stmt_insertar->close();
        } else {
            // Si hubo un error al preparar la consulta para insertar
            $response = array(
                'code' => 500,
                'message' => 'Error al preparar la consulta para insertar: ' . $conn->error
            );
        }
    } else {
        // Si no hay suficientes productos en el inventario
        $response = array(
            'code' => 400,
            'message' => 'No hay suficientes productos en el inventario para realizar esta salida'
        );
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si la solicitud no es de tipo POST
    $response = array(
        'code' => 400,
        'message' => 'Solicitud no válida'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
