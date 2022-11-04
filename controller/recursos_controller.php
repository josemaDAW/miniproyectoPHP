<?php
// CONTROLADOR DE RECURSOS

include_once("models/recursos.php");
include_once("view.php");

class RecursosController
{
    private $db;             // Conexión con la base de datos
    private $recursos;      // Modelos

    public function __construct()
    {
        $this->recursos = new Recursos();
        $this->horario = new Horario();
        $this->reservas = new Reservas();
      

    } 

        // --------------------------------- MOSTRAR RECURSOS ------------------------------------------------
        public function mostrarListaRecursos()
        {
            if (Seguridad::haySesion()) {
                $data["listaRecursos"] = $this->recursos->getAll();
                View::render("recursos/all", $data);
            } else {
                $data["error"] = "No tienes permiso para eso";
                View::render2("login", $data);
            }
     
       }


       // --------------------------------- FORMULARIO ALTA DE RECURSOS ----------------------------------------
       public function formularioInsertarRecursos()
       {
           if (Seguridad::haySesion()) {
               View::render("recursos/form");
           }  else {
               $data["error"] = "No tienes permiso para eso";
               View::render2("login", $data);
           }
       }
           // --------------------------------- INSERTAR Recursos ----------------------------------------

    public function insertaRecursos()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $nombre = Seguridad::limpiar($_REQUEST["nombre"]);
            $Descripcion = Seguridad::limpiar($_REQUEST["Descripcion"]);
            $localizacion = Seguridad::limpiar($_REQUEST["localizacion"]);
            
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], "images/".$_FILES["imagen"]["name"]))
                $result = $this->recursos->insert($nombre, $Descripcion, $localizacion, "images/".$_FILES["imagen"]["name"]);
                if ($result == 1) {
                    header("Location: index.php?controller=RecursosController&action=mostrarListaRecursos");
            } else {
                $data["error"] = "Error al subir el archivo";
                $data["listaRecursos"] = $this->recursos->getAll();
                View::render("recursos/all", $data);
            }
           
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
        
    }
       

 // --------------------------------- Borrar Recursos ----------------------------------------
       public function borrarRecursos()
       {
           if (Seguridad::haySesion()) {
               // Recuperamos el id del recurso que hay que borrar
               $id = Seguridad::limpiar($_REQUEST["id"]);
               // Pedimos al modelo que intente borrar el recurso
               $result = $this->recursos->delete($id);
               // Comprobamos si el borrado ha tenido éxito
               if ($result == 0) {
                   $data["error"] = "Ha ocurrido un error al borrar el recurso. Por favor, inténtelo de nuevo";
               } else {
                   $data["info"] = "Recurso borrado con éxito";
               }
               header("Location: index.php?controller=RecursosController&action=mostrarListaRecursos");
           } else {
               $data["error"] = "No tienes permiso para eso";
               View::render2("login", $data);
           }
       }


    // --------------------------------- FORMULARIO MODIFICAR RECURSOS ----------------------------------------

    public function formularioModificarRecursos()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos los datos del recurso a modificar
            $result = $this->recursos->get(($_REQUEST["id"]));
            $data["recursos"] = $result[0];
           //var_dump ($data["recurso"]);
           View::render("recursos/form", $data);
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
        
    }

    // --------------------------------- MODIFICAR RECURSOS ----------------------------------------

    public function modificarRecurso()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $nombre = Seguridad::limpiar($_REQUEST["nombre"]);
            $Descripcion = Seguridad::limpiar($_REQUEST["Descripcion"]);
            $localizacion = Seguridad::limpiar($_REQUEST["localizacion"]);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "images/".$_FILES["imagen"]["name"]);
            //$imagen = Seguridad::limpiar($_REQUEST["imagen"]);
            
            $result = $this->recursos->update($id,$nombre, $Descripcion, $localizacion, "images/".$_FILES["imagen"]["name"]);
            header("Location: index.php?controller=RecursosController&action=mostrarListaRecursos");
        }
    else {
        $data["error"] = "No tienes permiso para eso";
        View::render2("login", $data);
    }
}


        // --------------------------------- BUSCAR RECURSOS ----------------------------------------

        public function buscarRecursos()
        {
            if (Seguridad::haySesion()) {
                // Recuperamos el texto de búsqueda de la variable de formulario
                $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
                // Buscamos los recursos que coinciden con la búsqueda
                $data["listaRecursos"] = $this->recursos->search($textoBusqueda);
                $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
                // Mostramos el resultado en la misma vista que la lista completa de recurso
                View::render("recursos/all", $data);
               
            }else {
                $data["error"] = "No tienes permiso para eso";
                View::render2("login", $data);
            }
        }
// -------------------------------------- MENU PRINCIPAL ---------------------------------------
        public function mostrarmenu(){
            if (Seguridad::haySesion()) {
            View::render("menuprincipal");

        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
    }

// ------------------------------------------- CERRAR SESION -----------------------------------
        public function cerrarSesion(){
        Seguridad::cerrarSesion();
        View::render2("login");
        }


// ------------------------------------------- FORMULARIO RESERVAR RECURSO-----------------------------------
    public function formularioReservarRecurso()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos los datos del recurso a modificar
            $result = $this->recursos->get(($_REQUEST["id"]));
            $result2 = $this->horario->getAll(); 
            $data["recursos"] = $result[0];
            $data["listaHorario"] = $result2;
           //var_dump ($data["recurso"]);
           View::render("recursos/reserva", $data);
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
        
    }

           // --------------------------------- INSERTAR RESERVA ----------------------------------------

           public function insertaReserva()
           {
               if (Seguridad::haySesion()) {
                   // Primero, recuperamos todos los datos del formulario
                   $idRecurso = Seguridad::limpiar($_REQUEST["idRecurso"]);
                   $idUsuarios = Seguridad::limpiar($_REQUEST["idUsuarios"]);
                   $idHorario = Seguridad::limpiar($_REQUEST["idHorario"]);
                   $fecha = Seguridad::limpiar($_REQUEST["fecha"]);
                   $observaciones = Seguridad::limpiar($_REQUEST["observaciones"]);
                   
                   $result = $this->reservas->insert2($idRecurso, $idUsuarios, $idHorario, $fecha,$observaciones);
                   header("Location: index.php?controller=RecursosController&action=mostrarReservas");

           }
              
       }

        // --------------------------------- MOSTRAR reserva ------------------------------------------------
         public function mostrarReservas()
        {
            $result = $this->reservas->getAll(); 
            $data["reservas"] = $result[0];
           View::render("recursos/reservaLista", $data);
     
       }
       

}
    
