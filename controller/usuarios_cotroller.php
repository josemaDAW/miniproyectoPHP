<?php
/* CONTROLADOR DE RECURSOS
include_once("models/libro.php");  // Modelos
include_once("models/autor.php");*/
include_once("models/usuarios.php");
include_once("view.php");

class UsuariosController
{
    private $db;             // Conexión con la base de datos
    private $usuarios;  // Modelos

    public function __construct()
    {
        $this->usuarios = new Usuarios();
    } 

        // Muestra el formulario de login
        public function formLogin() {
            View::render2("login");
        }
    
        // Comprueba los datos de login. Si son correctos, el modelo iniciará la sesión y
        // desde aquí se redirige a otra vista. Si no, nos devuelve al formulario de login.
        public function procesarFormLogin() {
            $usuario = Seguridad::limpiar($_REQUEST["usuario"]);
            $contraseña = Seguridad::limpiar($_REQUEST["contraseña"]);
            $result = $this->usuarios->login($usuario, $contraseña);
            if ($result) { 
                header("Location: index.php?controller=RecursosController&action=mostrarmenu");
            } else {
                $data["error"] = "<h4 class='btn link-danger d-grid gap-4 col-3 mx-auto'> Usuario o contraseña incorrectos </h4>";
                View::render2("login", $data);
            }
        }
    
        // Cierra la sesión y nos lleva a la vista de login
        public function cerrarSesion() {
            $this->usuario->cerrarSesion();
            $data["info"] = "Sesión cerrada con éxito";
            View::render2("login", $data);
        }

        // --------------------------------- MOSTRAR USUARIOS ------------------------------------------------
        public function mostrarListaUsuarios()
        {
            if (Seguridad::haySesion()) {
                $data["listaUsuarios"] = $this->usuarios->getAll();
                View::render("usuarios/all", $data);
            } else {
                $data["error"] = "No tienes permiso para eso";
                View::render2("login", $data);
            }
     
       }


       // --------------------------------- FORMULARIO ALTA DE USUARIO ----------------------------------------
       public function formularioInsertarUsuarios()
       {
           if (Seguridad::haySesion()) {
               View::render("usuarios/form");
           }  else {
               $data["error"] = "No tienes permiso para eso";
               View::render2("login", $data);
           }
       }
           // --------------------------------- INSERTAR USUARIO ----------------------------------------

    public function insertaUsuarios()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $usuario = Seguridad::limpiar($_REQUEST["usuario"]);
            $contraseña = Seguridad::limpiar($_REQUEST["contraseña"]);
            $nombre = Seguridad::limpiar($_REQUEST["nombre"]);
            $tipo = Seguridad::limpiar($_REQUEST["tipo"]);

            $result = $this->usuarios->insert($usuario, $contraseña, $nombre, $tipo);
            if ($result == 1) {
            header("Location: index.php?controller=UsuariosController&action=mostrarListaUsuarios");
           
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
          
        }
        
    }


           // --------------------------------- Borrar USUARIO ----------------------------------------
       public function borrarUsuarios()
       {
           if (Seguridad::haySesion()) {
               // Recuperamos el id del recurso que hay que borrar
               $id = Seguridad::limpiar($_REQUEST["id"]);
               // Pedimos al modelo que intente borrar el recurso
               $result = $this->usuarios->delete($id);
               // Comprobamos si el borrado ha tenido éxito
               if ($result == 0) {
                   $data["error"] = "Ha ocurrido un error al borrar el libro. Por favor, inténtelo de nuevo";
               } else {
                   $data["info"] = "Recurso borrado con éxito";
               }
               header("Location: index.php?controller=UsuariosController&action=mostrarListaUsuarios");

           } else {
               $data["error"] = "No tienes permiso para eso";
               View::render2("login", $data);
           }
       }


    // --------------------------------- FORMULARIO MODIFICAR USUARIOS ----------------------------------------

    public function formularioModificarUsuarios()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos los datos del libro a modificar
            $result = $this->usuarios->get(($_REQUEST["id"]));
            $data["listaUsuarios"] = $result[0];
           //var_dump ($data["recurso"]);
           View::render("usuarios/form", $data);
        }
        
    }

    // --------------------------------- MODIFICAR USUARIOS ----------------------------------------

    public function modificarUsuarios()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $usuario = Seguridad::limpiar($_REQUEST["usuario"]);
            $contraseña = Seguridad::limpiar($_REQUEST["contraseña"]);
            $nombre = Seguridad::limpiar($_REQUEST["nombre"]);
            $tipo = Seguridad::limpiar($_REQUEST["tipo"]);

            // Pedimos al modelo que haga el update
            $result = $this->usuarios->update($id,$usuario, $contraseña, $nombre, $tipo);
            if ($result == 1) {
                header("Location: index.php?controller=UsuariosController&action=mostrarListaUsuarios");
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
           
        }
    }


        // --------------------------------- BUSCAR RECURSOS ----------------------------------------

        public function buscarUsuarios()
        {
            if (Seguridad::haySesion()) {
                // Recuperamos el texto de búsqueda de la variable de formulario
                $textoBusqueda = /*Seguridad::limpiar*/($_REQUEST["textoBusqueda"]);
                // Buscamos los recursos que coinciden con la búsqueda
                $data["listaUsuarios"] = $this->usuarios->search($textoBusqueda);
                $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
                // Mostramos el resultado en la misma vista que la lista completa de libros
                View::render("usuarios/all", $data);
               
            }
        }

    }
