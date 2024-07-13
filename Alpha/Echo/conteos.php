<?php
// Función para obtener la conexión a la base de datos
function obtenerConexion() {
    $servername = "127.0.0.1:3306";
    $username = "u414995690_root";
    $password = "Compu123#";
    $dbname = "u414995690_fts";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    return $conn;
}

// Función para obtener el total de usuarios
function obtenerTotalUsuarios($conn) {
    // Consulta para obtener el total de usuarios
    $sql = "SELECT COUNT(*) AS totalUsuarios FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el resultado como un array asociativo
        $row = $result->fetch_assoc();
        $totalUsuarios = $row['totalUsuarios'];
    } else {
        $totalUsuarios = 0;
    }

    return $totalUsuarios;
}

// Función para obtener el total de proveedores
function obtenerTotalProveedores($conn) {
    // Consulta para obtener el total de proveedores
    $sql = "SELECT COUNT(*) AS totalProveedores FROM proveedores";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el resultado como un array asociativo
        $row = $result->fetch_assoc();
        $totalProveedores = $row['totalProveedores'];
    } else {
        $totalProveedores = 0;
    }

    return $totalProveedores;
}

// Función para obtener el total de categorías
function obtenerTotalCategorias($conn) {
    // Consulta para obtener el total de categorías
    $sql = "SELECT COUNT(*) AS totalCategorias FROM categorias";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el resultado como un array asociativo
        $row = $result->fetch_assoc();
        $totalCategorias = $row['totalCategorias'];
    } else {
        $totalCategorias = 0;
    }

    return $totalCategorias;
}

// Función para obtener el total de productos
function obtenerTotalProductos($conn) {
    // Consulta para obtener el total de productos
    $sql = "SELECT COUNT(*) AS totalProductos FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el resultado como un array asociativo
        $row = $result->fetch_assoc();
        $totalProductos = $row['totalProductos'];
    } else {
        $totalProductos = 0;
    }

    return $totalProductos;
}

// Función para obtener el total de salidas
function obtenerTotalSalidas($conn) {
    // Consulta para obtener el total de salidas
    $sql = "SELECT COUNT(*) AS totalSalidas FROM salidas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el resultado como un array asociativo
        $row = $result->fetch_assoc();
        $totalSalidas = $row['totalSalidas'];
    } else {
        $totalSalidas = 0;
    }

    return $totalSalidas;
}

// Función para obtener el total de entradas
function obtenerTotalEntradas($conn) {
    // Consulta para obtener el total de entradas
    $sql = "SELECT COUNT(*) AS totalEntradas FROM entradas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el resultado como un array asociativo
        $row = $result->fetch_assoc();
        $totalEntradas = $row['totalEntradas'];
    } else {
        $totalEntradas = 0;
    }

    return $totalEntradas;
}



?>
