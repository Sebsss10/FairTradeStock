<?php
include 'conexion.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_categoria = $_POST['idCat'];
    $nombre_categoria = $_POST['nombreCat'];
    $descripcion = $_POST['descripcionCat'];

    // Preparar la consulta SQL para insertar la categoría
    $sql = "INSERT INTO categorias (id_categoria, nombre_categoria, descripcion_categoria) 
            VALUES ('$id_categoria', '$nombre_categoria', '$descripcion')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conn, $sql)) {
        // Si la inserción fue exitosa
        $response = array(
            'code' => 200,
            'message' => 'Categoría agregada exitosamente'
        );
    } else {
        // Si hubo un error en la consulta SQL
        $response = array(
            'code' => 500,
            'message' => 'Error al agregar la categoría: ' . mysqli_error($conn)
        );
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
