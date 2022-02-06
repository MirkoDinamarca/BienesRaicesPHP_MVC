<?php

namespace Model;

class Admin extends ActiveRecord {
    // Base de datos
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "password"];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []) 
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function validar() {
        if(!$this->email) {
            self::$errores[] = "* El E-Mail es obligatorio o no es válido";
        }

        if(!$this->password) {
            self::$errores[] = "* El Password es obligatorio o no es válido";
        }

        return self::$errores;
    }

    public function existeUsuario() {
        // Revisar si un usuario existe o no
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        // Realiza la consulta
        $resultado = self::$db->query($query);

        // Si el usuario no existe
        if(!$resultado->num_rows) {
            self::$errores[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado) {
            self::$errores[] = "El Password es incorrecto";
        }
        return $autenticado;
    }   

    public function autenticar() {
        session_start();

        // LLenar el arreglo de session
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;

        // Redireccionar a Admin
        header("Location: /admin");
    }
}