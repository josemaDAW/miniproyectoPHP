<?php

// MODELO DE USUARIOS

include_once "model.php";

class Login extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "usuarios";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Comprueba si $email y $passwd corresponden a un usuario registrado. Si es así, inicia usa sesión creando
    // una variable de sesión y devuelve true. Si no, de vuelve false.
    public function login($email, $passwd) {
        $result = $this->db->dataQuery("SELECT * FROM usuarios WHERE email='$email' AND password='$passwd'");
        if (count($result) == 1) {
            Seguridad::iniciarSesion($result[0]->id);
            return true;
        } else {
            return false;
        }
    }

    // Cierra una sesión (destruye variables de sesión)
    public function cerrarSesion() {
        Seguridad::cerrarSesion();
    }
}