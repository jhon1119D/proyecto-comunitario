<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;

use MVC\Router;


$router = new Router();

// ------------------------------ LOGIN
$router->get('/', [LoginController::class, 'paginaPrincipal']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
// ------------------------------ LOGIN

$router->post('/registrar_usuario', [LoginController::class, 'usuario']);
$router->get('/registrar_usuario', [LoginController::class, 'usuario']);

//----------------CERRAR SESIÓN-------------------------------------
$router->get('/logout', [LoginController::class, 'logout']);
//----------------CERRAR SESIÓN-------------------------------------


// -------------------------Cambiar contraseña--------
$router->get('/actualizar', [LoginController::class, 'actualizarLogin']);
$router->post('/actualizar', [LoginController::class, 'actualizarLogin']);
// -------------------------Cambiar contraseña--------


// ------------------------------ PAGINA PRINCIPAL LUEGO DE INICIAR SESSION
$router->get('/Revistas', [LoginController::class, 'Revistas']);
// ------------------------------ PAGINA PRINCIPAL LUEGO DE INICIAR SESSION




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
