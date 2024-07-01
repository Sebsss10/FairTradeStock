<div class="container" style="margin: auto;">
    <div class="table_header">
        <img src="img/FairTradeStock.png" alt="Logo de la empresa" style="width: 100px; height: auto;">
        <h2>Inventario</h2>
        <div class="input_search">
            <input type="search" id="searchInput" placeholder="Buscar" />
            <i class="bi bi-search" id="searchIcon"></i>
        </div>
    </div>

    <div class="table_container">
        <table id="inventarioTable">
            <thead>
                <tr>
                    <th>ID Inventario <i class="bi bi-chevron-expand"></i></th>
                    <th>ID Producto <i class="bi bi-chevron-expand"></i></th>
                    <th>Nombre Producto <i class="bi bi-chevron-expand"></i></th>
                    <th>Cantidad Disponible <i class="bi bi-chevron-expand"></i></th>
                    <th>Fecha Actualización <i class="bi bi-chevron-expand"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php include 'obtener_inventario.php'; ?>
            </tbody>
        </table>
    </div>
    <div class="table_footer"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Cargar tabla de inventario
        function cargarTablaInventario() {
            $.ajax({
                type: 'GET',
                url: 'obtener_inventario.php',
                dataType: 'html',
                success: function(data) {
                    $('#inventarioTable tbody').html(data);
                },
                error: function() {
                    console.error('Error al cargar la tabla de inventario');
                }
            });
        }

        // Polling para actualizar la tabla de inventario cada 5 segundos
        setInterval(cargarTablaInventario, 5000);

        // Buscar en la tabla de inventario
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#inventarioTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Cargar la tabla de inventario al cargar la página
        cargarTablaInventario();
    });
</script>
