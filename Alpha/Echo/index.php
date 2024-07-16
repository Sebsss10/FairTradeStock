<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header('Location: ../../Alpha/index.php');
    exit;
}

// Verificar si el usuario tiene el rol de 'Administrador'
if ($_SESSION['rol'] !== 'Empleado') {
    // Redirigir a la página de acceso denegado si no tiene el rol adecuado
    header("Location: ../../Alpha/index.php");
    exit();
}

// Obtener el nombre de usuario desde la sesión
$usuario = $_SESSION['usuario'];
$rol= $_SESSION['rol'];

// Incluir archivo de verificación de sesión
include('../Alpha/session_check.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FairTradeStock</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/pdfexcel.css">
	 <link rel="shortcut icon" href="img/FairTradeStock.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tableexport/dist/css/tableexport.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
	</script>
	<script src="js/material.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="js/main.js"></script>
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
                      <?php echo htmlspecialchars($usuario); ?><br>
                        <small><?php echo htmlspecialchars($rol); ?></small>
                    </span>
                </figcaption>
            </figure>
            <nav class="full-width">
                <ul class="full-width list-unstyle menu-principal">
                    <li class="full-width">
                        <a href="./?p=resumen" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="fas fa-home icon-menu"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                Inicio
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="./?p=proveedores" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="fas fa-truck icon-menu"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                Proveedores
                            </div>
                        </a>
                    </li>
                    <li class="full-width">
                        <a href="./?p=categorias" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="fas fa-tags icon-menu"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                Categorias
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="./?p=productos" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="fas fa-boxes icon-menu"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                Productos
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="./?p=Entradas" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="fas fa-sign-in-alt icon-menu"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                Entradas
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="./?p=salidas" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="fas fa-sign-out-alt icon-menu"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                Salidas
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="./?p=stock" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="fas fa-archive icon-menu"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                Inventario
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
                <div class="mdl-tooltip" for="btn-menu">Menú</div>
                <nav class="navBar-options-list">
                    <ul class="list-unstyle">
                        <li class="btn-exit" id="btn-exit">
                            <i class="fas fa-power-off"></i>
                            <div class="mdl-tooltip" for="btn-exit">Cerrar Sesión</div>
                        </li>
                        <li class="text-condensedLight noLink"><small><?php echo htmlspecialchars($usuario); ?></small></li>
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



			include($page_content . ".php");
			?>
		</section>
	</section>
</body>

</html>