<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //Crear el objeto de email
        $mail = new PHPMailer();        
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c0fa70d52a4eb3';
        $mail->Password = '188ceacd2ab0f2';
        
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:30000/confirmar-cuenta?token=" . $this->token ."'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }

    public function enviarInstrucciones() {
        //Crear el objeto de email
        $mail = new PHPMailer();        
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c0fa70d52a4eb3';
        $mail->Password = '188ceacd2ab0f2';
        
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject = 'Restablece tu password';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado restablecer tu password, presiona el siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:30000/recuperar?token=" . $this->token ."'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }

    // Métodos para Médicos
    public function enviarConfirmacionMedico() {
        //Crear el objeto de email
        $mail = new PHPMailer();        
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c0fa70d52a4eb3';
        $mail->Password = '188ceacd2ab0f2';
        
        $mail->setFrom('medicos@directoriomedico.com');
        $mail->addAddress('medicos@directoriomedico.com', 'Directorio Médico');
        $mail->Subject = 'Confirma tu cuenta de Médico';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola Dr(a). " . $this->nombre . "</strong></p>";
        $contenido .= "<p>Has creado tu cuenta profesional en Directorio Médico. Por favor, confirma tu email presionando el siguiente enlace:</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:30000/medicos/confirmar?token=" . $this->token . "'>Confirmar Email</a></p>";
        $contenido .= "<p><strong>Importante:</strong> Una vez confirmado tu email, tu perfil será revisado por nuestro equipo administrativo para su aprobación.</p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }

    public function enviarInstruccionesMedico() {
        //Crear el objeto de email
        $mail = new PHPMailer();        
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c0fa70d52a4eb3';
        $mail->Password = '188ceacd2ab0f2';
        
        $mail->setFrom('medicos@directoriomedico.com');
        $mail->addAddress('medicos@directoriomedico.com', 'Directorio Médico');
        $mail->Subject = 'Restablece tu password - Cuenta Médico';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola Dr(a). " . $this->nombre . "</strong></p>";
        $contenido .= "<p>Has solicitado restablecer tu password de tu cuenta profesional. Presiona el siguiente enlace para hacerlo:</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:30000/medicos/recuperar?token=" . $this->token . "'>Restablecer Password</a></p>";
        $contenido .= "<p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }
}
