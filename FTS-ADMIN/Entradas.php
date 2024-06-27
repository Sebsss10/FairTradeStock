<div class="container" style="margin: auto;">
    <div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Entradas</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nueva entrada</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="entradaForm" method="post" action="insertar_entrada.php" style="display: none;">
        <div>
            <label for="idEntrada">ID Entrada:</label>
            <input type="text" id="idEntrada" name="identrada" required>
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
            <label for="idProveedor">ID Proveedor:</label>
            <input type="text" id="idProveedor" name="id_proveedor" required>
            </select>
        </div>
        <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Entrada</button>
        <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
        <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
    </form>

    <div class="table_container">
        <table id="entradaTable">
            <thead>
                <tr>
                    <th>ID Entrada <i class="bi bi-chevron-expand"></i></th>
                    <th>Fecha <i class="bi bi-chevron-expand"></i></th>
                    <th>ID Producto <i class="bi bi-chevron-expand"></i></th>
                    <th>Cantidad <i class="bi bi-chevron-expand"></i></th>
                    <th>ID Proveedor <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_entradas.php'; ?>
            </tbody>
        </table>
    </div>
    <div class="table_footer"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Mostrar u ocultar formulario al hacer clic en el botón "Crear nueva entrada"
        $('#showFormBtn').on('click', function() {
            $('#entradaForm').toggle();
            $('#editBtn').hide();
            $('#cancelBtn').show();
            $('#entradaForm').trigger('reset');
        });

        // Enviar datos del formulario para insertar una nueva entrada
        $('#submitBtn').on('click', function() {
            $.ajax({
                type: 'POST',
                url: 'insertar_entrada.php',
                data: $('#entradaForm').serialize(),
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
                            $('#entradaForm').trigger('reset');
                            $('#entradaForm').hide();
                            cargarTablaEntradas();
                        }
                    });
                },
                error: function() {
                    Swal.fire({
                        title: "Error",
                        text: "Hubo un error al agregar la entrada.",
                        icon: "error",
                        confirmButtonText: "OK",
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    });
                }
            });
        });

        // Cargar tabla de entradas
        function cargarTablaEntradas() {
            $.ajax({
                type: 'GET',
                url: 'obtener_entradas.php',
                dataType: 'html',
                success: function(data) {
                    $('#entradaTable tbody').html(data);
                },
                error: function() {
                    console.error('Error al cargar la tabla de entradas');
                }
            });
        }

        // Mostrar datos de la entrada en el formulario para editar
        $(document).on('click', '.editButton', function() {
            var id = $(this).data('id');
            editarEntrada(id);
        });

        function editarEntrada(id) {
            $.ajax({
                type: 'GET',
                url: 'actualizar_entrada.php',
                data: { id_entrada: id },
                dataType: 'json',
                success: function(response) {
                    // Mostrar los datos de la entrada en el formulario de edición
                    $('#idEntrada').val(response.id_entrada);
                    $('#fecha').val(response.fecha);
                    $('#idProducto').val(response.id_producto);
                    $('#cantidad').val(response.cantidad);
                    $('#idProveedor').val(response.id_proveedor);

                    // Mostrar botones de edición y cancelar, ocultar botón de agregar
                    $('#submitBtn').hide();
                    $('#editBtn').show();
                    $('#cancelBtn').show();
                    $('#entradaForm').show();
                },
                error: function() {
                    // Manejar errores si falla la solicitud AJAX
                    Swal.fire({
                        title: "Error",
                        text: "Hubo un error al obtener los datos de la entrada.",
                        icon: "error",
                        confirmButtonText: "OK",
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    });
                }
            });
        }

        // Guardar cambios al editar una entrada
        $('#editBtn').on('click', function() {
            // Obtener datos del formulario
            var id_entrada = $('#idEntrada').val();
            var fecha = $('#fecha').val();
            var id_producto = $('#idProducto').val();
            var cantidad = $('#cantidad').val();
            var id_proveedor = $('#idProveedor').val();

            // Objeto con datos a enviar
            var data = {
                id_entrada: id_entrada,
                fecha: fecha,
                id_producto: id_producto,
                cantidad: cantidad,
                id_proveedor: id_proveedor
            };

            // Enviar datos mediante AJAX POST a actualizar_entrada.php
            $.ajax({
                type: 'POST',
                url: 'actualizar_entrada.php',
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

                        // Opcional: Actualizar la tabla de entradas o realizar otras acciones necesarias
                        cargarTablaEntradas();
                        // Ocultar formulario después de la actualización
                        $('#entradaForm').hide();
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
                        text: "Hubo un error al actualizar la entrada.",
                        icon: "error",
                        confirmButtonText: "OK",
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    });
                }
            });
        });

        // Eliminar una entrada
        $(document).on('click', '.deleteButton', function() {
            var id = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar esta entrada?')) {
                $.ajax({
                    type: 'POST',
                    url: 'eliminar_entrada.php',
                    data: { id_entrada: id },
                    success: function(response) {
                        Swal.fire({
                            title: 'Entrada eliminada',
                            text: response,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'custom-swal-popup'
                            }
                        }).then(function() {
                            cargarTablaEntradas();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un error al eliminar la entrada.',
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

        // Buscar en la tabla de entradas
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#entradaTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Cancelar y ocultar el formulario
        $('#cancelBtn').on('click', function() {
            $('#entradaForm').hide();
            $('#entradaForm').trigger('reset');
            $('#submitBtn').show();
            $('#editBtn').hide();
            $('#cancelBtn').hide();
        });
    });
</script>
