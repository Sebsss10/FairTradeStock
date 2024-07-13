<?php
include 'conexion.php';

// Consulta para obtener los usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Generar las filas de la tabla
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["usuario"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["contrasena"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["rol"]) . "</td>";
        echo '<td>
                <button class="editButton s-button" data-usuario="' . htmlspecialchars($row["usuario"]) . '"><i class="fas fa-edit"></i> Editar</button>
                <button class="deleteButton s-button" data-usuario="' . htmlspecialchars($row["usuario"]) . '"><i class="fas fa-trash"></i> Eliminar</button>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay usuarios registrados</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
