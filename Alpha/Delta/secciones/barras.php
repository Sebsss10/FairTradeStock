<?php 
require '../conexion.php';


///////////////CONSULTAS DE LA BD //////////////////////


//Muestra todas las carreras disponibles
$resTics=$conexion->query("SELECT carrera from alumnos where carrera='tics'");
$resMedicina=$conexion->query("SELECT carrera from alumnos where carrera='medicina'");
$resInfo=$conexion->query("SELECT carrera from alumnos where carrera='informatica'");
//total de grupos por carrera

//totales por carrera
$totalTics=$conexion->query("SELECT count(grupo) as total from alumnos where carrera='tics'");
$totalMedicina=$conexion->query("SELECT count(grupo) as total from alumnos where carrera='medicina'");
$totalInfo=$conexion->query("SELECT count(grupo) as total from alumnos where carrera='informatica'");





//se recuperan los datos guardados y son representados en una cadena por medio de un while

while($res=mysqli_fetch_array($resTics)){
	$cat_tics="name:'".$res['carrera']."'";
}

while($res=mysqli_fetch_array($resMedicina)){
	$cat_med="name:'".$res['carrera']."'";
}

while($res=mysqli_fetch_array($resInfo)){
	$cat_info="name:'".$res['carrera']."'";
}

//Se recuperan los totales por grupo

while($res=mysqli_fetch_array($totalTics)){
	$total_tic=$res['total'];
}

while($res=mysqli_fetch_array($totalMedicina)){
	$total_med=$res['total'];
}

while($res=mysqli_fetch_array($totalInfo)){
	$total_inf=$res['total'];
}




?>




?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Grafica de barras</title>
	<!--Definicion de meta-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Graficas Dinamicas</title>
	<!--Importo librerias-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script type="text/javascript"></script>
</head>
<body>
	
	<!--Se importan las librerias necesarias para las gracias-->
	<script src="../Highcharts-6.0.4/code/highcharts.js"></script>
	<script src="../Highcharts-6.0.4/code/modules/exporting.js"></script>

	<!--Se carga la grafica (debe de estar antes de la ESTRUCTURA de la GRAFICA-->
	<div id="container" style="min-width: 410px; height: 500px; max-width: 700px; margin: 0 auto"></div>

    <!--Boton Volver a Home-->
    <div class="container">
        <a class="btn btn-info" href="../index.php">Volver al inicio</a>   
    </div>
	
	<!--Script de graficas ESTRUCTURA dinamicas-->

	<script type="text/javascript">

	Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Grafica de barras con tabla alumnos'
    },
    subtitle: {
        text: 'Source: <a href="https://github.com/Simon1207">Github: Simon1207</a>'
    },
    xAxis: {
        categories: ['xxxx', 'xxxx', 'xxxx', 'xxxx', 'xxxx'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' Grupos'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        <?php echo $cat_tics?>,
        data: [<?php echo $total_tic?>]
    }, {
        <?php echo $cat_med?>,
        data: [<?php echo $total_med?>]
    }, {
        <?php echo $cat_info?>,
        data: [<?php echo $total_inf ?>]
    }]
});
 		
		</script>

</body>
</html>