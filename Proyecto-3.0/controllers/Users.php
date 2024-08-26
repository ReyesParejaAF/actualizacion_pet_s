<?php
require_once 'models/User.php'; // Asegúrate de incluir la clase User
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Users
{
    public function mostrarFormularioRegistro()
    {
        require 'views/registro.view.php';
    }

    public function mostrarFormularioLogin()
    {
        require 'views/login.view.php';
    }

    public function procesarRegistro()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('El correo electrónico no es válido.');</script>";
            require 'views/registro.view.php'; // Vuelve a la vista de registro
            return;
        }

        // Verificar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            echo "<script>alert('Las contraseñas no coinciden.');</script>";
            require 'views/registro.view.php'; // Vuelve a la vista de registro
            return;
        }

        // Verificación de la contraseña
        if (!preg_match('/^(?=.*[A-Z])(?=.*\W).{8,}$/', $password)) {
            echo "<script>alert('La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un signo especial.');</script>";
            require 'views/registro.view.php'; // Vuelve a la vista de registro
            return;
        }

        // Crear usuario
        $user = new User();
        $resultado = $user->crearUsuario($email, $password);

        if ($resultado === true) {
            // Enviar correo de confirmación
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP
                $mail->SMTPDebug = 2; // Mostrar información de depuración detallada
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';    // Servidor SMTP de Gmail
                $mail->SMTPAuth = true;
                $mail->Username = 'petstylobog@gmail.com'; // Tu correo de Gmail
                $mail->Password = 'kube xkah hjrr qsse'; // Tu contraseña de aplicación de Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Desactivar la depuración de SMTP
                $mail->SMTPDebug = 0;

                // Configuración del correo
                $mail->setFrom('petstylobog@gmail.com', 'Pet Stylo');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Registro exitoso';
                $mail->Body = 'Hola,<br><br>Te has registrado exitosamente en nuestro sitio.';

                $mail->send();
                echo "<script>alert('Usuario creado exitosamente y correo enviado.');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Usuario creado, pero no se pudo enviar el correo. Error: " . $mail->ErrorInfo . "');</script>";
            }
        } else {
            echo "<script>alert('Error al crear el registro.');</script>";
        }
        require 'views/login.view.php'; // Vuelve a la vista de registro
    }
}


    public function procesarFormularioLogin()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $resultado = $user->verificarUsuario($email, $password);

        if ($resultado) {
            $_SESSION['user_id'] = $resultado;
            $_SESSION['email'] = $email;
            require 'views/bienvenida.php';
        } else {
            echo "<script>alert('Email o contraseña incorrectos.');</script>";
            require 'views/login.view.php'; // Asegúrate de volver a cargar la página de login después de mostrar la alerta.
        }
    }
}

    public function mostrarLogin()
    {
        $this->mostrarFormularioLogin();
    }

    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location: index.php?controller=Users&action=mostrarLogin&message=logout_success");
        exit();
    }

    // Mostrar el formulario para solicitar recuperación de contraseña
    public function mostrarFormularioRecuperacion()
    {
        require 'views/recuperar.view.php';
    }

    // Procesar la solicitud de recuperación de contraseña
    public function procesarRecuperacion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $user = new User();
            $usuario = $user->encontrarUsuarioPorEmail($email);

            if ($usuario) {
                $token = bin2hex(random_bytes(50));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $user->actualizarToken($email, $token, $expiry);

                $link = 'http://localhost/proyecto3.0/index.php?controller=Users&action=mostrarFormularioReiniciarPassword&token=' . $token;
                $mensaje = "Click en el siguiente enlace para restablecer tu contraseña: <a href='$link'>$link</a>";

                // Enviar el correo con el enlace de recuperación
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor SMTP
                    $mail->SMTPDebug = 2; // Mostrar información de depuración detallada
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';    // Servidor SMTP de Gmail
                    $mail->SMTPAuth = true;
                    $mail->Username = 'petstylobog@gmail.com'; // Tu correo de Gmail
                    $mail->Password = 'kube xkah hjrr qsse'; // Tu contraseña de aplicación de Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Desactivar la depuración de SMTP
                    $mail->SMTPDebug = 0;

                    // Configuración del correo
                    $mail->setFrom('petstylobog@gmail.com', 'Pet Stylo');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperación de Contraseña';
                    $mail->Body = $mensaje;

                    $mail->send();
                    $mensaje = "Se ha enviado un enlace de recuperación a tu correo electrónico.";
                } catch (Exception $e) {
                    $mensaje = 'No se pudo enviar el correo de recuperación. Error: ' . $mail->ErrorInfo;
                }
            } else {
                $mensaje = "No se encontró una cuenta con ese correo electrónico.";
            }

            require 'views/resultado.php'; // Mostrar el mensaje
        }
    }

    // Mostrar el formulario para reiniciar la contraseña
    public function mostrarFormularioReiniciarPassword()
    {
        $token = $_GET['token'];
        require 'views/reiniciar.view.php';
    }

    // Procesar el reinicio de contraseña
    public function procesarReiniciarPassword(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $token = $_POST['token'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        if ($password !== $confirm_password) {
            echo "<script>alert('Las contraseñas no coinciden.');</script>";
            require 'views/reiniciar.view.php';
            return;
        }

        // Comprobación de la contraseña
        if (!preg_match('/^(?=.*[A-Z])(?=.*\W).{8,}$/', $password)) {
            echo "<script>alert('La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un signo especial.');</script>";
            require 'views/reiniciar.view.php'; 
            return;
        }

        $user = new User();
        $usuario = $user->encontrarUsuarioPorToken($token);

            if ($usuario) {
                $user->actualizarPassword($usuario['id'], $password);
                $mensaje = "Contraseña actualizada exitosamente.";
                require 'views/resultado.php';
            } else {
                $mensaje = "El enlace de recuperación es inválido o ha expirado.";
                require 'views/resultado.php';
            }
        }
    }
    
}
