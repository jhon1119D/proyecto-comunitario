<?php

namespace Controllers;

use Model\Usuario;
use Model\Revista;
use Model\Evento;
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

                //comprobar que exista el correo del usuario
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    //Si es false devuelve la alerta USUARIO NO EXISTE
                    //verificar el password
                    if ($usuario->comprobarContraseña($auth->contrasena)) {

                        //autenticar usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
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

    // FUNCIÓN PARA CAMBIAR LA CONTRASEÑA DE LOS USUARIOS
    public static function actualizarLogin(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Correo = $_POST['Correo'];
            $antiguaContraseña = $_POST['antiguaContraseña'];
            $nuevaContraseña = $_POST['nuevaContraseña'];
            Usuario::actualizarUsuario($Correo, $antiguaContraseña, $nuevaContraseña);


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
    // FUNCIÓN PARA CAMBIAR LA CONTRASEÑA DE LOS USUARIOS



    // FUNCIÓN PARA RECUPERAR CONTRASEÑA
    public static function olvideContraseña(Router $router)
    {
        $nombreUsuario = '';
        $emailUsuario = '';
        $telefonoUsuario = '';
        $nuevaContraseña = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreUsuario = $_POST['nombreUsuario'];
            $emailUsuario = $_POST['emailUsuario'];
            $telefonoUsuario = $_POST['telefonoUsuario']; // Código ingresado por el usuario
            $nuevaContraseña = $_POST['nuevaContraseña'];

            Usuario::olvide($nombreUsuario, $emailUsuario, $telefonoUsuario, $nuevaContraseña);
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/Olvide', [
            'alertas' => $alertas,
            'nombreUsuario' => $nombreUsuario,
            'emailUsuario' => $emailUsuario,
            'telefonoUsuario' => $telefonoUsuario,
            'nuevaContraseña' => $nuevaContraseña
        ]);
    }
    // FUNCIÓN PARA ACTUALIZAR USUARIO


    //---Página de tabla usuarios 
    public static function paginaAdministrador(Router $router)
    {

        $administradores = Usuario::all();

        $router->render('auth/EditarUsuarios', [

            'administradores' => $administradores
        ]);
    }
    //------------Página de tabla usuarios


    // Método para crear administradores
    public static function usuario(Router $router)
    {
        $crearUsuario = new Usuario; // Crear la instancia de Usuario fuera del if
        // Alertas vacías
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $crearUsuario->sincronizar($_POST);

            // Validar todos los campos del formulario
            $alertas = $crearUsuario->validarRegistro();
            $codigo = $_POST['codigo'];


            if (empty($alertas) && Codigo::compararCodigo($codigo)) { // Si alertas está vacío


                $resultado = $crearUsuario->existeUsuario();


                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear contraseña
                    $crearUsuario->hashPassword();

                    // Establecer el valor de admin a true para el nuevo usuario
                    $crearUsuario->admin = true;

                    // Guardar el usuario en la base de datos
                    $resultado = $crearUsuario->guardar();

                    if ($resultado) {
                        // Añadir mensaje de éxito a las alertas
                        $alertas['exito'][] = 'Registro guardado exitosamente';
                        // Crear una nueva instancia para restablecer el formulario
                        $crearUsuario = new Usuario;
                    } else {
                        $alertas['error'][] = 'Error al guardar el registro';
                    }
                }
            } else {
                $alertas['error'][] = 'Ingrese el código correcto si no lo tiene solicitelo!';
            }
        }

        $router->render('auth/Usuarios', [
            'alertas' => $alertas,
            'crearUsuario' => $crearUsuario
        ]);
    }
    // Método para crear administradores


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


    //------------Eliminar usuarios 
    public static function eliminar(Router $router)
    {
        // Iniciar la sesión y verificar la autenticación
        session_start();
        RevisarSesion();


        // Alertas vacías
        $alertas = [];


        $id = $_GET['id'];
        $registro = Usuario::find($id);

        if ($registro) {
            // Actualizar los registros relacionados en la tabla `revistas`
            $revistas = Revista::w('usuario_id', $id);
            foreach ($revistas as $revista) {
                $revista->usuario_id = null;
                $revista->a();
            }

            // // Actualizar los registros relacionados en la tabla `eventos`
            $eventos = Evento::w('usuario_id', $id);
            foreach ($eventos as $evento) {
                $evento->usuario_id = null;
                $evento->a();
            }
            // Eliminar el usuario
            $registro->eliminar();
            $_SESSION['mensaje_delete_user'] = 'El usuario administrador se eliminó correctamente';
        }
        // Redirigir al listado de usuarios después de la eliminación
        header('Location: /paginaAdministrador');
        exit();


        $alertas = Usuario::getAlertas();

        $router->render('auth/EditarUsuarios', [
            'alertas' => $alertas,
            'registro' => $registro

        ]);
    }
    //------------Eliminar usuarios 








}
