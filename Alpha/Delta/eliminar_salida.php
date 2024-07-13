<?php
// Verificar si se ha enviado un ID de salida para eliminar
if (isset($_POST['id_salida'])) {
    // Obtener el ID de la salida desde la solicitud POST
    $id_salida = $_POST['id_salida'];

    // Configuración de la conexión a la base de datos
  $host =  "127.0.0.1:3306";   // Cambia esto si tu base de datos está en otro servidor
$username =  "u414995690_root";    // Cambia esto por tu nombre de usuario de la base de datos
$password = 'Compu123#';            // Cambia esto por tu contraseña de la base de datos
$dbname = "u414995690_fts";         // Nombre de la base de datos

    try {
        // Conexión a la base de datos usando PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para eliminar la salida utilizando una consulta preparada
        $stmt = $pdo->prepare("DELETE FROM salidas WHERE id_salida = :id");
        $stmt->bindParam(':id', $id_salida, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se eliminó correctamente
        if ($stmt->rowCount() > 0) {
            echo "Salida eliminada correctamente.";
        } else {
            echo "No se encontró la salida para eliminar.";
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL
        echo "Error al eliminar la salida: " . $e->getMessage();
    }
} else {
    echo "ID de salida no especificado.";
}
?>
