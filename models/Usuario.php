<?php

namespace Model;



class Usuario extends ActiveRecord
{

    //aqui usamos activerecords 
    // base de datos

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'contrasena', 'admin'];

    public $id;
    public $nombre;
    public $contrasena;
    public $admin;



    public  function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->contrasena = $args['contrasena'] ?? '';
        $this->admin = $args['admin'] ?? '';
    }


    //MENSAJES DE VALIDACION PARA VALIDAR EL LOGIN
    public function validarLogin()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Ingrese el nombre de usuario';
        }

        if (!$this->contrasena) {
            self::$alertas['error'][] = 'Ingrese la contraseña';
        }
        return self::$alertas;
    }
    //MENSAJES DE VALIDACION PARA VALIDAR EL LOGIN


    //FUNCIÓN PARA HASHEAR UNA CONTRASEÑA
    public function hashPassword()
    {
        // $this->contrasena = password_hash($this->contrasena, PASSWORD_BCRYPT);
        $this->contrasena = $this->contrasena;
    }
    //FUNCIÓN PARA HASHEAR UNA CONTRASEÑA



    //INICIO FUNCION QUE VERIFICA SI UN USUARIO EXISTE EN LA BASE DE DATOS
    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE nombre = '" . $this->nombre . "' LIMIT 1";


        $resultado = self::$db->query($query);


        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'Error al validar alumno';
        }
        return $resultado;
    }
    //FIN FUNCION QUE VERIFICA SI UN USUARIO EXISTE EN UNA BASE DE DATOS







    //FUNCIÓN PARA COMPROBAR CONTRASEÑA
    public function comprobarContraseña($contrasena)
    {
        if ($contrasena === $this->contrasena) {
            return true; // Contraseña válida
        } else {
            self::$alertas['error'][] = 'Contraseña incorrecta';
            return false;
        }
    }

    //FUNCIÓN PARA COMPROBAR CONTRASEÑA

    //FUNCIÓN PARA ACTUALIZAR USUARIO
    public static function actualizarUsuario($antiguoCorreo, $antiguaContraseña,  $nuevaContraseña)
    {

        // $usuario = self::buscarPorNombre($antiguoCorreo);
        $usuario = self::buscarPorNombre($antiguoCorreo);
        if ($usuario && $usuario->comprobarContraseña($antiguaContraseña)) {
            // Validación de la longitud de la nueva contraseña 
            if (strlen($nuevaContraseña) < 4) {
                self::$alertas['error'][] = 'La nueva contraseña debe tener al menos 4 caracteres.';
                return;
            }
            $usuario->contrasena = $nuevaContraseña;
            $usuario->hashPassword();
            $usuario->actualizar();
            self::$alertas['exito'][] = '¡Actualización exitosa! Las nuevas credenciales han sido guardadas.';
        } else {
            self::$alertas['error'][] = 'No se pudo actualizar las credenciales. Por favor, inténtelo de nuevo.';
        }
    }
    //FUNCIÓN PARA ACTUALIZAR USUARIO


    public static function buscarPorNombre($nombre)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE nombre = '" . self::$db->escape_string($nombre) . "' LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }


    //MENSAJES DE VALIDACION PARA VALIDAR EL REGISTRO
    public function validarRegistro()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Ingrese un usuario';
        }

        if (!$this->contrasena) {
            self::$alertas['error'][] = 'Ingrese una contraseña';
        } elseif (strlen($this->contrasena) < 4) {
            self::$alertas['error'][] = 'La contraseña debe tener al menos 4 caracteres';
        }

        return self::$alertas;
    }
    //MENSAJES DE VALIDACION PARA VALIDAR EL REGISTRO

}
