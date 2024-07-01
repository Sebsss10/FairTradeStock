<?php
include 'conexion.php';

// Consulta para obtener las entradas
$sql = "SELECT * FROM entradas";
$result = $conn->query($sql);

// Generar las filas de la tabla de entradas
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id_entrada"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["id_producto"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["cantidad"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["id_proveedor"]) . "</td>";
        echo '<td>
                <button class="editButton s-button" data-id="' . htmlspecialchars($row["id_entrada"]) . '"><i class="fas fa-edit"></i> Editar</button>
                <button class="deleteButton s-button" data-id="' . htmlspecialchars($row["id_entrada"]) . '"><i class="fas fa-trash"></i> Eliminar</button>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay entradas registradas</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
