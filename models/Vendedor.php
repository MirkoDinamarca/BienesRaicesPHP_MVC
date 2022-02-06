<?php

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = "vendedores";

    protected static $columnasDB = ["id", "nombre", "apellido", "telefono"];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($arreglo = [])
    {   
        $this->id = $arreglo["id"] ?? null;
        $this->nombre = $arreglo["nombre"] ?? "";
        $this->apellido = $arreglo["apellido"] ?? "";
        $this->telefono = $arreglo["telefono"] ?? "";
    }

    public function validar() {
        if (!$this->nombre) {
            self::$errores[] = "* Debe agregar un nombre";
        }
        if (!$this->apellido) {
            self::$errores[] = "* Debe agregar un apellido";
        }
        if (!$this->telefono) {
            self::$errores[] = "* Debe agregar un telefono";
        }

        if (!preg_match('/[0-9]{10}/', $this->telefono) || strlen($this->telefono) > 10) {
            self::$errores[] = "Formato no válido";
        }

        return self::$errores;
    }
}