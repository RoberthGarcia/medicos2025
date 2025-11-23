<?php 

namespace Controllers;

use MVC\Router;
use Model\Medico;

class MedicoController {    

    public static function index(Router $router) {       
        session_start();
        
        // Verificar que sea administrador
        $auth = $_SESSION['admin'] ?? null;
        if(!$auth) {
            header('Location: /');
        }

        $resultado = $_GET['resultado'] ?? null;
        $medicos = Medico::all();

        $router->render('medicos/admin', [
            'resultado' => $resultado,
            'medicos' => $medicos
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        
        // Verificar que sea administrador
        $auth = $_SESSION['admin'] ?? null;
        if(!$auth) {
            header('Location: /');
        }

        $router->render('medicos/crear', []);
    }

    // Mostrar médicos pendientes de aprobación
    public static function pendientes(Router $router) {
        session_start();
        
        // Verificar que sea administrador
        $auth = $_SESSION['admin'] ?? null;
        if(!$auth) {
            header('Location: /');
        }

        $medicos_pendientes = Medico::medicosPendientes();

        $router->render('medicos/pendientes', [
            'medicos' => $medicos_pendientes
        ]);
    }

    // Aprobar perfil de médico
    public static function aprobar(Router $router) {
        session_start();
        
        // Verificar que sea administrador
        $auth = $_SESSION['admin'] ?? null;
        if(!$auth) {
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                // Buscar el médico por id_medico
                $query = "SELECT * FROM medicos WHERE id_medico = {$id}";
                $resultado = Medico::consultarSQL($query);
                $medico = array_shift($resultado);
                
                if($medico) {
                    // Aprobar el perfil
                    $medico->perfil_verificado = 1;
                    $medico->activo = 1;
                    $medico->guardar();

                    header('Location: /medicos/pendientes?resultado=1');
                }
            }
        }
    }

    // Rechazar perfil de médico
    public static function rechazar(Router $router) {
        session_start();
        
        // Verificar que sea administrador
        $auth = $_SESSION['admin'] ?? null;
        if(!$auth) {
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                // Buscar el médico por id_medico
                $query = "SELECT * FROM medicos WHERE id_medico = {$id}";
                $resultado = Medico::consultarSQL($query);
                $medico = array_shift($resultado);
                
                if($medico) {
                    // Rechazar el perfil (o eliminar)
                    $medico->perfil_verificado = 0;
                    $medico->activo = 0;
                    $medico->guardar();

                    header('Location: /medicos/pendientes?resultado=2');
                }
            }
        }
    }
}
