<?php

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = "propiedades";

    protected static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones",
    "wc", "estacionamiento", "creado", "vendedor_id"];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedor_id;

    public function __construct($arreglo = [])
    {   
        $this->id = $arreglo["id"] ?? null;
        $this->titulo = $arreglo["titulo"] ?? "";
        $this->precio = $arreglo["precio"] ?? "";
        $this->imagen = $arreglo["imagen"] ?? "";
        $this->descripcion = $arreglo["descripcion"] ?? "";
        $this->habitaciones = $arreglo["habitaciones"] ?? "";
        $this->wc = $arreglo["wc"] ?? "";
        $this->estacionamiento = $arreglo["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedor_id = $arreglo["vendedor_id"] ?? "";
    }

    public function validar() {
        if (!$this->titulo) {
            self::$errores[] = "* Debe agregar un título";
        }

        if (!$this->precio) {
            self::$errores[] = "* Debe agregar un precio";
        }

        if (!$this->imagen) {
            self::$errores[] = "* La imagen es obligatoria";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "* La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "* Debe agregar una habitación";
        }

        if (!$this->wc) {
            self::$errores[] = "* Debe agregar un baño";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "* Debe agregar un estacionamiento";
        }

        if (!$this->vendedor_id) {
            self::$errores[] = "* Debe elegir un vendedor/ra";
        }

        return self::$errores;
    }
}
