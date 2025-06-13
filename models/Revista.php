<?php

namespace Model;


class Revista extends ActiveRecord
{

    //aqui usamos activerecords 
    // base de datos

    protected static $tabla = 'revistas';
    protected static $columnasDB = ['id', 'nombre', 'categoria', 'enlace', 'accesibilidad', 'pais', 'tipo_revista', 'usuario_id',  'documento_url'];

    public $id;
    public $nombre;
    public $categoria;
    public $enlace;
    public $accesibilidad;
    public $pais;
    public $tipo_revista;
    public $usuario_id;
    public $documento_url;


    public  function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->enlace = $args['enlace'] ?? '';
        $this->accesibilidad = $args['accesibilidad'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->tipo_revista = $args['tipo_revista'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->documento_url = $args['documento_url'] ?? '';
    }


    //MENSAJES DE VALIDACION PARA VALIDAR REVISTAS
    public function validarRevistas()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Por favor, ingrese el nombre de la revista.';
        }
        if (!$this->categoria) {
            self::$alertas['error'][] = 'Por favor, seleccione una categoría para la revista.';
        }
        if (!$this->enlace) {
            self::$alertas['error'][] = 'Por favor, proporcione un enlace.';
        }
        if (!$this->accesibilidad) {
            self::$alertas['error'][] = 'Verifique si el acceso es público o privado.';
        }
        if (!$this->pais) {
            self::$alertas['error'][] = 'Por favor, indique el país de origen de la revista.';
        }
        if (!$this->tipo_revista) {
            self::$alertas['error'][] = 'Por favor, especifique el área temática de la revista.';
        }
        return self::$alertas;
    }
    //MENSAJES DE VALIDACION PARA VALIDAR REVISTAS


    // -----------CONSULTAS PARA BUSQUEDA DE DATOS-------------
    public static function buscarRevistas($nombre, $categoria, $accesibilidad, $pais, $tipo_revista)
    {
        // Crear la consulta SQL
        $sql = "SELECT * FROM revistas WHERE 1=1";

        if ($nombre != '') {
            $nombre = s($nombre);  // Sanitiza la entrada de $nombre
            $sql .= " AND nombre LIKE '%$nombre%'";
        }
        if ($categoria != '') {
            $categoria = s($categoria);  // Sanitiza la entrada de $categoria
            $sql .= " AND categoria LIKE '%$categoria%'";
        }
        if ($accesibilidad != '') {
            $accesibilidad = s($accesibilidad);  // Sanitiza la entrada de $accesibilidad
            $sql .= " AND accesibilidad LIKE '%$accesibilidad%'";
        }
        if ($pais != '') {
            $pais = s($pais);  // Sanitiza la entrada de $pais
            $sql .= " AND pais LIKE '%$pais%'";
        }
        if ($tipo_revista != '') {
            $tipo_revista = s($tipo_revista);  // Sanitiza la entrada de $tipo_revista
            $sql .= " AND tipo_revista LIKE '%$tipo_revista%'";
        }

        // Ejecutar la consulta usando la función SQL
        return self::consultarSQL($sql);
    }
    // -----------CONSULTAS PARA BUSQUEDA DE DATOS-------------



    // -----------FUNCIÓN ELIMINAR -------------
    public static function eliminarArchivo($documento_url)
    {
        if (!empty($documento_url)) {
            $archivo = 'documentos/revistas/' . $documento_url;
            $archivo = trim($archivo);

            if (file_exists($archivo)) {
                return unlink($archivo);
            }
        }
        return false;
    }
    // -----------FUNCIÓN ELIMINAR-------------



    // ----------- INICIO LOGICA DE MANEJAR LA SUBIDA DE ARCHIVOS-------------
    public static function guardarArchivo($archivo)
    {
        $directorio = 'documentos/revistas';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }
        // Generar un nombre único para evitar sobreescribir archivos
        $nombre_archivo = uniqid('revista_', true) . '.' . pathinfo($archivo['name'], PATHINFO_EXTENSION);

        // Ruta completa donde se guardará el archivo
        $ruta_destino = $directorio . '/' . $nombre_archivo;

        // Mover el archivo del directorio temporal a la carpeta de destino
        if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
            return $nombre_archivo;  // Devuelve solo el nombre del archivo
        }
    }
    // ----------- FIN LOGICA DE MANEJAR LA SUBIDA DE ARCHIVOS-------------












}
