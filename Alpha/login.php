<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuariolg'];
    $password = $_POST['passwordlg'];

    // Preparar la consulta SQL para verificar las credenciales y obtener el rol
    $sql = "SELECT rol FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ss', $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Establecer la sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $usuario;

            // Obtener el rol del usuario
            $row = $result->fetch_assoc();
            $rol = $row['rol'];

            // Devolver el rol como respuesta
            echo $rol;
        } else {
            echo 'Error'; // Devolver un error si las credenciales son incorrectas
        }
    } else {
        echo 'Error'; // Devolver un error si hay un problema con la consulta SQL
    }

    $stmt->close();
    $conn->close();
}
?>
