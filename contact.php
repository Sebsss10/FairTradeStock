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
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css" rel="stylesheet">
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
                    <a href="service.php" class="nav-item nav-link">Servicios</a>
                    <a href="contact.php" class="nav-item nav-link active">Contacto</a>
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
                <p class="m-0">Contacto</p>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <div class="bg-primary text-dark text-center p-4">
                        <h4 class="m-0"><i class="fa fa-map-marker-alt text-white mr-2"></i>Calz. San Juan 2-30</h4>
                    </div>
                    <iframe style="width: 100%; height: 470px;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDMeyTEn8vuw7tiT9gvnvu7Wd4z8KhI6dw&q=14.646697580114662, -90.58200514963868" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary text-uppercase font-weight-bold">Contáctanos</h6>
                    <h1 class="mb-4">Genera una solicitud</h1>
                    <div class="contact-form bg-secondary" style="padding: 30px;">
                        <div id="success"></div>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 p-4" placeholder="Nombre" required="required" id="name" name="name">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 p-4" placeholder="Correo Electrónico" required="required" id="email" name="email">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control border-0 p-4" placeholder="Asunto" required="required" id="asunto" name="asunto">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control border-0 py-3 px-4" rows="3" id="msg" name="msg" placeholder="Mensaje" required></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-4" type="submit" name="enviar" id="sendMessageButton">Envia el Mensaje</button>
                            </div>
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
    <!-- Contact End -->
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
                            <a class="text-white mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>Sobre Nosotros</a>
                            <a class="text-white mb-2" href="service.php"><i class="fa fa-angle-right mr-2"></i>Nuestros Servicios</a>
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
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Form Submission Script -->

</body>

</html>