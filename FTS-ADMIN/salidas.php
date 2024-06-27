<div class="container" style="margin: auto;">
    <div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Salidas</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nueva salida</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="salidaForm" method="post" action="insertar_salida.php" style="display: none;">
        <div>
            <label for="idSalida">ID Salida:</label>
            <input type="text" id="idSalida" name="idsalida" required>
        </div>
        <div>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD" required>

        </div>
        <div>
            <label for="idProducto">ID Producto:</label>
            <input type="text" id="idProducto" name="id_producto" required>
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
                    <th>ID Producto <i class="bi bi-chevron-expand"></i></th>
                    <th>Cantidad <i class="bi bi-chevron-expand"></i></th>
                    <th>Destino <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
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
        // Mostrar u ocultar formulario al hacer clic en el botón "Crear nuevo"
        $('#showFormBtn').on('click', function() {
            $('#salidaForm').toggle();
            $('#editBtn').hide();
            $('#cancelBtn').show();
            $('#salidaForm').trigger('reset');
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


</script>
