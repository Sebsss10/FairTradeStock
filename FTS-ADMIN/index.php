<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<!-- navLateral -->
<section class="full-width navLateral">
    <div class="full-width navLateral-bg btn-menu"></div>
    <div class="full-width navLateral-body">
        <div class="full-width navLateral-body-logo text-center tittles">
            <i class="zmdi zmdi-close btn-menu"></i> <img src="img/FairTrade Stock.png">
        </div>
        <figure class="full-width navLateral-body-tittle-menu">
            <div>
                <img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
            </div>
            <figcaption>
                <span>
                    RODRIGO GUTIERREZ<br>
                    <small>Admin</small>
                </span>
            </figcaption>
        </figure>
        <nav class="full-width">
            <ul class="full-width list-unstyle menu-principal">
                <li class="full-width">
                    <a href="./?p=resumen" class="full-width">
                        <div class="navLateral-body-cl">
                        <i class="fas fa-home icon-menu"></i>
                        <!-- Icono de inicio -->
                        </div>
                        <div class="navLateral-body-cr">
                            Inicio
                        </div>
                    </a>
                </li>
                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a href="#!" class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                        <i class="fas fa-cogs icon-menu"></i>

                        </div>
                        <div class="navLateral-body-cr">
                            Gestión
                        </div>
                        <span class="fas fa-chevron-left"></span> <!-- Flecha hacia la izquierda -->
                    </a>
                    <ul class="full-width menu-principal sub-menu-options">
                        <li class="full-width">
                            <a href="./?p=usuarios" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="fas fa-users icon-menu"></i> <!-- Icono de usuarios -->
                                </div>
                                <div class="navLateral-body-cr">
                                    Usuarios
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="./?p=proveedores" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="fas fa-truck icon-menu"></i> <!-- Icono de proveedores -->
                                </div>
                                <div class="navLateral-body-cr">
                                    Proveedores
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="./?p=categorias"  class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="fas fa-tags icon-menu"></i> <!-- Icono de categorías -->
                                </div>
                                <div class="navLateral-body-cr">
                                    Categorias
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="./?p=estadisticas" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="fas fa-chart-bar icon-menu"></i> <!-- Icono de estadísticas -->
                                </div>
                                <div class="navLateral-body-cr">
                                    Estadisticas
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a href="./?p=productos" class="full-width">
                        <div class="navLateral-body-cl">
                            <i class="fas fa-boxes icon-menu"></i> <!-- Icono de productos -->
                        </div>
                        <div class="navLateral-body-cr">
                            Productos
                        </div>
                    </a>
                </li>
                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a href="./?p=salidas" class="full-width">
                        <div class="navLateral-body-cl">
                            <i class="fas fa-sign-out-alt icon-menu"></i> <!-- Icono de salidas -->
                        </div>
                        <div class="navLateral-body-cr">
                            Salidas
                        </div>
                    </a>
                </li>
                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a href="./?p=Entradas" class="full-width">
                        <div class="navLateral-body-cl">
                            <i class="fas fa-sign-in-alt icon-menu"></i> <!-- Icono de entradas -->
                        </div>
                        <div class="navLateral-body-cr">
                            Entradas
                        </div>
                    </a>
                </li>
                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a href="./?p=stock" class="full-width">
                        <div class="navLateral-body-cl">
                            <i class="fas fa-archive icon-menu"></i> <!-- Icono de stock -->
                        </div>
                        <div class="navLateral-body-cr">
                            Stock
                        </div>
                    </a>
                </li>
                <li class="full-width divider-menu-h"></li>
            </ul>
        </nav>
    </div>
</section>

<!-- pageContent -->
<section class="full-width pageContent">
<!-- navBar -->
<div class="full-width navBar">
    <div class="full-width navBar-options">
        <i class="fas fa-bars btn-menu" id="btn-menu"></i>
        <div class="mdl-tooltip" for="btn-menu">MENU</div>
        <nav class="navBar-options-list">
            <ul class="list-unstyle">
                <li class="btn-exit" id="btn-exit">
                    <i class="fas fa-power-off"></i>
                    <div class="mdl-tooltip" for="btn-exit">Cerrar Sesión</div>
                </li>
                <li class="text-condensedLight noLink"><small>RODRIGO GUTIERREZ</small></li>
                <li class="noLink">
                    <figure>
                        <img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
                    </figure>
                </li>
            </ul>
        </nav>
    </div>
</div>

    <section class="full-width text-center" style="padding: 40px 0;">

        <?php 
            $page_content = isset($_GET['p'])  ? $_GET['p'] : "resumen";

            

            include($page_content.".php");
        ?>




    </section>

</section>

<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>
