<?php
include 'conexion.php';

// Consulta para obtener las categorías
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);

// Generar las filas de la tabla de categorías
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id_categoria"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nombre_categoria"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["descripcion_categoria"]) . "</td>";
        echo '<td>
                <button class="editButton s-button" data-id="' . htmlspecialchars($row["id_categoria"]) . '"><i class="fas fa-edit"></i> Editar</button>
                <button class="deleteButton s-button" data-id="' . htmlspecialchars($row["id_categoria"]) . '"><i class="fas fa-trash"></i> Eliminar</button>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay categorías registradas</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
