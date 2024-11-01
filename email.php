<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['honeypot'])) {
        echo "<p>Spam detected</p>";
        exit;
    }

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $to = "info@chanoskiholding.com";
            $subject = "Nuevo mensaje de contacto";
            $body = "Nombre: $name\nEmail: $email\nTeléfono: $phone\nMensaje:\n$message";
            $headers = "From: $email";

            if (mail($to, $subject, $body, $headers)) {
                echo "<p>Mensaje enviado correctamente.</p>";
            } else {
                echo "<p>Error al enviar el mensaje. Inténtelo de nuevo más tarde.</p>";
            }
        } else {
            echo "<p>Dirección de correo electrónico no válida.</p>";
        }
    } else {
        echo "<p>Todos los campos son obligatorios.</p>";
    }
}
?>