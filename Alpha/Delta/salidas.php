<?php
    // Aquí iría el código PHP para obtener los productos desde la base de datos
    require 'conexion.php';
    $resTotal = $conn->query("SELECT id_producto, nombre FROM productos");
    $productos = array();
    if ($resTotal) {
        while ($row = $resTotal->fetch_assoc()) {
            $productos[] = array('name' => $row['nombre'], 'id' => $row['id_producto']);
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
    ?>

    <div class="container" style="margin: auto;">
        <div class="table_header">
            <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
            <h2>Salidas</h2>
            <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nueva salida</button>
            <button id="btnExportar"><i class="fas fa-file-excel"></i> Excel </button>
        <button id="btnExportarPDF"><i class="fas fa-file-pdf"></i> PDF</button>
                   
        <div class="input_search">
    <div class="search_container">
        <input type="search" id="searchInput" placeholder="Buscar" >
        <i class="fas fa-search" id="searchIcon"></i>
    </div>
</div>

        <form id="salidaForm" style="display: none;">
    <div>
        <label for="idSalida">ID Salida:</label>
        <input type="text" id="idSalida" name="idsalida" required disabled>

    </div>
    <div>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD" required>
    </div>
    <div>
        <label for="producto">Producto:</label>
        <select id="idProducto" name="id_producto" class="form-control" required>
            <?php
            foreach ($productos as $producto) {
                echo '<option value="' . $producto['id'] . '">' . $producto['name'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required>
    </div>
    <div>
        <label for="destino">Destino:</label>
        <input type="text" id="destino" name="destino">
    </div>
    <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Salida</button>
    <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
    <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
</form> 

        <div class="table_container">
            <table id="salidaTable">
                <thead>
                    <tr>
                        <th>ID Salida <i class="bi bi-chevron-expand"></i></th>
                        <th>Fecha <i class="bi bi-chevron-expand"></i></th>
                        <th>Producto <i class="bi bi-chevron-expand"></i></th>
                        <th>Cantidad <i class="bi bi-chevron-expand"></i></th>
                        <th>Destino <i class="bi bi-chevron-expand"></i></th>
                        <th class="acciones">Acciones<i class="bi bi-chevron-expand"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'obtener_salidas.php'; ?>
                </tbody>
            </table>
        </div>
        <div class="table_footer"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
    // Mostrar u ocultar formulario al hacer clic en el botón "Crear nueva salida"
    $('#showFormBtn').on('click', function() {
            $('#salidaForm').toggle();
            $('#editBtn').hide();
            $('#cancelBtn').show();
            $('#submitBtn').show();
            $('#salidaForm').trigger('reset');
            $('#idSalida').val(''); // Asegúrate de limpiar el ID de salida
        });
    // Interceptar el envío del formulario
    $('#salidaForm').on('submit', function(event) {
        event.preventDefault();
        $('#submitBtn').click();
    });

    // Enviar datos del formulario para insertar una nueva salida
    $('#submitBtn').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'insertar_salida.php',
            data: $('#salidaForm').serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    title: response.message,
                    icon: (response.code === 200) ? "success" : "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                }).then(function(result) {
                    if (result.isConfirmed && response.code === 200) {
                        $('#salidaForm').trigger('reset');
                        $('#salidaForm').hide();
                        cargarTablaSalidas();
                    }
                });
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al agregar la salida.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Cargar tabla de salidas
    function cargarTablaSalidas() {
        $.ajax({
            type: 'GET',
            url: 'obtener_salidas.php',
            dataType: 'html',
            success: function(data) {
                $('#salidaTable tbody').html(data);
            },
            error: function() {
                console.error('Error al cargar la tabla de salidas');
            }
        });
    }

    // Mostrar datos de la salida en el formulario para editar
    $(document).on('click', '.editButton', function() {
        var id = $(this).data('id');
        editarSalida(id);
    });

    function editarSalida(id) {
        $.ajax({
            type: 'GET',
            url: 'actualizar_salida.php',
            data: { id_salida: id },
            dataType: 'json',
            success: function(response) {
                // Mostrar los datos de la salida en el formulario de edición
                $('#idSalida').val(response.id_salida);
                $('#fecha').val(response.fecha);
                $('#idProducto').val(response.id_producto);
                $('#cantidad').val(response.cantidad);
                $('#destino').val(response.destino);

                // Mostrar botones de edición y cancelar, ocultar botón de agregar
                $('#submitBtn').hide();
                $('#editBtn').show();
                $('#cancelBtn').show();
                $('#salidaForm').show();
            },
            error: function() {
                // Manejar errores si falla la solicitud AJAX
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al obtener los datos de la salida.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    }

    // Guardar cambios al editar una salida
    $('#editBtn').on('click', function() {
        // Obtener datos del formulario
        var id_salida = $('#idSalida').val();
        var fecha = $('#fecha').val();
        var id_producto = $('#idProducto').val();
        var cantidad = $('#cantidad').val();
        var destino = $('#destino').val();

        // Objeto con datos a enviar
        var data = {
            idsalida: id_salida,
            fecha: fecha,
            id_producto: id_producto,
            cantidad: cantidad,
            destino: destino
        };

        // Enviar datos mediante AJAX POST a actualizar_salida.php
        $.ajax({
            type: 'POST',
            url: 'actualizar_salida.php',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.code === 200) {
                    // Actualización exitosa
                    Swal.fire({
                        title: "Éxito",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK",
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    });

                    // Opcional: Actualizar la tabla de salidas o realizar otras acciones necesarias
                    cargarTablaSalidas();
                    // Ocultar formulario después de la actualización
                    $('#salidaForm').hide();
                } else {
                    // Error al actualizar
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        confirmButtonText: "OK",
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    });
                }
            },
            error: function() {
                // Error de conexión u otro error en la petición AJAX
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al actualizar la salida.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Eliminar una salida
    $(document).on('click', '.deleteButton', function() {
        var id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar esta salida?')) {
            $.ajax({
                type: 'POST',
                url: 'eliminar_salida.php',
                data: { id_salida: id },
                success: function(response) {
                    Swal.fire({
                        title: 'Salida eliminada',
                        text: response,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    }).then(function() {
                        cargarTablaSalidas();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al eliminar la salida.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    });
                }
            });
        }
    });

    // Buscar en la tabla de salidas
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#salidaTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Cancelar y ocultar el formulario
    $('#cancelBtn').on('click', function() {
        $('#salidaForm').hide();
        $('#salidaForm').trigger('reset');
        $('#submitBtn').show();
        $('#editBtn').hide();
        $('#cancelBtn').hide();
    });
});


$('#btnExportar').on('click', function() {
    var table = $('#salidaTable');
    var data = [];
    table.find('tr').each(function(rowIndex, r) {
        var cols = [];
        $(this).find('th, td').not(':last-child').each(function(colIndex, c) {
            cols.push(c.textContent.trim());
        });
        data.push(cols);
    });

    var ws = XLSX.utils.aoa_to_sheet(data);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Salidas');

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
    var yyyy = today.getFullYear();

    var formattedDate = dd + '-' + mm + '-' + yyyy;
    var filename = 'Salidas_' + formattedDate + '.xlsx';

    XLSX.writeFile(wb, filename);
});


document.addEventListener('DOMContentLoaded', function() {
    const { jsPDF } = window.jspdf;

    $('#btnExportarPDF').on('click', function() {
        var table = $('#salidaTable');
        var data = [];
        var headers = [];

        table.find('tr').each(function(rowIndex, r) {
            var cols = [];
            $(this).find('th, td').not(':last-child').each(function(colIndex, c) {
                if (rowIndex === 0) {
                    headers.push(c.textContent.trim());
                } else {
                    cols.push(c.textContent.trim());
                }
            });
            if (rowIndex !== 0) {
                data.push(cols);
            }
        });

        var doc = new jsPDF();

        // Encabezado del PDF
        doc.setFontSize(18);
        doc.text('Reporte de Salidas', 14, 22);

        // Logotipo (usa base64 de tu imagen)
        var logoData = 'data:image/png;base64,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'; // Reemplaza '...' con el contenido base64 de tu imagen
        doc.addImage(logoData, 'PNG', 170, 10, 30, 30);

        // Fecha actual en el encabezado
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
        var yyyy = today.getFullYear();

        var formattedDate = dd + '-' + mm + '-' + yyyy;
        doc.setFontSize(10);
        doc.text('Fecha: ' + formattedDate, 14, 32);

        // Tabla
        doc.autoTable({
            head: [headers],
            body: data,
            startY: 50,
            styles: { fontSize: 10, cellPadding: 3 },
            headStyles: { fillColor: [245, 128, 25], textColor: 255 }, // Color de encabezado de tabla
            alternateRowStyles: { fillColor: [240, 240, 240] }, // Color alternativo de las filas
        });

        // Pie de página
        doc.setFontSize(10);
        var pageCount = doc.internal.getNumberOfPages();
        for (var i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.text('Página ' + String(i) + ' de ' + String(pageCount), 180, 290, null, null, 'right');
        }

        var filename = 'Salidas_' + formattedDate + '.pdf';
        doc.save(filename);
    });
});
    </script>
