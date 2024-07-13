<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se recibieron datos del formulario mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_producto = $_POST['idProd'];
    $nombre = $_POST['nombreProd'];
    $id_categoria = $_POST['idCategoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $id_proveedor = $_POST['idProveedor'];

    // Preparar la consulta SQL para insertar el producto
    $sql = "INSERT INTO productos (id_producto, nombre, id_categoria, descripcion, precio, id_proveedor)
            VALUES ('$id_producto', '$nombre', '$id_categoria', '$descripcion', '$precio', '$id_proveedor')";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa
        $response = array(
            "code" => 200,
            "message" => "Producto agregado correctamente"
        );
    } else {
        // Si hubo un error en la consulta SQL
        $response = array(
            "code" => 500,
            "message" => "Error al agregar el producto: " . $conn->error
        );
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Devolver la respuesta como JSON al cliente
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

