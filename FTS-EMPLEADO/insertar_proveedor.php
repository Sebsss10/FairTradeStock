<?php
include 'conexion.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_proveedor = $_POST['idPr'];
    $nombre_proveedor = $_POST['nombrePr'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Preparar la consulta SQL para insertar el proveedor
    $sql = "INSERT INTO proveedores (id_proveedor, nombre, direccion, telefono, email) 
            VALUES ('$id_proveedor', '$nombre_proveedor', '$direccion', '$telefono', '$email')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conn, $sql)) {
        // Si la inserción fue exitosa
        $response = array(
            'code' => 200,
            'message' => 'Proveedor agregado exitosamente'
        );
    } else {
        // Si hubo un error en la consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error al agregar el proveedor: ' . mysqli_error($conn)
        );
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
