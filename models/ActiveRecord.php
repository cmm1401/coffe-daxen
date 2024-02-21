<?php

namespace Model;

class ActiveRecord {

    protected static $dataBase;
    protected static $tabla = '';
    protected static $columnas = [];

    protected static $errores = [];
    
    public static function setDB($database) {
        self::$dataBase = $database;
        self::$dataBase->set_charset("utf8");
    }

    public static function getErrores() {
        return static::$errores;
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift( $resultado ) ;
    }

    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limite}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // Resultado de la consulta
        $resultado = self::$dataBase->query($query);

        return $resultado;
    }

    public function actualizar() {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$dataBase->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        $resultado = self::$dataBase->query($query);

        return $resultado;
    }

    // Eliminar un registro
    public function eliminar() {
        // Eliminar el registro
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$dataBase->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$dataBase->query($query);

        // if($resultado) {
        //     $this->borrarImagen();
        // }

        return $resultado;
    }

    public static function consultarSQL($query) {
        $resultado = self::$dataBase->query($query);
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value ) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }



    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnas as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$dataBase->escape_string($value);
        }
        return $sanitizado;
    }

    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Subida de archivos
    // public function setImagen($imagen) {
    //     // Elimina la imagen previa
    //     if( !is_null($this->id) ) {
    //         $this->borrarImagen();
    //     }
    //     // Asignar al atributo de imagen el nombre de la imagen
    //     if($imagen) {
    //         $this->imagen = $imagen;
    //     }
    // }

    // Elimina el archivo
    // public function borrarImagen() {
    //     // Comprobar si existe el archivo
    //     $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
    //     if($existeArchivo) {
    //         unlink(CARPETA_IMAGENES . $this->imagen);
    //     }
    // }
}