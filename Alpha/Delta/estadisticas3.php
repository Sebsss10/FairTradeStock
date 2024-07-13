<?php
//////////////////CONEXION A LA BASE DE DATOS ///////////////
require 'conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ejecutar la consulta
$resTotal = $conn->query("SELECT nombre_producto, cantidad_disponible FROM inventario");

// Inicializar un array para almacenar los datos
$productos = array();

// Verificar si la consulta fue exitosa
if ($resTotal) {
    // Recorrer y almacenar cada fila del resultado en el array
    while ($row = $resTotal->fetch_assoc()) {
        $productos[] = array('name' => $row['nombre_producto'], 'y' => (int)$row['cantidad_disponible']);
    }
} else {
    echo "Error en la consulta: " . $conn->error;
}

// Convertir el array en JSON
$productos_json = json_encode($productos);

// Cerrar la conexión
$conn->close();

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

    <div id="container3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('container3', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Inventario de Productos'
            },
            subtitle: {
            text: 'Conteo de cada producto'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y}',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Cantidad Disponible',
                colorByPoint: true,
                data: <?php echo $productos_json; ?>
            }]
        });
    });
</script>

</body>
</html>
