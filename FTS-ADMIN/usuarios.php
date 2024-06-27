<div class="container" style="margin: auto;">
    <div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Usuarios</h2>
        <button id="showFormBtn"><i class="fas fa-folder-plus"></i> Crear nuevo</button>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <form id="userForm" method="post" action="insertar_usuarios.php" style="display: none;">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>
        <div>
            <br>
            <select id="rol" name="rol" class="form-control"  required>
                <option value="" disabled selected>Seleccione un rol</option>
                <option value="Administrador">Administrador</option>
                <option value="Empleado">Empleado</option>
            </select>
        </div>
        <button type="button" id="submitBtn" class="small-button"><i class="fas fa-plus"></i> Agregar Usuario</button>
        <button type="button" id="editBtn" class="small-button" style="display: none;"><i class="fas fa-save"></i> Guardar Cambios</button>
        <button type="button" id="cancelBtn" class="small-button" style="display: none;"><i class="fas fa-times"></i> Cancelar</button>
    </form>

    <div class="table_container">
        <table id="userTable">
            <thead>
                <tr>
                    <th>Usuario <i class="bi bi-chevron-expand"></i></th>
                    <th>Contraseña <i class="bi bi-chevron-expand"></i></th>
                    <th>Rol <i class="bi bi-chevron-expand"></i></th>
                    <th>Acciones <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_usuarios.php'; ?>
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
        $('#userForm').toggle();
        $('#editBtn').hide();
        $('#cancelBtn').show();
        $('#userForm').trigger('reset');
    });

    // Enviar datos del formulario para insertar un nuevo usuario
    $('#submitBtn').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'insertar_usuarios.php',
            data: $('#userForm').serialize(),
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
                        $('#userForm').trigger('reset');
                        $('#userForm').hide();
                        cargarTablaUsuarios();
                    }
                });
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al agregar el usuario.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Cargar tabla de usuarios
    function cargarTablaUsuarios() {
        $.ajax({
            type: 'GET',
            url: 'obtener_usuarios.php',
            dataType: 'html',
            success: function(data) {
                $('#userTable tbody').html(data);
            },
            error: function() {
                console.error('Error al cargar la tabla de usuarios');
            }
        });
    }

    // Mostrar datos del usuario en el formulario para editar
    $(document).on('click', '.editButton', function() {
        var usuario = $(this).data('usuario');
        editarUsuario(usuario);
    });

    function editarUsuario(usuario) {
        $.ajax({
            type: 'GET',
            url: 'actualizar_usuarios.php',
            data: { usuario: usuario },
            dataType: 'json',
            success: function(response) {
                // Mostrar los datos del usuario en el formulario de edición
                $('#usuario').val(response.usuario);
                $('#contrasena').val(response.contrasena);
                $('#rol').val(response.rol);

                // Mostrar botones de edición y cancelar, ocultar botón de agregar
                $('#submitBtn').hide();
                $('#editBtn').show();
                $('#cancelBtn').show();
                $('#userForm').show();
            },
            error: function() {
                // Manejar errores si falla la solicitud AJAX
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al obtener los datos del usuario.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    }

    // Guardar cambios al editar un usuario
    $('#editBtn').on('click', function() {
        // Obtener datos del formulario
        var usuario = $('#usuario').val();
        var contrasena = $('#contrasena').val();
        var rol = $('#rol').val();

        // Objeto con datos a enviar
        var data = {
            usuario: usuario,
            contrasena: contrasena,
            rol: rol
        };

        // Enviar datos mediante AJAX POST a actualizar_usuario.php
        $.ajax({
            type: 'POST',
            url: 'actualizar_usuarios.php',
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

                    // Opcional: Actualizar la tabla de usuarios o realizar otras acciones necesarias
                    cargarTablaUsuarios();
                    // Ocultar formulario después de la actualización
                    $('#userForm').hide();
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
                    text: "Hubo un error al actualizar el usuario.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            }
        });
    });

    // Eliminar un usuario
    $(document).on('click', '.deleteButton', function() {
        var usuario = $(this).data('usuario');
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            $.ajax({
                type: 'POST',
                url: 'eliminar_usuarios.php',
                data: { usuario: usuario },
                success: function(response) {
                    Swal.fire({
                        title: 'Usuario eliminado',
                        text: response,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'custom-swal-popup'
                        }
                    }).then(function() {
                        cargarTablaUsuarios();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al eliminar el usuario.',
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

    // Buscar en la tabla de usuarios
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#userTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Cancelar y ocultar el formulario
    $('#cancelBtn').on('click', function() {
        $('#userForm').hide();
        $('#userForm').trigger('reset');
        $('#submitBtn').show();
        $('#editBtn').hide();
        $('#cancelBtn').hide();
    });

    // Cargar la tabla de usuarios al cargar la página
    cargarTablaUsuarios();
});

</script>
