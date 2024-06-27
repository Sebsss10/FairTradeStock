<?php
include 'conexion.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_entrada = $_POST['identrada']; // Este campo se debe gestionar manualmente si no es autoincrementable
    $fecha = $_POST['fecha'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $id_proveedor = $_POST['id_proveedor'];

    // Preparar la consulta SQL para insertar la entrada
    $sql = "INSERT INTO entradas (id_entrada, fecha, id_producto, cantidad, id_proveedor) 
            VALUES (?, ?, ?, ?, ?)";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parámetros a la declaración preparada
        // Aquí se asume que $id_entrada es un entero (i), $fecha es una cadena (s), $id_producto es un entero (i),
        // $cantidad es un entero (i), y $id_proveedor es un entero (i)
        $stmt->bind_param('isiii', $id_entrada, $fecha, $id_producto, $cantidad, $id_proveedor);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // Si la inserción fue exitosa
            $response = array(
                'code' => 200,
                'message' => 'Entrada registrada exitosamente',
                'identrada' => $id_entrada
            );
        } else {
            // Si hubo un error en la consulta SQL
            $response = array(
                'code' => 500,
                'message' => 'Error al registrar la entrada: ' . $stmt->error
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
