<?php

namespace Controllers;

use Model\Usuario;
use Model\Codigo;
use MVC\Router;



class LoginController
{
    //INICIO CONTROLADOR PARA INGRESAR AL SISTEMA "LOGIN"
    public static function login(Router $router)
    {
        $alertas = [];
        $auth = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



            $auth = new Usuario($_POST);



            $alertas = $auth->validarLogin();

            if (empty($alertas)) { //SI ALERTAS ESTA VACIO

                //comprobar que exista el nombre del usuario LE PUSE ASI PORQUE NOSE PORQUE SE GUARDAN LOS NOMBRES CON UN ESPACIO EN LA BD
                $usuario = Usuario::where('nombre', $auth->nombre);


                if ($usuario) {
                    //Si es false devuelve la alerta USUARIO NO EXISTE
                    //verificar el password
                    if ($usuario->comprobarContraseña($auth->contrasena)) {

                        //autenticar usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['login'] = true;

                        //redireccionamiento dependiendo si es cliente o admin
                        if ($usuario->admin === '1') {
                            header('Location: /Revistas');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe. Por favor, verifique e intente nuevamente.');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/Login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }
    //FIN CONTROLADOR PARA INGRESAR AL SISTEMA "LOGIN"

    // FUNCIÓN PARA CAMBIAR LA CONTRASEÑA
    public static function actualizarLogin(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $antiguaContraseña = $_POST['antiguaContraseña'];
            $nuevaContraseña = $_POST['nuevaContraseña'];
            Usuario::actualizarUsuario($nombre, $antiguaContraseña, $nuevaContraseña);


            $alertas = Usuario::getAlertas();
            $router->render('auth/Login', [
                'alertas' => $alertas
            ]);
        } else {
            $alertas = Usuario::getAlertas();
            $router->render('auth/Login', [
                'alertas' => $alertas
            ]);
        }
    }
    // FUNCIÓN PARA CAMBIAR LA CONTRASEÑA




    // FUNCIÓN PARA ACTUALIZAR USUARIO

    // Método para crear usuarios 
    public static function usuario(Router $router)
    {
        $crearUsuario = new Usuario; // Crear la instancia de Usuario fuera del if


        // Alertas vacías
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

           
            $crearUsuario->sincronizar($_POST);


           

            // Validar todos los campos del formulario
            $alertas = $crearUsuario->validarRegistro();
            if (empty($alertas)) { // Si alertas está vacío
               
                $crearUsuario->existeUsuario();

                $alertas = Usuario::getAlertas();

                if (empty($alertas)) {


                    $crearUsuario->hashPassword();

                    // Establecer el valor de admin a true para el nuevo usuario
                    $crearUsuario->admin = true;
                    

                    // Guardar el usuario en la base de datos
                    $resultado = $crearUsuario->guardar();

                    if ($resultado) {
                        // Añadir mensaje de éxito a las alertas
                        $alertas['exito'][] = 'Alumno validado correctamente';
                        // Crear una nueva instancia para restablecer el formulario
                        $crearUsuario = new Usuario;
                    } else {
                        $alertas['error'][] = 'Error al validar alumno';
                    }
                }
            }
        }

        $router->render('auth/Usuarios', [
            'alertas' => $alertas,
            'crearUsuario' => $crearUsuario
        ]);
    }
  


    //----------------CERRAR SESIÓN------------------------
    public static function logout()
    {
        // Verificar si la sesión ya está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();

            // Destruir la sesión 
            session_destroy();
            // Redirigir al usuario a la página de inicio de sesión 
            header('Location: /');
            exit();
        }
    }
    //----------------CERRAR SESIÓN------------------------


    //------------Página de inicio 
    public static function paginaPrincipal(Router $router)
    {

        $router->render('auth/Principal', []);
    }
    //------------Página de inicio 



    public static function Revistas(Router $router)
    {

        $router->render('admin/Revistas', []);
    }
}
