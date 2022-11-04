<?php
// MODELO DE USUARIOS

include_once "model.php";

class Usuarios extends Model
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
    public function login($usuario, $contraseña) {
        $result = $this->db->dataQuery("SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'");
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


       // Inserta un libro. Devuelve 1 si tiene éxito o 0 si falla.
       public function insert($usuario, $contraseña, $nombre,$tipo)
       {
           return $this->db->dataManipulation("INSERT INTO usuarios (usuario,contraseña,nombre,tipo) VALUES ('$usuario','$contraseña', '$nombre','$tipo')");
       }

           // Busca un texto en las tablas de libros y autores. Devuelve un array de objetos con todos los libros
    // que cumplen el criterio de búsqueda.
    public function search($textoBusqueda)
    {
        // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda
        $result = $this->db->dataQuery("SELECT * FROM usuarios
					                    WHERE usuarios.usuario LIKE '%$textoBusqueda%'
					                    OR usuarios.contraseña LIKE '%$textoBusqueda%'
					                    OR usuarios.nombre LIKE '%$textoBusqueda%'
                                        OR usuarios.tipo LIKE '%$textoBusqueda%'
					                    ORDER BY usuarios.nombre");
        return $result;
    }
    
        // Actualiza un libro (todo menos sus autores). Devuelve 1 si tiene éxito y 0 en caso de fallo.
        public function update($id,$usuario, $contraseña, $nombre,$tipo)
        {

            $ok = $this->db->dataManipulation("UPDATE usuarios SET
                                    usuario = '$usuario',
                                    contraseña = '$contraseña',
                                    nombre = '$nombre',
                                    tipo = '$tipo'
                                    WHERE id = '$id'");
            return $ok;
        }

}