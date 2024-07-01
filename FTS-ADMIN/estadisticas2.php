<?php
//////////////////CONEXION A LA BASE DE DATOS ///////////////
require 'conexion.php';


///////////////CONSULTAS DE LA BD //////////////////////
$resTotal1=$conn->query("SELECT * FROM entradas");
//cnt Guarda Cantidad total de registros
$cnt1=$resTotal1->num_rows;

$resTotal2=$conn->query("SELECT * FROM salidas");
//cnt Guarda Cantidad total de registros
$cnt2=$resTotal2->num_rows;

//se recuperan los datos guardados y son representados en una cadena por medio de un while





while($res=mysqli_fetch_array($resTotal1)){
	//variable que guarda el resultado encontrado y es parseado a la estructura requerida
	//por HightCharts
	$A1="{name:'Entradas', y:".$cnt1."},";

}

while($res=mysqli_fetch_array($resTotal2)){
	//variable que guarda el resultado encontrado y es parseado a la estructura requerida
	//por HightCharts
	$B2="{name:'Salidas', y:".$cnt2."},";

}


?>
<!DOCTYPE html>
<html>
<head>
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


	
	<!--Se importan las librerias necesarias-->
	<script src="Highcharts-6.0.4/code/highcharts.js"></script>
	<script src="Highcharts-6.0.4/code/modules/exporting.js"></script>		

	<!--Se carga la grafica (debe de estar antes de la ESTRUCTURA de la GRAFICA-->
	<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>


	
	<!--Script de graficas ESTRUCTURA dinamicas-->

	<script type="text/javascript">

	//Highcharts toma como referencia el div con el id 'container' para graficar 
	Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Entradas y Salidas'
    },
     subtitle: {

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
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [
    {
    	name:'Resultados',
    	colorByPoint: true,
    	data:[<?php echo $A1; echo $B2;?>]
    	/*
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'IE',
            y: 56.33
        }, {
            name: 'Chrome',
            y: 24.03,
            sliced: true,
            selected: true
        }, {
            name: 'Firefox',
            y: 10.38
        }, {
            name: 'Safari',
            y: 4.77
        }, {
            name: 'Opera',
            y: 0.91
        }, {
            name: 'Other',
            y: 0.2
            //echo $A1; echo $B2; echo $C3; 
        */
 	}]
	});		
 		
		</script>

</body>


</html>
