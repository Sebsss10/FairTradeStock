<?php

include 'conexion.php';

// Consulta para obtener las entradas con datos del producto
$sql = "
    SELECT 
        p.id_producto, 
        p.nombre, 
        c.nombre_categoria AS categoria, 
        p.descripcion, 
        p.precio,
        pr.nombre AS proveedor
    FROM 
        productos p
    INNER JOIN 
        categorias c 
    ON 
        p.id_categoria = c.id_categoria
    INNER JOIN 
        proveedores pr
    ON 
        p.id_proveedor = pr.id_proveedor";

$result = $conn->query($sql);

// Generar las filas de la tabla de productos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id_producto"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["categoria"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["descripcion"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["precio"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["proveedor"]) . "</td>";
        echo '<td>
                <button class="editButton s-button" data-id="' . htmlspecialchars($row["id_producto"]) . '"><i class="fas fa-edit"></i> Editar</button>
                <button class="deleteButton s-button" data-id="' . htmlspecialchars($row["id_producto"]) . '"><i class="fas fa-trash"></i> Eliminar</button>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No hay productos registrados</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
