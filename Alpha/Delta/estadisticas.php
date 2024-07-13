<?php
//////////////////CONEXION A LA BASE DE DATOS ///////////////
require 'conexion.php';


///////////////CONSULTAS DE LA BD //////////////////////
$resTotal = $conn->query("SELECT nombre FROM productos");

// Inicializar un array para almacenar los datos
$productos = array();

// Verificar si la consulta fue exitosa
if ($resTotal) {
    // Recorrer y almacenar cada fila del resultado en el array
    while ($row = $resTotal->fetch_assoc()) {
        // Añadir el nombre del producto al array
        $productos[] = array('name' => $row['nombre'], 'y' => 1); // 'y' es un ejemplo de valor, puedes ajustar según tus necesidades
    }

} else {
    echo "Error en la consulta: " . $conn->error;
}

// Convertir el array en JSON
$productos_json = json_encode($productos);

?>

<!DOCTYPE html>
<html>
<head>
	<!--Definicion de meta-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Graficas Dinamicas</title>
	<link rel="stylesheet" href="css/styles.css">
	<!--Importo librerias-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script type="text/javascript"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>

	
</head>
<body>
<h1 align="center">Estadísticas</h1>

<hr class="my-4">
    <!--Se importan las librerias necesarias-->
    <script src="Highcharts-6.0.4/code/highcharts.js"></script>
    <script src="Highcharts-6.0.4/code/modules/exporting.js"></script>       

    <!--Se carga la grafica (debe de estar antes de la ESTRUCTURA de la GRAFICA-->
    <div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  <!--Script de graficas ESTRUCTURA dinamicas-->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            Highcharts.chart('container1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Productos'
                },
                subtitle: {
                    text: 'Los productos agregados'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Resultados',
                    colorByPoint: true,
                    data: <?php echo $productos_json; ?>
                }]
            });
        });
    </script>
    
    <hr class="my-4">

    <?php include("estadisticas2.php"); ?>

    <hr class="my-4">

    <?php include("estadisticas3.php"); ?>

  

</body>
</html>