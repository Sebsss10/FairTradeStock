<?php
// Incluir el archivo con las funciones y la conexión a la base de datos
require 'conteos.php';

// Obtener la conexión a la base de datos
$conn = obtenerConexion();

// Obtener los totales de cada tabla
$totalUsuarios = obtenerTotalUsuarios($conn);
$totalProveedores = obtenerTotalProveedores($conn);
$totalCategorias = obtenerTotalCategorias($conn);
$totalProductos = obtenerTotalProductos($conn);
$totalSalidas = obtenerTotalSalidas($conn);
$totalEntradas = obtenerTotalEntradas($conn);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Título de tu página</title>
    <!-- Agrega tus estilos CSS y otros metadatos aquí -->
    <link rel="stylesheet" href="tu-estilo.css">
</head>
<body>
    <h3 class="text-center tittles">Bienvenido</h3>

    <!-- Tiles -->
    <article class="full-width tile">
        <div class="tile-text">
            <span class="text-condensedLight">
                <?php echo $totalUsuarios; ?><br>
                <small>Usuarios</small>
            </span>
        </div>
        <i class="fas fa-user-cog tile-icon"></i> <!-- Icono para Administradores -->
    </article>

    <article class="full-width tile">
        <div class="tile-text">
            <span class="text-condensedLight">
                <?php echo $totalProveedores; ?><br>
                <small>Proveedores</small>
            </span>
        </div>
        <i class="fas fa-truck tile-icon"></i> <!-- Icono para Proveedores -->
    </article>

    <article class="full-width tile">
        <div class="tile-text">
            <span class="text-condensedLight">
                <?php echo $totalCategorias; ?><br>
                <small>Categorías</small>
            </span>
        </div>
        <i class="fas fa-tags tile-icon"></i> <!-- Icono para Categorías -->
    </article>

    <article class="full-width tile">
        <div class="tile-text">
            <span class="text-condensedLight">
                <?php echo $totalProductos; ?><br>
                <small>Productos</small>
            </span>
        </div>
        <i class="fas fa-boxes tile-icon"></i> <!-- Icono para Productos -->
    </article>

    <article class="full-width tile">
        <div class="tile-text">
            <span class="text-condensedLight">
                <?php echo $totalEntradas; ?><br>
                <small>Entradas</small>
            </span>
        </div>
        <i class="fas fa-sign-in-alt tile-icon"></i> <!-- Icono para Entradas -->
    </article>

    <article class="full-width tile">
        <div class="tile-text">
            <span class="text-condensedLight">
                <?php echo $totalSalidas; ?><br>
                <small>Salidas</small>
            </span>
        </div>
        <i class="fas fa-sign-out-alt tile-icon"></i> <!-- Icono para Salidas -->
    </article>

    <!-- Scripts al final del documento si es necesario -->
    <script src="tu-script.js"></script>
</body>
</html>
