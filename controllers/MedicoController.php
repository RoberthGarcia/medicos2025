<?php 

namespace Controllers;

use MVC\Router;
use Model\Medico;


class MedicoController{    

    public static function index(Router $router){       

            $resultado = $_GET['resultado'] ?? null;
            $medicos = Medico::all();

        $router->render('medicos/admin',[
            'resultado' => $resultado,
            'medicos' => $medicos
        ]);
    }

    public static function crear(Router $router){


        $router->render('medicos/crear',[

        ]);

    }



}