<?php
// Conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'fts';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los datos del inventario
    $stmt = $pdo->query("SELECT i.id_inventario, i.id_producto, i.nombre_producto, i.cantidad_disponible, i.fecha_actualizacion
                         FROM inventario i
                         JOIN productos p ON i.id_producto = p.id_producto");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id_inventario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_producto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre_producto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cantidad_disponible']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha_actualizacion']) . "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
