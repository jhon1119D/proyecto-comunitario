<?php

namespace Model;


class Evento extends ActiveRecord
{

    //aqui usamos activerecords 
    // base de datos

    protected static $tabla = 'eventos';
    protected static $columnasDB = ['id', 'titulo', 'acronimo', 'ranking', 'enlace', 'usuario_id',  'fecha', 'documento_url', 'fechaAcep', 'fecha_registro'];

    public $id;
    public $titulo;
    public $acronimo;
    public $ranking;
    public $enlace;
    public $usuario_id;
    public $fecha;
    public $documento_url;
    public $fechaAcep;
    public $fecha_registro;


    public  function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->acronimo = $args['acronimo'] ?? '';
        $this->ranking = $args['ranking'] ?? '';
        $this->enlace = $args['enlace'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
        $this->documento_url = $args['documento_url'] ?? '';
        $this->fechaAcep = $args['fechaAcep'] ?? null;
        $this->fecha_registro = $args['fecha_registro'] ?? null;
    }


    //MENSAJES DE VALIDACION PARA VALIDAR EVENTOS
    public function validarEventos()
    {
        if (!$this->titulo) {
            self::$alertas['error'][] = 'Por favor, ingrese el título del evento.';
        }
        if (!$this->acronimo) {
            self::$alertas['error'][] = 'Por favor, ingrese el acrónimo del evento.';
        }
        if (!$this->ranking) {
            self::$alertas['error'][] = 'Por favor, ingrese el ranking del evento.';
        }
        if (!$this->enlace) {
            self::$alertas['error'][] = 'Por favor, ingrese el enlace del evento.';
        }
        // VALIDAR FECHAS DEJO $MES,$DIA PARA POSIBLEMENTE EN EL FUTURO INPLEMENTAR ALGO
        // Validar la fecha del evento
        if (!$this->fecha) {
            self::$alertas['error'][] = 'Por favor, ingrese una fecha para el evento.';
        } else {
            $fechaPartes = explode('-', $this->fecha);
            if (count($fechaPartes) === 3) {
                $anio = (int)$fechaPartes[0];
                $mes = (int)$fechaPartes[1];
                $dia = (int)$fechaPartes[2];

                if (strlen($anio) !== 4 || $anio < 1110 || $anio > 2500) {
                    self::$alertas['error'][] = 'Por favor, ingrese un año válido para la fecha del evento.';
                }
            }
        }
        // Establecer una fecha predeterminada si fechaAcep está vacío
        // Validar fecha de aceptación
        if (!$this->fechaAcep) {
            $this->fechaAcep = '1111-11-11'; // Establecer en '1111-11-11' si no se proporciona
        } else {
            // Validar la fecha de aceptación
            $fechaPartesAceptacion = explode('-', $this->fechaAcep);
            if (count($fechaPartesAceptacion) === 3) {
                $anioAceptacion = (int)$fechaPartesAceptacion[0];
                $mesAceptacion = (int)$fechaPartesAceptacion[1];
                $diaAceptacion = (int)$fechaPartesAceptacion[2];

                if (strlen($anioAceptacion) !== 4 || $anioAceptacion < 1110 || $anioAceptacion > 2500) {
                    self::$alertas['error'][] = 'Por favor, ingrese un año válido para la fecha de aceptación.';
                }
            }
        }

        // Validar fecha de registro
        if (!$this->fecha_registro) {
            $this->fecha_registro = '1111-11-11'; // Establecer en '1111-11-11' si no se proporciona
        } else {
            // Validar la fecha de registro
            $fechaPartesRegistro = explode('-', $this->fecha_registro);
            if (count($fechaPartesRegistro) === 3) {
                $anioRegistro = (int)$fechaPartesRegistro[0];
                $mesRegistro = (int)$fechaPartesRegistro[1];
                $diaRegistro = (int)$fechaPartesRegistro[2];

                if (strlen($anioRegistro) !== 4 || $anioRegistro < 1110 || $anioRegistro > 2500) {
                    self::$alertas['error'][] = 'Por favor, ingrese un año válido para la fecha de registro.';
                }
            }
        }

        return self::$alertas;
    }
    //MENSAJES DE VALIDACION PARA VALIDAR EVENTOS


    // -----------CONSULTAS PARA BUSQUEDA DE DATOS-------------
    public static function buscarEventos($titulo, $acronimo, $ranking, $fecha)
    {
        // Crear la consulta SQL
        $sql = "SELECT * FROM eventos WHERE 1=1";

        if ($titulo != '') {
            $titulo = s($titulo);  // Sanitiza la entrada de $titulo
            $sql .= " AND titulo LIKE '%$titulo%'";
        }
        if ($acronimo != '') {
            $acronimo = s($acronimo);  // Sanitiza la entrada de $acronimo
            $sql .= " AND acronimo LIKE '%$acronimo%'";
        }
        if ($ranking != '') {
            $ranking = s($ranking);  // Sanitiza la entrada de $ranking
            $sql .= " AND ranking = '$ranking'";  // Usamos el operador = para coincidencia exacta
        }
        if ($fecha != '') {
            $fecha = s($fecha);  // Sanitiza la entrada de $fecha
            $sql .= " AND DATE_FORMAT(fecha, '%Y-%m-%d') LIKE '$fecha%'";
        }

        // Ejecutar la consulta usando la función SQL
        return self::consultarSQL($sql);
    }
    // -----------CONSULTAS PARA BUSQUEDA DE DATOS-------------



    // -----------INVERTIR EL ORDEN DE LA FECHA-------------
    public function convertirFecha()
    {
        $this->fecha = date('d-m-Y', strtotime($this->fecha));
        $this->fechaAcep = date('d-m-Y', strtotime($this->fechaAcep));
        $this->fecha_registro = date('d-m-Y', strtotime($this->fecha_registro));
    }

    // -----------INVERTIR EL ORDEN DE LA FECHA-------------


    // -----------FUNCIÓN ELIMINAR -------------
    public static function eliminarArchivo($documento_url)
    {
        if (!empty($documento_url)) {
            $archivo = 'documentos/eventos/' . $documento_url;
            $archivo = trim($archivo);

            if (file_exists($archivo)) {
                return unlink($archivo);
            }
        }
        return false;
    }
    // -----------FUNCIÓN ELIMINAR -------------


    // -----------MANEJAR LA SUBIDA DE ARCHIVOS-------------
    public static function guardarArchivo($archivo)
    {
        $directorio = 'documentos/eventos';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }
        // Generar un nombre único para evitar sobreescribir archivos
        $nombre_archivo = uniqid('evento_', true) . '.' . pathinfo($archivo['name'], PATHINFO_EXTENSION);

        // Ruta completa donde se guardará el archivo
        $ruta_destino = $directorio . '/' . $nombre_archivo;

        // Mover el archivo del directorio temporal a la carpeta de destino
        if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
            return $nombre_archivo;  // Devuelve solo el nombre del archivo
        }
    }
    // -----------MANEJAR LA SUBIDA DE ARCHIVOS-------------

}
