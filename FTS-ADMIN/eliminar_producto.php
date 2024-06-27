<?php
// Conexión a la base de datos (ejemplo)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fts";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener ID del producto a eliminar
$id_producto = $_POST['id_producto'];

// Eliminar producto
$sql = "DELETE FROM productos WHERE id_producto = '$id_producto'";

if ($conn->query($sql) === TRUE) {
    $response = "Producto eliminado correctamente";
} else {
    $response = "Error al eliminar el producto: " . $conn->error;
}

$conn->close();

// Enviar respuesta como texto plano
echo $response;
?>
