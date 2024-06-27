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

    // Preparar la consulta SQL para insertar la salida
    $sql = "INSERT INTO salidas (id_salida, fecha, id_producto, cantidad, destino) 
            VALUES (?, ?, ?, ?, ?)";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parámetros a la declaración preparada
        // Aquí se asume que $idsalida es un entero (i), $fecha es una cadena (s), $id_producto es un entero (i),
        // $cantidad es un entero (i), y $destino es una cadena (s)
        $stmt->bind_param('isiss', $idsalida, $fecha, $id_producto, $cantidad, $destino);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // Si la inserción fue exitosa
            $response = array(
                'code' => 200,
                'message' => 'Salida registrada exitosamente',
                'idsalida' => $idsalida  // Incluir el ID de la salida insertada
            );
        } else {
            // Si hubo un error en la consulta SQL
            $response = array(
                'code' => 500,
                'message' => 'Error al registrar la salida: ' . $stmt->error
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
