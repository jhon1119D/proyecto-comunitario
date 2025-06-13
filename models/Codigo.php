<?php

namespace Model;

class Codigo extends ActiveRecord
{
    protected static $tabla = 'codigos';
    protected static $columnasDB = ['id', 'codigo'];

    public $id;
    public $codigo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->codigo = $args['codigo'] ?? '';
    }

    // Función para actualizar el código
    public static function actualizarCodigo($nuevoCodigo)
    {
        $codigo = self::find(1); // Asumiendo que el código está en el primer registro

        if ($codigo) {
            $codigo->codigo = $nuevoCodigo;
            $codigo->guardar();
         
        } else {
            $codigo = new self(['codigo' => $nuevoCodigo]);
            $codigo->guardar();
            
        }

        return $nuevoCodigo;
      
        
    }

    // Función para obtener el código actual
    public static function obtenerCodigo()
    {
        $codigo = self::find(1); // Asumiendo que el código está en el primer registro
        return $codigo ? $codigo->codigo : null;
    }

    // Función para comparar el código ingresado con el código almacenado
    public static function compararCodigo($codigoIngresado)
    {
        $codigoActual = self::obtenerCodigo();
        return $codigoActual === $codigoIngresado;
    }
}
