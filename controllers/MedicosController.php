<?php

namespace Controllers;

use Model\Medico;
use MVC\Router;
use Classes\ImageHandler;

class MedicosController {
    
    /**
     * Mostrar todos los médicos (Admin)
     */
    public static function index(Router $router) {
        // Proteger ruta (si tienes sistema de autenticación)
        // session_start();
        // isAdmin();
        
        $medicos = Medico::all();
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('medicos/admin', [
            'medicos' => $medicos,
            'resultado' => $resultado
        ]);
    }
    
    /**
     * Crear nuevo médico
     */
    public static function crear(Router $router) {
        // Proteger ruta
        // session_start();
        // isAdmin();
        
        $medico = new Medico();
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Sincronizar datos del POST
            $medico->sincronizar($_POST);
            
            // Manejar checkboxes (si no están marcados, no vienen en POST)
            $medico->email_verificado = $_POST['email_verificado'] ?? 0;
            $medico->perfil_verificado = $_POST['perfil_verificado'] ?? 0;
            $medico->activo = $_POST['activo'] ?? 0;
            $medico->destacado = $_POST['destacado'] ?? 0;
            $medico->permite_telemedicina = $_POST['permite_telemedicina'] ?? 0;
            
            // Validar
            $alertas = $medico->validar();
            
            // Verificar que no exista el email
            if(empty($alertas)) {
                $existeEmail = $medico->existeEmail();
                
                if(!$existeEmail) {
                    
                    // Hashear password
                    if($medico->password_hash) {
                        $medico->hashPassword();
                    }
                    
                    // Manejo de imagen
                    $imageHandler = new ImageHandler('medicos');
                    
                    if($_FILES['foto_perfil']['tmp_name']) {
                        $resultadoImagen = $imageHandler->subirImagen($_FILES['foto_perfil']);
                        
                        if($resultadoImagen['resultado']) {
                            $medico->foto_perfil = $resultadoImagen['nombreArchivo'];
                        } else {
                            $alertas['error'][] = $resultadoImagen['error'];
                        }
                    }
                    
                    // Guardar en BD si no hay errores
                    if(empty($alertas)) {
                        $resultado = $medico->guardar();
                        
                        if($resultado['resultado']) {
                            header('Location: /admin/medicos?resultado=1');
                            exit;
                        }
                    }
                }
            }
        }
        
        $router->render('medicos/crear', [
            'medico' => $medico,
            'alertas' => $alertas
        ]);
    }
    
    /**
     * Actualizar médico existente
     */
    public static function actualizar(Router $router) {
        // Proteger ruta
        // session_start();
        // isAdmin();
        
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if(!$id) {
            header('Location: /admin/medicos');
            exit;
        }
        
        // Obtener médico de la BD
        $medico = Medico::find($id);
        
        if(!$medico) {
            header('Location: /admin/medicos');
            exit;
        }
        
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Guardar valores anteriores
            $passwordAnterior = $medico->password_hash;
            $imagenAnterior = $medico->foto_perfil;
            
            // Sincronizar datos
            $medico->sincronizar($_POST);
            
            // Manejar checkboxes
            $medico->email_verificado = $_POST['email_verificado'] ?? 0;
            $medico->perfil_verificado = $_POST['perfil_verificado'] ?? 0;
            $medico->activo = $_POST['activo'] ?? 0;
            $medico->destacado = $_POST['destacado'] ?? 0;
            $medico->permite_telemedicina = $_POST['permite_telemedicina'] ?? 0;
            
            // Validar
            $alertas = $medico->validar();
            
            if(empty($alertas)) {
                
                // Manejar password
                if($_POST['password']) {
                    $medico->hashPassword();
                } else {
                    // Mantener password anterior
                    $medico->password_hash = $passwordAnterior;
                }
                
                // Manejo de imagen
                $imageHandler = new ImageHandler('medicos');
                
                if($_FILES['foto_perfil']['tmp_name']) {
                    $resultadoImagen = $imageHandler->subirImagen($_FILES['foto_perfil']);
                    
                    if($resultadoImagen['resultado']) {
                        // Eliminar imagen anterior si existe
                        if($imagenAnterior) {
                            $imageHandler->eliminarImagen($imagenAnterior);
                        }
                        
                        $medico->foto_perfil = $resultadoImagen['nombreArchivo'];
                    } else {
                        $alertas['error'][] = $resultadoImagen['error'];
                        // Mantener imagen anterior
                        $medico->foto_perfil = $imagenAnterior;
                    }
                } else {
                    // Mantener imagen anterior si no se subió nueva
                    $medico->foto_perfil = $imagenAnterior;
                }
                
                // Actualizar en BD si no hay errores
                if(empty($alertas)) {
                    $resultado = $medico->guardar();
                    
                    if($resultado) {
                        header('Location: /admin/medicos?resultado=2');
                        exit;
                    }
                }
            }
        }
        
        $router->render('medicos/actualizar', [
            'medico' => $medico,
            'alertas' => $alertas
        ]);
    }
    
    /**
     * Eliminar médico
     */
    public static function eliminar() {
        // Proteger ruta
        // session_start();
        // isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id) {
                // Obtener médico
                $medico = Medico::find($id);
                
                if($medico) {
                    // Eliminar imagen si existe
                    if($medico->foto_perfil) {
                        $imageHandler = new ImageHandler('medicos');
                        $imageHandler->eliminarImagen($medico->foto_perfil);
                    }
                    
                    // Eliminar de BD
                    $resultado = $medico->eliminar();
                    
                    if($resultado) {
                        header('Location: /admin/medicos?resultado=3');
                        exit;
                    }
                }
            }
        }
        
        // Redireccionar si algo salió mal
        header('Location: /admin/medicos');
        exit;
    }
}
