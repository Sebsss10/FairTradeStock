<?php
// Verificar si se ha enviado un nombre de usuario para eliminar
if (isset($_POST['usuario'])) {
    // Obtener el nombre del usuario desde la solicitud POST
    $usuario = $_POST['usuario'];

    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Consulta SQL para eliminar el usuario utilizando una consulta preparada
    $sql = "DELETE FROM usuarios WHERE usuario = ?";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parámetros a la declaración preparada
        $stmt->bind_param('s', $usuario);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "Usuario eliminado correctamente.";
        } else {
            echo "Error al eliminar el usuario: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "Nombre de usuario no especificado.";
}
?>
