<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container" style="margin: auto;">
    <div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Categorías</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nueva</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="categoryForm" method="post" action="insertar_categorias.php" style="display: none;">
        <div>
            <label for="idCat">ID Categoria:</label>
            <input type="text" id="idCat" name="idCat" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="nombreCat">Nombre:</label>
            <input type="text" id="nombreCat" name="nombreCat" required>
        </div>
        <div>
            <label for="descripcionCat">Descripción:</label>
            <textarea id="descripcionCat" name="descripcionCat" rows="3"></textarea>
        </div>
        <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Categoría</button>
        <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
        <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
    </form>

    <div class="table_container">
        <table id="categoryTable">
            <thead>
                <tr>
                    <th>ID Categoría <i class="bi bi-chevron-expand"></i></th>
                    <th>Nombre Categoría <i class="bi bi-chevron-expand"></i></th>
                    <th>Descripción <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_categorias.php'; ?>
            </tbody>
        </table>
    </div>
    <div class="table_footer"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container" style="margin: auto;">
    <div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Categorías</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nueva</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="categoryForm" method="post" action="insertar_categorias.php" style="display: none;">
        <div>
            <label for="idCat">ID Categoría:</label>
            <input type="text" id="idCat" name="idCat" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="nombreCat">Nombre:</label>
            <input type="text" id="nombreCat" name="nombreCat" required>
        </div>
        <div>
            <label for="descripcionCat">Descripción:</label>
            <textarea id="descripcionCat" name="descripcionCat" rows="3" required></textarea>
        </div>
        <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Categoría</button>
        <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
        <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
    </form>

    <div class="table_container">
        <table id="categoryTable">
            <thead>
                <tr>
                    <th>ID Categoría <i class="bi bi-chevron-expand"></i></th>
                    <th>Nombre Categoría <i class="bi bi-chevron-expand"></i></th>
                    <th>Descripción <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_categorias.php'; ?>
            </tbody>
        </table>
    </div>
    <div class="table_footer"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Mostrar u ocultar formulario al hacer clic en el botón "Crear nueva"
    $('#showFormBtn').on('click', function() {
        $('#categoryForm').toggle();
        $('#editBtn').hide();
        $('#cancelBtn').show();
        $('#categoryForm').trigger('reset');
    });

    // Enviar datos del formulario para insertar una nueva categoría
    $('#submitBtn').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'insertar_categorias.php',
            data: $('#categoryForm').serialize(),
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
                        $('#categoryForm').trigger('reset');
                        $('#categoryForm').hide();
                        cargarTablaCategorias();
                    }
                });
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al agregar la categoría.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Cargar tabla de categorías
    function cargarTablaCategorias() {
        $.ajax({
            type: 'GET',
            url: 'obtener_categorias.php',
            dataType: 'html',
            success: function(data) {
                $('#categoryTable tbody').html(data);
            },
            error: function() {
                console.error('Error al cargar la tabla de categorías');
            }
        });
    }

    // Mostrar datos de la categoría en el formulario para editar
    $(document).on('click', '.editButton', function() {
        var id = $(this).data('id');
        editarCategoria(id);
    });

    function editarCategoria(id) {
        $.ajax({
            type: 'GET',
            url: 'actualizar_categorias.php',
            data: { id_categoria: id },
            dataType: 'json',
            success: function(response) {
                $('#idCat').val(response.id_categoria);
                $('#nombreCat').val(response.nombre_categoria);
                $('#descripcionCat').val(response.descripcion_categoria);

                $('#submitBtn').hide();
                $('#editBtn').show();
                $('#cancelBtn').show();
                $('#categoryForm').show();
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al obtener los datos de la categoría.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    }

    // Guardar cambios al editar una categoría
    $('#editBtn').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'actualizar_categorias.php?id_categoria=' + $('#idCat').val(),
            data: $('#categoryForm').serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    title: response.message,
                    icon: (response.code === 200) ? "success" : "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                }).then(function() {
                    if (response.code === 200) {
                        $('#categoryForm').hide();
                        cargarTablaCategorias();
                    }
                });
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al actualizar la categoría.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Eliminar una categoría
    $(document).on('click', '.deleteButton', function() {
        var id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
            $.ajax({
                type: 'POST',
                url: 'eliminar_categoria.php',
                data: { id_categoria: id },
                success: function(response) {
                    Swal.fire({
                        title: 'Categoría eliminada',
                        text: response,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    }).then(function() {
                        cargarTablaCategorias();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al eliminar la categoría.',
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

    // Buscar en la tabla de categorías
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#categoryTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Cancelar y ocultar el formulario
    $('#cancelBtn').on('click', function() {
        $('#categoryForm').hide();
        $('#categoryForm').trigger('reset');
        $('#submitBtn').show();
        $('#editBtn').hide();
        $('#cancelBtn').hide();
    });
});

</script>
