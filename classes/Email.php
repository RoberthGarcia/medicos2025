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
        $mail->Subjet = 'Confirma tu cuenta';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        
        $contenido = "<html>";
        $contenido = "<p><strong>Hola " . $this->nombre .  "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
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
        $mail->Subjet = 'Restablece tu password';
        
        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        
        $contenido = "<html>";
        $contenido = "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado restablecer tu password, presiona el siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:30000/recuperar?token=" . $this->token ."'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }
}