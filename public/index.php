<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\RevistasController;
use Controllers\LoginController;
use Controllers\EventosController;
use Controllers\CodigoController;
use MVC\Router;


$router = new Router();

// ------------------------------ LOGIN
$router->get('/', [LoginController::class, 'paginaPrincipal']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
// ------------------------------ LOGIN

//----------------CERRAR SESIÓN-------------------------------------
$router->get('/logout', [LoginController::class, 'logout']);
//----------------CERRAR SESIÓN-------------------------------------


// -------------------------REGISTRO DE USUARIOS Y ACTUALIZACION DE CODIGO PARA REGISTRO--------
$router->post('/actualizar_codigo', [CodigoController::class, 'actualizarCodigoSecreto']);
$router->get('/actualizar_codigo', [CodigoController::class, 'actualizarCodigoSecreto']);
$router->post('/registrar_usuario', [LoginController::class, 'usuario']);
$router->get('/registrar_usuario', [LoginController::class, 'usuario']);
// -------------------------REGISTRO DE USUARIOS Y ACTUALIZACION DE CODIGO PARA REGISTRO--------


// -------------------------Cambiar contraseña administradores--------
$router->get('/actualizar', [LoginController::class, 'actualizarLogin']);
$router->post('/actualizar', [LoginController::class, 'actualizarLogin']);
// -------------------------Cambiar contraseña administradores--------

// -------------------------Cambiar contraseña administradores--------
$router->get('/olvide', [LoginController::class, 'olvideContraseña']);
$router->post('/olvide', [LoginController::class, 'olvideContraseña']);
// -------------------------Cambiar contraseña administradores--------


// -------------------------Eliminar usuario administrador------------
$router->get('/eliminarUsuario', [LoginController::class, 'eliminar']);
// -------------------------Eliminar usuario administrador------------

//pagina de el administrador de usuarios
$router->get('/paginaAdministrador', [LoginController::class, 'paginaAdministrador']);
//pagina de el administrador de usuarios


//--------------------------------------------------------------------------------------------------------------------
//PARTE DE EVENTOS Y REVISTAS ****************************************************************************************
//--------------------------------------------------------------------------------------------------------------------



// ------------------------------ EVENTOS
$router->get('/Eventos', [EventosController::class, 'Eventos']);
$router->post('/Eventos', [EventosController::class, 'Eventos']);
// ------------------------------ EVENTOS


// ------------------------------ REVISTAS
$router->get('/Revistas', [RevistasController::class, 'Revistas']);
$router->post('/Revistas', [RevistasController::class, 'Revistas']);
// ------------------------------ REVISTAS


// ------------------------------ELIMINAR EVENTOS Y REVISTAS
$router->get('/eliminar', [RevistasController::class, 'eliminar']);
$router->get('/eliminar_evento', [EventosController::class, 'eliminar']);
// ------------------------------ELIMINAR EVENTOS Y REVISTAS

// --------------------------------EDITAR REVISTAS
$router->get('/editar', [RevistasController::class, 'editar']);
$router->post('/editar', [RevistasController::class, 'editar']);
// ----------------------------EDITAR REVISTAS


// --------------------------EDITAR EVENTOS
$router->get('/editar_evento', [EventosController::class, 'editar']);
$router->post('/editar_evento', [EventosController::class, 'editar']);
// ----------------------------EDITAR EVENTOS


// BUSCAR REVISTAS EN EL ADMINISTRADOR Y PUBLICO
$router->get('/buscar_revistas_admin', [RevistasController::class, 'buscarAdmin']);
$router->post('/buscar_revistas_admin', [RevistasController::class, 'buscarAdmin']);
//----------------------------------------------------------------------------------
$router->get('/buscar_revistas_publico', [RevistasController::class, 'buscarPublico']);
$router->post('/buscar_revistas_publico', [RevistasController::class, 'buscarPublico']);
// BUSCAR REVISTAS EN EL ADMINISTRADOR Y PUBLICO

// BUSCAR EVENTOS EN EL ADMINISTRADOR Y PUBLICO
$router->get('/buscar_eventos_admin', [EventosController::class, 'buscarAdmin']);
$router->post('/buscar_eventos_admin', [EventosController::class, 'buscarAdmin']);
//---------------------------------------------------------------------------------
$router->get('/buscar_eventos_publico', [EventosController::class, 'buscarPublico']);
$router->post('/buscar_eventos_publico', [eventosController::class, 'buscarPublico']);
// BUSCAR EVENTOS EN EL ADMINISTRADOR Y PUBLICO








// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
