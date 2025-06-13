<?php

namespace Controllers;

use Model\Codigo;
use Model\usuario;
use MVC\Router;

class CodigoController
{

    // Método para actualizar el código secreto
    public static function actualizarCodigoSecreto(Router $router)
    {
        $alertas = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica para actualizar el código secreto
            $nuevoCodigo = $_POST['nuevoCodigo'];
            Codigo::actualizarCodigo($nuevoCodigo);
            $alertas['exito'][] = 'Nuevo código para registro de usuarios';
        }

        $codigo = Codigo::obtenerCodigo(); // Obtener el código actualizado
        $alertas = Codigo::getAlertas();
        $router->render('auth/Codigo-registro', [
            'alertas' => $alertas,
            'codigo' => $codigo,

        ]);
    }
}
