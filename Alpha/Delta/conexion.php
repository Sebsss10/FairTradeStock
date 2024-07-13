<?php
 $servername = "127.0.0.1:3306";
    $username = "u414995690_root";
    $password = "Compu123#";
    $dbname = "u414995690_fts";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>