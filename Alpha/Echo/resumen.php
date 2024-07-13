<?php
// Incluir el archivo con las funciones y la conexión a la base de datos
require 'conteos.php';

// Obtener la conexión a la base de datos
$conn = obtenerConexion();

// Obtener los totales de cada tabla
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
        <a href="./?p=proveedores" class="tile-link">
            <div class="tile-text">
                <span class="text-condensedLight">
                    <?php echo $totalProveedores; ?><br>
                    <small>Proveedores</small>
                </span>
            </div>
            <i class="fas fa-truck tile-icon"></i> <!-- Icono para Proveedores -->
        </a>
    </article>

    <article class="full-width tile">
        <a href="./?p=categorias" class="tile-link">
            <div class="tile-text">
                <span class="text-condensedLight">
                    <?php echo $totalCategorias; ?><br>
                    <small>Categorías</small>
                </span>
            </div>
            <i class="fas fa-tags tile-icon"></i> <!-- Icono para Categorías -->
        </a>
    </article>

    <article class="full-width tile">
        <a href="./?p=productos" class="tile-link">
            <div class="tile-text">
                <span class="text-condensedLight">
                    <?php echo $totalProductos; ?><br>
                    <small>Productos</small>
                </span>
            </div>
            <i class="fas fa-boxes tile-icon"></i> <!-- Icono para Productos -->
        </a>
    </article>

    <article class="full-width tile">
        <a href="./?p=Entradas" class="tile-link">
            <div class="tile-text">
                <span class="text-condensedLight">
                    <?php echo $totalEntradas; ?><br>
                    <small>Entradas</small>
                </span>
            </div>
            <i class="fas fa-sign-in-alt tile-icon"></i> <!-- Icono para Entradas -->
        </a>
    </article>

    <article class="full-width tile">
        <a href="./?p=salidas" class="tile-link">
            <div class="tile-text">
                <span class="text-condensedLight">
                    <?php echo $totalSalidas; ?><br>
                    <small>Salidas</small>
                </span>
            </div>
            <i class="fas fa-sign-out-alt tile-icon"></i> <!-- Icono para Salidas -->
        </a>
    </article>

</body>
</html>
