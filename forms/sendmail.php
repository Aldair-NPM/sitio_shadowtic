<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de instalar PHPMailer con Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@gmail.com'; // Reemplaza con tu correo de Gmail
        $mail->Password = 'tu_contraseña_o_contraseña_de_aplicación'; // Usa una contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom($email, $name);
        $mail->addAddress('destinatario@gmail.com'); // Reemplaza con el correo donde deseas recibir los mensajes

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "<h3>Mensaje de: $name ($email)</h3><p>$message</p>";

        // Enviar correo
        $mail->send();
        echo "<script>alert('Mensaje enviado correctamente.'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error al enviar el mensaje: {$mail->ErrorInfo}'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Acceso no permitido.'); window.location.href='index.html';</script>";
}
?>
