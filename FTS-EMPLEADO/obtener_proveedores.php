<?php
include 'conexion.php';

// Consulta para obtener los proveedores
$sql = "SELECT * FROM proveedores";
$result = $conn->query($sql);

// Generar las filas de la tabla
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id_proveedor"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["direccion"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo '<td>
                <button class="editButton s-button" data-id="' . htmlspecialchars($row["id_proveedor"]) . '"><i class="fas fa-edit"></i> Editar</button>
                <button class="deleteButton s-button" data-id="' . htmlspecialchars($row["id_proveedor"]) . '"><i class="fas fa-trash"></i> Eliminar</button>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay proveedores registrados</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
