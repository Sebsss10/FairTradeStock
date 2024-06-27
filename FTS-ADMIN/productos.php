<div class="container" style="margin: auto;">
    <div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Productos</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nuevo</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="productForm" method="post" action="insertar_producto.php" style="display: none;">
        <div>
            <label for="idProd">ID Producto:</label>
            <input type="text" id="idProd" name="idProd" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="nombreProd">Nombre:</label>
            <input type="text" id="nombreProd" name="nombreProd" required>
        </div>
        <div>
            <label for="idCategoria">ID Categoría:</label>
            <input type="text" id="idCategoria" name="idCategoria" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" required pattern="[0-9.]+" title="Ingrese solo números y punto decimal">
        </div>
        <div>
            <label for="idProveedor">ID Proveedor:</label>
            <input type="text" id="idProveedor" name="idProveedor" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Producto</button>
        <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
        <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
    </form>

    <div class="table_container">
        <table id="productTable">
            <thead>
                <tr>
                    <th>ID Producto <i class="bi bi-chevron-expand"></i></th>
                    <th>Nombre Producto <i class="bi bi-chevron-expand"></i></th>
                    <th>Categoría <i class="bi bi-chevron-expand"></i></th>
                    <th>Descripción <i class="bi bi-chevron-expand"></i></th>
                    <th>Precio <i class="bi bi-chevron-expand"></i></th>
                    <th>Proveedor <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_productos.php'; ?>
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
            $('#productForm').toggle();
            $('#editBtn').hide();
            $('#cancelBtn').show();
            $('#productForm').trigger('reset');
        });

        // Enviar datos del formulario para insertar un nuevo producto
        $('#submitBtn').on('click', function() {
            $.ajax({
                type: 'POST',
                url: 'insertar_producto.php',
                data: $('#productForm').serialize(),
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
                            $('#productForm').trigger('reset');
                            $('#productForm').hide();
                            cargarTablaProductos();
                        }
                    });
                },
                error: function() {
                    Swal.fire({
                        title: "Error",
                        text: "Hubo un error al agregar el producto.",
                        icon: "error",
                        confirmButtonText: "OK",
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    });
                }
            });
        });

        // Cargar tabla de productos
        function cargarTablaProductos() {
            $.ajax({
                type: 'GET',
                url: 'obtener_productos.php',
                dataType: 'html',
                success: function(data) {
                    $('#productTable tbody').html(data);
                },
                error: function() {
                    console.error('Error al cargar la tabla de productos');
                }
            });
        }

// Mostrar datos del producto en el formulario para editar
$(document).on('click', '.editButton', function() {
    var id = $(this).data('id');
    editarProducto(id);
});

function editarProducto(id) {
    $.ajax({
        type: 'GET',
        url: 'actualizar_producto.php',
        data: { id_producto: id },
        dataType: 'json',
        success: function(response) {
              // Mostrar los datos del producto en el formulario de edición
              $('#idProd').val(response.id_producto);
                $('#nombreProd').val(response.nombre);
                $('#idCategoria').val(response.id_categoria);
                $('#descripcion').val(response.descripcion);
                $('#precio').val(response.precio);
                $('#idProveedor').val(response.id_proveedor);

                // Mostrar botones de edición y cancelar, ocultar botón de agregar
                $('#submitBtn').hide();
                $('#editBtn').show();
                $('#cancelBtn').show();
                $('#productForm').show();
        },
        error: function() {
            // Manejar errores si falla la solicitud AJAX
            Swal.fire({
                title: "Error",
                text: "Hubo un error al obtener los datos del producto.",
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    popup: 'custom-swal-popup'
                }
            });
        }
    });

    // Guardar cambios al editar un producto
    $('#editBtn').on('click', function() {
        // Obtener datos del formulario
        var id_producto = $('#idProd').val();
        var nombre = $('#nombreProd').val();
        var id_categoria = $('#idCategoria').val();
        var descripcion = $('#descripcion').val();
        var precio = $('#precio').val();
        var id_proveedor = $('#idProveedor').val();

        // Objeto con datos a enviar
        var data = {
            id_producto: id_producto,
            nombre: nombre,
            id_categoria: id_categoria,
            descripcion: descripcion,
            precio: precio,
            id_proveedor: id_proveedor
        };

        // Enviar datos mediante AJAX POST a actualizar_producto.php
        $.ajax({
            type: 'POST',
            url: 'actualizar_producto.php',
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

                    // Opcional: Actualizar la tabla de productos o realizar otras acciones necesarias
                    cargarTablaProductos();
                    // Ocultar formulario después de la actualización
                    $('#productForm').hide();
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
                    text: "Hubo un error al actualizar el producto.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });
}



        // Eliminar un producto
        $(document).on('click', '.deleteButton', function() {
            var id = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                $.ajax({
                    type: 'POST',
                    url: 'eliminar_producto.php',
                    data: { id_producto: id },
                    success: function(response) {
                        Swal.fire({
                            title: 'Producto eliminado',
                            text: response,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'custom-swal-popup'
                            }
                        }).then(function() {
                            cargarTablaProductos();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un error al eliminar el producto.',
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

        // Buscar en la tabla de productos
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#productTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Cancelar y ocultar el formulario
        $('#cancelBtn').on('click', function() {
            $('#productForm').hide();
            $('#productForm').trigger('reset');
            $('#submitBtn').show();
            $('#editBtn').hide();
            $('#cancelBtn').hide();
        });
    });
</script>
