<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\LoginController;
use Controllers\MedicosController;
use Controllers\RegistroMedicoController;

$router = new Router();

// ====================================
// RUTAS DE USUARIOS (PACIENTES)
// ====================================

// Iniciar Sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// ====================================
// RUTAS PÚBLICAS DE MÉDICOS
// ====================================

// Registro de Médicos (público)
$router->get('/medicos/registro', [RegistroMedicoController::class, 'registro']);
$router->post('/medicos/registro', [RegistroMedicoController::class, 'registro']);

// Confirmar cuenta de médico
$router->get('/medicos/confirmar', [RegistroMedicoController::class, 'confirmar']);
$router->get('/medicos/mensaje', [RegistroMedicoController::class, 'mensaje']);

// Login de Médicos
$router->get('/medicos/login', [RegistroMedicoController::class, 'login']);
$router->post('/medicos/login', [RegistroMedicoController::class, 'login']);
$router->get('/medicos/logout', [RegistroMedicoController::class, 'logout']);

// Recuperar Password de Médicos
$router->get('/medicos/olvide', [RegistroMedicoController::class, 'olvide']);
$router->post('/medicos/olvide', [RegistroMedicoController::class, 'olvide']);
$router->get('/medicos/recuperar', [RegistroMedicoController::class, 'recuperar']);
$router->post('/medicos/recuperar', [RegistroMedicoController::class, 'recuperar']);

// ====================================
// ÁREA PRIVADA - ADMINISTRADOR
// ====================================

// CRUD de Médicos
$router->get('/medicos/admin', [MedicosController::class, 'index']);
$router->get('/medicos/crear', [MedicosController::class, 'crear']);
$router->post('/medicos/crear', [MedicosController::class, 'crear']);
$router->get('/medicos/actualizar', [MedicosController::class, 'actualizar']);
$router->post('/medicos/actualizar', [MedicosController::class, 'actualizar']);
$router->post('/medicos/eliminar', [MedicosController::class, 'eliminar']);

// Sistema de Aprobación de Médicos
$router->get('/medicos/pendientes', [MedicosController::class, 'pendientes']);
$router->post('/medicos/aprobar', [MedicosController::class, 'aprobar']);
$router->post('/medicos/rechazar', [MedicosController::class, 'rechazar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
