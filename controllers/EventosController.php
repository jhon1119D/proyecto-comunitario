<?php

namespace Controllers;

use Model\Evento;
use Model\Usuario;
use MVC\Router;

class EventosController
{
    // -----------------------------EVENTOS---------------------
    public static function Eventos(Router $router)
    {
        session_start();
        RevisarSesion();

        $alertas = [];
        $datos = Evento::all();
        //MENSAJE DE EXITO
        if (isset($_SESSION['mensaje_exito'])) {
            Evento::setAlerta('exito', $_SESSION['mensaje_exito']);
            unset($_SESSION['mensaje_exito']);
        }

        //cambiar el formato de fechas para guardar concordancia con el formulario.
        foreach ($datos as $fechas) {
            $fechas->convertirFecha();
        }

        //crear los usuarios en la base de datos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['usuario_id'] = $_SESSION['id'];



            $eventos = new Evento($_POST);
            $alertas = $eventos->validarEventos();


            if (empty($alertas)) {

                if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
                    $tipoArchivo = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
                    $tiposPermitidos = ['doc', 'docx', 'tex', 'zip', 'cls', 'bib', 'txt']; // Agrega los tipos permitidos

                    if (in_array($tipoArchivo, $tiposPermitidos)) {
                        $documento = Evento::guardarArchivo($_FILES['archivo']);
                        if ($documento) {
                            $_POST['documento_url'] = $documento;
                            $eventos->documento_url = $documento;
                        } else {
                            Evento::setAlerta('error', 'Error al subir el documento');
                        }
                    } else {
                        Evento::setAlerta('error', 'Tipo de archivo no permitido');
                    }
                }


                if (empty(Evento::getAlertas())) { //SI ALERTAS ESTA VACIO
                    $eventos->crear();
                    $_SESSION['mensaje_exito'] = 'Registro guardado con éxito';
                    header('Location: /Eventos');
                    exit;
                }
            }
        }


        $alertas = Evento::getAlertas();
        $router->render('admin/Eventos', [
            'nombreUsuario' => $_SESSION['nombre'],
            'alertas' => $alertas,
            'eventos' => $eventos,
            'datos' => $datos
        ]);
    }
    // -----------------------------EVENTOS---------------------


    // -----------------------------ELIMINAR---------------------
    public static function eliminar()
    {

        // Iniciar la sesión y verificar la autenticación
        session_start();
        RevisarSesion();

        $id = $_GET['id'];
        $evento = Evento::find($id);

        if ($evento) {
            Evento::eliminarArchivo($evento->documento_url);
        }
        $evento->eliminar();
        // $_SESSION['mensaje_exito'] = 'La revista  se elimino correctamente';


        header('Location: /Eventos');
        exit;
    }
    // -----------------------------ELIMINAR---------------------


    // -----------------------------EDITAR---------------------**
    public static function editar(Router $router)
    {
        // Iniciar la sesión y verificar la autenticación
        session_start();
        RevisarSesion();

        $alertas = [];
        $id = $_GET['id'];
        $eventos = Evento::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventos->sincronizar($_POST);

            // Obtener el id del usuario basado en su correo electrónico
            $correo_especifico = 'lenciso@utpl.edu.ec'; // reemplaza con el correo deseado
            $usuario = Usuario::where('email', $correo_especifico);
            if ($usuario) {
                $eventos->usuario_id = $usuario->id;
            } else {
                // Manejar el caso donde no se encuentra el usuario
                $eventos->usuario_id = NULL; // o cualquier otro manejo que desees
            }

            $alertas = $eventos->validarEventos();

            if (empty($alertas)) {
                // Eliminar el archivo existente si se sube un nuevo archivo
                if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
                    $nombre_archivo_subido = basename($_FILES['archivo']['name']);

                    if ($eventos->documento_url != $nombre_archivo_subido) {
                        Evento::eliminarArchivo($eventos->documento_url);
                    }
                    // Guardamos el archivo nuevo
                    $nuevo_documento = Evento::guardarArchivo($_FILES['archivo']);
                    // Si el archivo se guardó bien
                    if ($nuevo_documento) {
                        $_POST['documento_url'] = $nuevo_documento;
                        $eventos->documento_url = $nuevo_documento;
                    } else {
                        evento::setAlerta('error', 'Error al subir el documento');
                    }
                }
                if (empty($alertas)) { // SI ALERTAS ESTA VACIO
                    $eventos->guardar();
                    $_SESSION['mensaje_exito'] = 'El evento se actualizó correctamente';
                    header('Location: /Eventos');
                    exit;
                }
            }
        }
        $alertas = Evento::getAlertas();
        $router->render('admin/EditarEvento', [
            'eventos' => $eventos,
            'alertas' => $alertas
        ]);
    }
    // -----------------------------EDITAR---------------------











































































    // -----------------------------BUSCAR---------------------FUNCIÓN PRIVADA DEL CONTROLADOR
    public static function buscar()
    {
        $datos = Evento::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['reset'])) {
                $datos = Evento::all();
                Evento::setAlerta('buscar', 'Lista completa de eventos.');
                //ordenar las fechas 
                foreach ($datos as $fechas) {
                    $fechas->convertirFecha();
                }
            } else {
                // Obtener los términos de búsqueda
                $titulo = $_POST['titulo'] ?? '';
                $acronimo = $_POST['acronimo'] ?? '';
                $ranking = $_POST['ranking'] ?? '';
                $fecha = $_POST['fecha'] ?? '';
                // Verificar si se han proporcionado datos para la búsqueda
                if (empty($titulo) && empty($acronimo) && empty($ranking) && empty($fecha)) {
                    Evento::setAlerta('buscar', 'Por favor, ingrese al menos un criterio de búsqueda.');
                } else {
                    // Llamar al método del modelo para buscar revistas 
                    $datos = Evento::buscarEventos($titulo, $acronimo, $ranking, $fecha);

                    if (empty($datos)) {
                        Evento::setAlerta('error', 'No se encontraron resultados para la búsqueda.');
                    } else {
                        evento::setAlerta('exito', 'Búsqueda realizada con éxito.');
                    }
                }
            }
        }
        return $datos ?? [];
    }
    // -----------------------------BUSCAR---------------------FUNCIÓN PRIVADA DEL CONTROLADOR

    // -----------------------------BUSCAR---------------------FUNCIÓN PARA EL ADMIN
    public static function buscarAdmin(Router $router)
    {
        session_start();
        RevisarSesion();
        // Verificar si el usuario está autenticado 
        $datos = self::buscar();
        $alertas = Evento::getAlertas();
        $router->render('admin/Eventos', [
            'datos' => $datos,
            'alertas' => $alertas
        ]);
    }
    // -----------------------------BUSCAR---------------------FUNCIÓN PARA EL ADMIN

    // -----------------------------BUSCAR---------------------FUNCIÓN PARA USUARIOS
    public static function buscarPublico(Router $router)
    {
        $datos = self::buscar();
        $alertas = Evento::getAlertas();
        $router->render('principal/mainEventos', [
            'datos' => $datos,
            'alertas' => $alertas
        ]);
    }
    // -----------------------------BUSCAR---------------------FUNCIÓN PARA USUARIOS
}
