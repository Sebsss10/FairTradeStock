<?php

include 'conexion.php';

// Consulta para obtener las entradas con datos del producto
$sql = "
    SELECT 
        e.id_salida, 
        e.fecha, 
        p.nombre AS producto, 
        e.cantidad, 
        e.destino 
    FROM 
        salidas e
    INNER JOIN 
        productos p 
    ON 
        e.id_producto = p.id_producto";

$result = $conn->query($sql);



// Generar las filas de la tabla de salidas
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id_salida"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["producto"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["cantidad"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["destino"]) . "</td>";
        echo '<td>
                <button class="editButton s-button" data-id="' . htmlspecialchars($row["id_salida"]) . '"><i class="fas fa-edit"></i> Editar</button>
                <button class="deleteButton s-button" data-id="' . htmlspecialchars($row["id_salida"]) . '"><i class="fas fa-trash"></i> Eliminar</button>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay salidas registradas</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
