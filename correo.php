<?php
if (isset($_POST['enviar'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $msg = $_POST['msg'];

    $to = 'fairtradestockfts@gmail.com'; // Change this to your email address
    $subject = 'Formulario de Contacto: ' . $asunto;
    $message = "Nombre: $name\nCorreo: $email\n\nMensaje:\n$msg";
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo 'Tu mensaje ha sido enviado.';
    } else {
        echo 'Error al enviar tu mensaje.';
    }
}
?>