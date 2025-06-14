<?php

namespace Model;



class Usuario extends ActiveRecord
{

    //aqui usamos activerecords 
    // base de datos

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'contrasena', 'apellido', 'telefono',  'admin'];

    public $id;
    public $nombre;
    public $email;
    public $contrasena;
    public $apellido;
    public $telefono;
    public $admin;



    public  function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->contrasena = $args['contrasena'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '';
    }


    //MENSAJES DE VALIDACION PARA VALIDAR EL LOGIN
    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'Ingrese un correo correcto';
        }

        if (!$this->contrasena) {
            self::$alertas['error'][] = 'Ingrese una contraseña';
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
        $query = "SELECT * FROM " . self::$tabla . " WHERE email= '" . $this->email . "'LIMIT 1";

        $resultado = self::$db->query($query);


        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya esta registrado';
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
        $usuario = self::buscarPorEmail($antiguoCorreo);
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






    // Función para cuando se olvida de la contraseña
    public static function olvide($nombreUsuario, $emailUsuario, $telefonoUsuario, $nuevaContrasena)
    {
        $usuario = self::buscarPorEmail($emailUsuario);

        if ($usuario) {
            // Asegurarse de que los valores sean exactamente iguales
            if (trim($usuario->nombre) === trim($nombreUsuario) && trim($usuario->telefono) === trim($telefonoUsuario)) {

                // Validación de la longitud de la nueva contraseña 
                if (strlen($nuevaContrasena) < 4) {
                    self::$alertas['error'][] = 'La nueva contraseña debe tener al menos 4 caracteres.';
                    return;
                }
                $usuario->contrasena = $nuevaContrasena;
                $usuario->hashPassword();
                $usuario->actualizar();

                self::$alertas['exito'][] = '¡Actualización exitosa! Las nuevas credenciales han sido guardadas.';
            } else {
                self::$alertas['error'][] = 'Nombre o código de verificación incorrecto. Por favor, inténtelo de nuevo.';
            }
        } else {
            self::$alertas['error'][] = 'No se encontró un usuario con ese correo electrónico.';
        }
    }
    //Función para cuando se olvida dela contraseña



    public static function buscarPorEmail($email)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . self::$db->escape_string($email) . "' LIMIT 1";
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

        if (!$this->apellido) {
            self::$alertas['error'][] = 'Ingrese un apellido';
        }

        if (!$this->telefono) {
            self::$alertas['error'][] = 'Ingrese un teléfono';
        } elseif (!preg_match('/^[0-9]{7,12}$/', $this->telefono)) {
            self::$alertas['error'][] = 'El teléfono que ingresó no es válido. Debe contener entre 7 y 12 dígitos.';
        }





        return self::$alertas;
    }
    //MENSAJES DE VALIDACION PARA VALIDAR EL REGISTRO







}
