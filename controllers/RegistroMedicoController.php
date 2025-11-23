<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Medico;

class RegistroMedicoController {
    
    public static function registro(Router $router) {
        $medico = new Medico;
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $medico->sincronizar($_POST);
            $alertas = $medico->validarRegistro();
            
            // Revisar que alertas esté vacío
            if(empty($alertas)) {
                // Verificar que el médico no esté registrado
                $resultado = $medico->existeMedico();
                
                if($resultado->num_rows) {
                    $alertas = Medico::getAlertas();
                } else {
                    // Hashear el password
                    $medico->hashPassword();
                    
                    // Generar un token único
                    $medico->crearToken();
                    
                    // Establecer valores por defecto
                    $medico->email_verificado = 0;
                    $medico->perfil_verificado = 0;
                    $medico->activo = 0;
                    $medico->plan_suscripcion = 'basico';
                    
                    // Enviar el email de confirmación
                    $email = new Email($medico->email, $medico->nombre, $medico->token);
                    $email->enviarConfirmacionMedico();
                    
                    // Crear el médico
                    $resultado = $medico->guardar();
                    
                    if($resultado) {
                        header('Location: /medicos/mensaje');
                    }
                }
            }
        }
        
        $router->render('auth/registro-medico', [
            'medico' => $medico,
            'alertas' => $alertas   
        ]);
    }
    
    public static function mensaje(Router $router) {
        $router->render('auth/mensaje-medico');
    }
    
    public static function confirmar(Router $router) {
        $alertas = [];
        
        $token = s($_GET['token']);
        
        $medico = Medico::where('token', $token);
        
        if(empty($medico)) {
            // Mostrar mensaje de error
            Medico::setAlerta('error', 'Token no válido');
        } else {
            // Modificar a médico con email verificado
            $medico->email_verificado = 1;
            $medico->token = null;
            $medico->guardar();
            Medico::setAlerta('exito', 'Email verificado correctamente. Su perfil está pendiente de aprobación por un administrador.');      
        }
        
        // Obtener alertas
        $alertas = Medico::getAlertas();
        
        // Renderizar la vista
        $router->render('auth/confirmar-medico', [
            'alertas' => $alertas 
        ]);      
    }
    
    public static function login(Router $router) {
        $alertas = [];
        $auth = new Medico;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Medico($_POST);
            
            $alertas = $auth->validarLogin();
            
            if(empty($alertas)) {
                // Comprobar que exista el médico
                $medico = Medico::where('email', $auth->email);
                
                if($medico) {
                    // Verificar el password y que esté verificado
                    if($medico->comprobarPasswordYVerificado($auth->password)) {
                        // Autentificar el médico
                        session_start();
                        
                        $_SESSION['id_medico'] = $medico->id_medico;
                        $_SESSION['nombre_medico'] = $medico->nombre . " " . $medico->apellido;
                        $_SESSION['email_medico'] = $medico->email;
                        $_SESSION['login_medico'] = true;
                        $_SESSION['plan_suscripcion'] = $medico->plan_suscripcion;
                        
                        // Actualizar último acceso
                        $medico->ultimo_acceso = date('Y-m-d H:i:s');
                        $medico->guardar();
                        
                        header('Location: /medicos/panel');
                    }         
                } else {
                    Medico::setAlerta('error', 'Médico no encontrado');
                }
            }
        }
        
        $alertas = Medico::getAlertas();      
        $router->render('auth/login-medico', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }
    
    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /medicos/login');
    }
    
    public static function olvide(Router $router) {
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Medico($_POST);
            $alertas = $auth->validarEmail();
            
            if(empty($alertas)) {
                $medico = Medico::where('email', $auth->email);
                
                if($medico && $medico->email_verificado === "1") {
                    // Generar un token
                    $medico->crearToken();
                    $medico->guardar();
                    
                    // Enviar el email
                    $email = new Email($medico->email, $medico->nombre, $medico->token);
                    $email->enviarInstruccionesMedico();
                    
                    // Alerta de éxito
                    Medico::setAlerta('exito', 'Revisa tu email');
                } else {
                    Medico::setAlerta('error', 'El médico no existe o no está confirmado');
                }
            }
        }
        
        $alertas = Medico::getAlertas();
        $router->render('auth/olvide-password-medico', [
            'alertas' => $alertas
        ]);
    }
    
    public static function recuperar(Router $router) {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        
        // Buscar médico por su token
        $medico = Medico::where('token', $token);
        
        if(empty($medico)) {
            Medico::setAlerta('error', 'Token no válido');
            $error = true;
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer el nuevo password y guardarlo
            $password = new Medico($_POST);
            $alertas = $password->validarPassword();
            
            if(empty($alertas)) {
                $medico->password = null;
                $medico->password = $password->password;
                $medico->hashPassword();
                $medico->token = null;
                $resultado = $medico->guardar();
                
                if($resultado) {
                    header('Location: /medicos/login');
                }
            }
        }
        
        $alertas = Medico::getAlertas();
        
        $router->render('auth/recuperar-password-medico', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
}
