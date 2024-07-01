$(document).ready(function(){
    /* Mostrar u ocultar menú principal */
    $('.btn-menu').on('click', function(){
        $('.navLateral').toggleClass('navLateral-change');
        $('.pageContent').toggleClass('pageContent-change');
        $('.navBar-options').toggleClass('navBar-options-change');
    });

    /* Salir del sistema */
    $('.btn-exit').on('click', function(){
        Swal.fire({
            title: '¿Quieres salir del sistema?',
            text: "La sesión actual se cerrará y saldrás del sistema.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'custom-swal-popup' // Agregar customClass aquí
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.html'; // Redirigir si se confirma
            }
        });
    });

    /* Mostrar y ocultar submenús */
    $('.btn-subMenu').on('click', function(){
        var subMenu = $(this).next('ul');
        var icon = $(this).children("span");
        
        subMenu.toggleClass('sub-menu-options-show');
        icon.toggleClass('zmdi-chevron-down zmdi-chevron-left');
    });

    // Evento 2: Hover en la imagen del avatar
    $('figure img').hover(function() {
        $(this).css('border', '2px solid #F5821A');
    }, function() {
        $(this).css('border', 'none');
    });

    // Evento 4: Focus en el título de bienvenida
    $('.tittles').focus(function() {
        $(this).css('color', 'blue');
    }).blur(function() {
        $(this).css('color', '');
    });

    // Evento 6: Hover en los artículos
    $('article').hover(function() {
        $(this).css('background-color', '#f0f0f0');
    }, function() {
        $(this).css('background-color', '');
    });

    // Evento 7: Mouseover en los elementos del menú
    $('.navLateral-body-cr').mouseover(function() {
        $(this).css('font-weight', 'bold');
    }).mouseout(function() {
        $(this).css('font-weight', 'normal');
    });

    // Evento 8: Click en el menú lateral
    $('.btn-menu').click(function() {
        $('.navLateral').toggleClass('active');
    });

    // Evento 14: Añadir un borde a los artículos al recibir el foco
    $('.tile').focus(function() {
        $(this).css('border', '2px solid red');
    }).blur(function() {
        $(this).css('border', 'none');
    });
});

(function($){
    $(window).on("load", function(){
        $(".NotificationArea, .pageContent").mCustomScrollbar({
            theme: "dark-thin",
            scrollbarPosition: "inside",
            autoHideScrollbar: true,
            scrollButtons: { enable: true }
        });
        $(".navLateral-body").mCustomScrollbar({
            theme: "light-thin",
            scrollbarPosition: "inside",
            autoHideScrollbar: true,
            scrollButtons: { enable: true }
        });
    }); 
})(jQuery);
