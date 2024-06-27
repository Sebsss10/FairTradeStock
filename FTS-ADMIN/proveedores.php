<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container" style="margin: auto;">
<div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Proveedores</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nuevo</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="providerForm" method="post" action="insertar_proveedor.php" style="display: none;">
        <div>
            <label for="idPr">ID Proveedor:</label>
            <input type="text" id="idPr" name="idPr" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="nombrePr">Nombre:</label>
            <input type="text" id="nombrePr" name="nombrePr" required>
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required title="Ingrese una dirección de correo electrónico válida">
        </div>
        <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Proveedor</button>
    <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
    <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
</form>
    </form>
    </form>

    <div class="table_container">
        <table id="providerTable">
            <thead>
                <tr>
                    <th>ID Proveedor <i class="bi bi-chevron-expand"></i></th>
                    <th>Nombre Proveedor <i class="bi bi-chevron-expand"></i></th>
                    <th>Dirección <i class="bi bi-chevron-expand"></i></th>
                    <th>Teléfono <i class="bi bi-chevron-expand"></i></th>
                    <th>Email <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_proveedores.php'; ?>
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
        <h2>Proveedores</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nuevo</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="providerForm" method="post" action="insertar_proveedor.php" style="display: none;">
        <div>
            <label for="idPr">ID Proveedor:</label>
            <input type="text" id="idPr" name="idPr" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="nombrePr">Nombre:</label>
            <input type="text" id="nombrePr" name="nombrePr" required>
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required pattern="[0-9]+" title="Ingrese solo números">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required title="Ingrese una dirección de correo electrónico válida">
        </div>
        <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Proveedor</button>
        <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
        <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
    </form>

    <div class="table_container">
        <table id="providerTable">
            <thead>
                <tr>
                    <th>ID Proveedor <i class="bi bi-chevron-expand"></i></th>
                    <th>Nombre Proveedor <i class="bi bi-chevron-expand"></i></th>
                    <th>Dirección <i class="bi bi-chevron-expand"></i></th>
                    <th>Teléfono <i class="bi bi-chevron-expand"></i></th>
                    <th>Email <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_proveedores.php'; ?>
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
        $('#providerForm').toggle();
        $('#editBtn').hide();
        $('#cancelBtn').show();
        $('#providerForm').trigger('reset');
    });

    // Enviar datos del formulario para insertar un nuevo proveedor
    $('#submitBtn').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'insertar_proveedor.php',
            data: $('#providerForm').serialize(),
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
                        $('#providerForm').trigger('reset');
                        $('#providerForm').hide();
                        cargarTablaProveedores();
                    }
                });
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al agregar el proveedor.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Cargar tabla de proveedores
    function cargarTablaProveedores() {
        $.ajax({
            type: 'GET',
            url: 'obtener_proveedores.php',
            dataType: 'html',
            success: function(data) {
                $('#providerTable tbody').html(data);
            },
            error: function() {
                console.error('Error al cargar la tabla de proveedores');
            }
        });
    }

    // Mostrar datos del proveedor en el formulario para editar
    $(document).on('click', '.editButton', function() {
        var id = $(this).data('id');
        editarProveedor(id);
    });

    function editarProveedor(id) {
        $.ajax({
            type: 'GET',
            url: 'actualizar_proveedor.php',
            data: { id_proveedor: id },
            dataType: 'json',
            success: function(response) {
                $('#idPr').val(response.id_proveedor);
                $('#nombrePr').val(response.nombre);
                $('#direccion').val(response.direccion);
                $('#telefono').val(response.telefono);
                $('#email').val(response.email);

                $('#submitBtn').hide();
                $('#editBtn').show();
                $('#cancelBtn').show();
                $('#providerForm').show();
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al obtener los datos del proveedor.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    }

    // Guardar cambios al editar un proveedor
    $('#editBtn').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'actualizar_proveedor.php?id_proveedor=' + $('#idPr').val(),
            data: $('#providerForm').serialize(),
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
                        $('#providerForm').hide();
                        cargarTablaProveedores();
                    }
                });
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al actualizar el proveedor.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Eliminar un proveedor
    $(document).on('click', '.deleteButton', function() {
        var id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
            $.ajax({
                type: 'POST',
                url: 'eliminar_proveedor.php',
                data: { id_proveedor: id },
                success: function(response) {
                    Swal.fire({
                        title: 'Proveedor eliminado',
                        text: response,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    }).then(function() {
                        cargarTablaProveedores();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al eliminar el proveedor.',
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

    // Buscar en la tabla de proveedores
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#providerTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Cancelar y ocultar el formulario
    $('#cancelBtn').on('click', function() {
        $('#providerForm').hide();
        $('#providerForm').trigger('reset');
        $('#submitBtn').show();
        $('#editBtn').hide();
        $('#cancelBtn').hide();
    });
});

</script>
