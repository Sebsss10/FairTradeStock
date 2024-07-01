<?php
// Verificar si se ha enviado un ID de proveedor para eliminar
if (isset($_POST['id_proveedor'])) {
    // Obtener el ID del proveedor desde la solicitud POST
    $id_proveedor = $_POST['id_proveedor'];

    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Consulta SQL para eliminar el proveedor utilizando una consulta preparada
    $sql = "DELETE FROM proveedores WHERE id_proveedor = ?";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parámetros a la declaración preparada
        $stmt->bind_param('i', $id_proveedor);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "Proveedor eliminado correctamente.";
        } else {
            echo "Error al eliminar el proveedor: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de proveedor no especificado.";
}
?>
