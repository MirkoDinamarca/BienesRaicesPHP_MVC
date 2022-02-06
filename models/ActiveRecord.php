<?php

namespace Model;

class ActiveRecord {
    // Base de Datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    // Validación de Errores
    protected static $errores = [];

    // Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }

    public function crear() {

        // Sanitizar los atributos antes de insertarlo a la Base de Datos
        $atributos = $this->sanitizarAtributos();

        // Insertando en la BD
        $query = " INSERT INTO " . static::$tabla . " (";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ')";
    
        $resultado = self::$db->query($query);

        // Mensaje de éxito
        if ($resultado) {
            // echo "Insertado correctamente!";
            // Redireccionar al usuario una vez que envían el formulario
            Header("Location: /admin?mensaje=1");
        }
    } 
    
    public function actualizar() {
        // Sanitizar los atributos antes de insertarlo a la Base de Datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // echo "Insertado correctamente!";
            // Redireccionar al usuario una vez que envían el formulario
            Header("Location: /admin?mensaje=2");
        }
    }

    // Eliminar un registro
    public function eliminar() {
        $query = " DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        // Redirecciona a la administración
        if ($resultado) {
            $this->borrarImagen();
            Header("Location: /admin?mensaje=3");
        }
    }

    // Identifica y une los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === "id") continue; // continue ignora ese "id" y pasa al siguiente
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Subida de imágenes
    public function setImagen($imagen) {
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Se asigna al atributo de imágen el nombre de la imágen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Eliminar un archivo
    public function borrarImagen() {
        // Elimina la imagen previa
        if (isset($this->id)) {
            // Comprobar si existe el archivo
            $existeArchivo = file_exists(CARPETA_DE_IMAGENES . $this->imagen);
            if($existeArchivo) {
                unlink(CARPETA_DE_IMAGENES . $this->imagen);
            }
        }
    }

    // Validación
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    // Listar todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtiene determinado números de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);

        return $resultado;
    } 

    // Busca un registro por su ID
    public static function find($id) {
        $query = " SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado); // array_shift retorna el primer elemento de un arreglo
    }

    // Consulta a la base de datos (método reutilizable)
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    // Crea un objeto (método reutilizable)
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return($objeto);

    }
    
    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}