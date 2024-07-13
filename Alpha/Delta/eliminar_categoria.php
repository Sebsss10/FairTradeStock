<?php
// Verificar si se ha enviado un ID de categoría para eliminar
if (isset($_POST['id_categoria'])) {
    // Obtener el ID de la categoría desde la solicitud POST
    $id_categoria = $_POST['id_categoria'];

    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para eliminar la categoría utilizando una consulta preparada
    $sql = "DELETE FROM categorias WHERE id_categoria = ?";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular parámetros a la declaración preparada
    $stmt->bind_param('i', $id_categoria);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Categoría eliminada correctamente.";
    } else {
        echo "Error al eliminar la categoría: " . $stmt->error;
    }

    // Cerrar la declaración preparada
    $stmt->close();

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de categoría no especificado.";
}
?>
