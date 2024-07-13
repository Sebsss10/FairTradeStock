<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FairTradeStock</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="img/FairTradeStock.png" type="image/x-icon">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3">
                <img class="img-fluid" src="img/FairTradeStock.png" alt="FairTradeStock Logo">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Inicio</a>
                    <a href="about.php" class="nav-item nav-link">Sobre Nosotros</a>
                    <a href="service.php" class="nav-item nav-link active">Servicios</a>
                    <a href="contact.php" class="nav-item nav-link">Contacto</a>
                </div>
                <a href="Alpha/index.html" class="btn btn-primary py-2 px-4">Iniciar Sesión</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">FairTradeStock</h1>
            <div class="d-inline-flex align-items-center text-white">
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Servicios</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Services Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h1 class="mb-4">Nuestros Servicios</h1>
            </div>
            <div class="row pb-3">
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-clock text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Gestión de Inventario en Tiempo Real</h6>
                    </div>
                    <p>Permite a los usuarios rastrear el estado y la cantidad de productos en tiempo real, asegurando
                        una administración precisa y evitando el desabastecimiento.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-cogs text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Gestión de Inventarios Eficiente </h6>
                    </div>
                    <p>Utiliza algoritmos avanzados para maximizar el uso del espacio de almacenamiento, reduciendo
                        costos y mejorando la eficiencia operativa.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-chart-bar text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Reportes y Análisis Detallados para un Inventario</h6>
                    </div>
                    <p>Ofrece informes y análisis detallados sobre el rendimiento del inventario, permitiendo a las
                        empresas tomar decisiones informadas y estratégicas basadas en datos precisos.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-chart-area text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Visualización de Datos y Gráficas Interactivas</h6>
                    </div>
                    <p>Proporciona gráficos interactivos y dashboards personalizados para visualizar las tendencias de
                        inventario, identificar patrones de ventas y analizar el rendimiento de productos, facilitando
                        la toma de decisiones basada en datos visuales claros y comprensibles.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!--  Quote Request Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 py-5 py-lg-0">
                    <h6 class="text-primary text-uppercase font-weight-bold">¿Interesado en obtener FairTradeStock para
                        tu empresa?</h6>
                    <h1 class="mb-4">Obtén FairTradeStock</h1>
                    <p class="mb-4">Completa el formulario de solicitud y uno de nuestros especialistas se pondrá en
                        contacto contigo para brindarte más información y asesorarte en la implementación del programa.
                        ¡Empieza a transformar tu gestión de inventarios hoy mismo!</p>
                </div>
                <div class="col-lg-5">
                    <div class="bg-primary py-5 px-4 px-sm-5">
                        <form method="post">
                            <div class="form-group">

                                <input type="text" class="form-control border-0 p-4" placeholder="Nombre" required="required" id="name" name="name">
                            </div>
                            <div class="form-group">

                                <input type="email" class="form-control border-0 p-4" placeholder="Correo Electrónico" required="required" id="email" name="email" required>
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control border-0 p-4" placeholder="Asunto" required="required" data-validation-required-message="Ingrese un asunto" id="asunto" name="asunto" required>
                            </div>
                            <div class="form-group">

                                <textarea class="form-control border-0 py-3 px-4" rows="3" id="msg" name="msg" placeholder="Mensaje" required></textarea>
                            </div> <button type="submit" name="enviar" class="btn btn-dark btn-block border-0 py-3">Enviar</button>
                        </form>
                        <br>
                        <h5 class="font-weight-bold mb-3">
                            <?php
                            include("correo.php");
                            ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote Request Start -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Contáctanos</h3>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Calz. San Juan 2-30, Cdad. de Guatemala</p>
                        <p><i class="fa fa-envelope mr-2"></i>fairtradestockfts@gmail.com</p>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                            <a class="text-white mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>Sobre
                                Nosotros</a>
                            <a class="text-white mb-2" href="service.php"><i class="fa fa-angle-right mr-2"></i>Nuestros
                                Servicios</a>
                            <a class="text-white" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contáctanos</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mb-5">
                <img class="img-fluid" src="img/FTS.png" alt="">
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
        <div class="row">
            <div class="col-12 text-center mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">FairTradeStock</a> Derechos Reservados.</p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>