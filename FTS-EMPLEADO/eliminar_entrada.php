<?php
// Verificar si se ha enviado un ID de entrada para eliminar
if (isset($_POST['id_entrada'])) {
    // Obtener el ID de la entrada desde la solicitud POST
    $id_entrada = $_POST['id_entrada'];

    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Consulta SQL para eliminar la entrada utilizando una consulta preparada
    $sql = "DELETE FROM entradas WHERE id_entrada = ?";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parámetros a la declaración preparada
        $stmt->bind_param('i', $id_entrada);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "Entrada eliminada correctamente.";
        } else {
            echo "Error al eliminar la entrada: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de entrada no especificado.";
}
?>
