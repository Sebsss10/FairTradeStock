<?php
if (isset($_POST['enviar'])) {
    if (!empty($_POST['name']) && !empty($_POST['asunto']) && !empty($_POST['msg']) && !empty($_POST['email'])) {
        $name = htmlspecialchars($_POST['name']);
        $asunto = htmlspecialchars($_POST['asunto']);
        $msg = htmlspecialchars($_POST['msg']);
        $email = htmlspecialchars('ideqthmarket@gmail.com');
        $emailr = htmlspecialchars($_POST['email']);

        // Agregar el nombre y el correo electrónico al cuerpo del mensaje
        $mensaje = "Nombre: $name\nCorreo Electrónico: $emailr\n\nMensaje:\n$msg";
        
        // Configuración del encabezado
        $header = "From: noreply@example.com\r\n";
        $header .= "Reply-To: noreply@example.com\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();

        // Usar la función mail() de PHP
        $mail = mail($email, $asunto, $mensaje, $header);

        if ($mail) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Mail enviado exitosamente!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = 'index.php'; // Redirige a la página principal después de la alerta
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'No enviado',
                    text: 'Hubo un problema al enviar el correo. Inténtalo de nuevo más tarde.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = 'index.php'; // Redirige a la página principal después de la alerta
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Por favor, completa todos los campos.',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = 'index.php'; // Redirige a la página principal después de la alerta
            });
        </script>";
    }
}
?>
