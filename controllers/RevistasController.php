<?php

namespace Controllers;

use Model\Revista;
use Model\Usuario;
use MVC\Router;

class RevistasController
{
    // -----------------------------REVISTAS---------------------
    public static function Revistas(Router $router)
    {
        session_start();
        RevisarSesion();

        $alertas = [];
        $datos = Revista::all();


        //MENSAJE DE EXITO
        if (isset($_SESSION['mensaje_exito'])) {
            Revista::setAlerta('exito', $_SESSION['mensaje_exito']);
            unset($_SESSION['mensaje_exito']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['usuario_id'] = $_SESSION['id'];

            $revistas = new Revista($_POST);
            $alertas = $revistas->validarRevistas();


            if (empty($alertas)) {

                if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
                    $tipoArchivo = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
                    $tiposPermitidos = ['doc', 'docx', 'tex', 'zip', 'cls', 'bib', 'txt', 'pdf'];


                    if (in_array($tipoArchivo, $tiposPermitidos)) {

                        $documento = Revista::guardarArchivo($_FILES['archivo']);
                        if ($documento) {
                            $_POST['documento_url'] = $documento;
                            $revistas->documento_url = $documento;
                        } else {
                            Revista::setAlerta('error', 'Error al subir el documento');
                        }
                    } else {
                        Revista::setAlerta('error', 'Tipo de archivo no permitido');
                    }
                }

                if (empty(Revista::getAlertas())) {
                    $revistas->crear();
                    $_SESSION['mensaje_exito'] = 'Registro guardado con éxito';
                    header('Location: /Revistas');
                    exit;
                }
            }
        }

        $alertas = Revista::getAlertas();
        $router->render('admin/Revistas', [
            'nombreUsuario' => $_SESSION['nombre'],
            'alertas' => $alertas,
            'revistas' => $revistas,
            'datos' => $datos
        ]);
    }
    // -----------------------------REVISTAS---------------------



    // -----------------------------ELIMINAR---------------------
    public static function eliminar()
    {
        // Iniciar la sesión y verificar la autenticación
        session_start();
        RevisarSesion();

        $id = $_GET['id'];
        $revista = Revista::find($id);



        if ($revista) {
            Revista::eliminarArchivo($revista->documento_url);
        }

        $revista->eliminar();
        // $_SESSION['mensaje_exito'] = 'La revista  se elimino correctamente';


        // Redirigir al listado de revistas después de la eliminación
        header('Location: /Revistas');
        exit();
    }
    // -----------------------------ELIMINAR---------------------


    // -----------------------------EDITAR---------------------
    public static function editar(Router $router)
    {

        // Iniciar la sesión y verificar la autenticación
        session_start();
        RevisarSesion();

        $alertas = [];
        $id = $_GET['id'];
        $revistas = Revista::find($id);



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $revistas->sincronizar($_POST);

            // Obtener el id del usuario basado en su correo electrónico
            $correo_especifico = 'lenciso@utpl.edu.ec'; // reemplaza con el correo deseado
            $usuario = Usuario::where('email', $correo_especifico);
            if ($usuario) {
                $revistas->usuario_id = $usuario->id;
            } else {
                // Manejar el caso donde no se encuentra el usuario
                $revistas->usuario_id = NULL; // o cualquier otro manejo que desees
            }
            $alertas = $revistas->validarRevistas();

            if (empty($alertas)) {
                // Eliminar el archivo existente si se sube un nuevo archivo
                if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {

                    $nombre_archivo_subido = basename($_FILES['archivo']['name']);

                    if ($revistas->documento_url != $nombre_archivo_subido) {
                        Revista::eliminarArchivo($revistas->documento_url);
                    }
                    // Guardamos el archivo nuevo
                    $nuevo_documento = Revista::guardarArchivo($_FILES['archivo']);
                    // Si el archivo se guardó bien
                    if ($nuevo_documento) {
                        $_POST['documento_url'] = $nuevo_documento;
                        $revistas->documento_url = $nuevo_documento;
                    } else {
                        Revista::setAlerta('error', 'Error al subir el documento');
                    }
                }



                if (empty($alertas)) { // SI ALERTAS ESTÁ VACÍO
                    $revistas->guardar();
                    $_SESSION['mensaje_exito'] = 'La revista  se actualizo correctamente';
                    header('Location: /Revistas');
                    exit; // Asegúrate de detener la ejecución después de redirigir
                }
            }
        }
        $alertas = Revista::getAlertas();
        $router->render('admin/Editar', [
            'revistas' => $revistas,
            'alertas' => $alertas
        ]);
    }
    // -----------------------------EDITAR---------------------



    // -----------------------------BUSCAR---------------------FUNCIÓN PRIVADA DEL CONTROLADOR
    public static function buscar()
    {
        $datos = Revista::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['reset'])) {
                $datos = Revista::all();
                Revista::setAlerta('buscar', 'Lista completa de revistas.');
            } else {
                // Obtener los términos de búsqueda
                $nombre = $_POST['nombre'] ?? '';
                $categoria = $_POST['categoria'] ?? '';
                $accesibilidad = $_POST['accesibilidad'] ?? '';
                $pais = $_POST['pais'] ?? '';
                $tipo_revista = $_POST['tipo_revista'] ?? '';

                // Verificar si se han proporcionado datos para la búsqueda
                if (empty($nombre) && empty($categoria) && empty($accesibilidad) && empty($pais) && empty($tipo_revista)) {
                    Revista::setAlerta('buscar', 'Por favor, ingrese al menos un criterio de búsqueda.');
                } else {
                    // Llamar al método del modelo para buscar revistas 
                    $datos = Revista::buscarRevistas($nombre, $categoria, $accesibilidad, $pais, $tipo_revista);

                    if (empty($datos)) {
                        Revista::setAlerta('error', 'No se encontraron resultados para la búsqueda.');
                    } else {
                        Revista::setAlerta('exito', 'Búsqueda realizada con éxito.');
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
        $alertas = Revista::getAlertas();
        $router->render('admin/Revistas', [
            'datos' => $datos,
            'alertas' => $alertas
        ]);
    }
    // -----------------------------BUSCAR---------------------FUNCIÓN PARA EL ADMIN


    // -----------------------------BUSCAR---------------------FUNCIÓN PARA USUARIOS
    public static function buscarPublico(Router $router)
    {

        // Verificar si el usuario está autenticado 
        $datos = self::buscar();
        $alertas = Revista::getAlertas();
        $router->render('principal/mainRevistas', [
            'datos' => $datos,
            'alertas' => $alertas
        ]);
    }
    // -----------------------------BUSCAR---------------------FUNCIÓN PARA USUARIOS


}
