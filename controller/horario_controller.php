<?php
include_once("models/horario.php");
include_once("view.php");

class HorarioController
{
    private $db;        // Conexión con la base de datos
    private $horario;  // Modelos

    public function __construct()
    {
        $this->horario = new Horario();
    } 

        // --------------------------------- MOSTRAR HORARIO ------------------------------------------------
        public function mostrarListaHorario()
        {
            if (Seguridad::haySesion()) {
                $data["listaHorario"] = $this->horario->getAll();
                View::render("horario/all", $data);
            } else {
                $data["error"] = "No tienes permiso para eso";
                View::render2("login", $data);
            }
     
       }


       // --------------------------------- FORMULARIO ALTA DE HORARIOS ----------------------------------------
       public function formularioInsertarHorario()
       {
           if (Seguridad::haySesion()) {
               View::render("horario/form");
           } else {
               $data["error"] = "No tienes permiso para eso";
               View::render2("login", $data);
           }
       }
           // --------------------------------- INSERTAR HORARIO ----------------------------------------

    public function insertaHorario()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $diaSemana = Seguridad::limpiar($_REQUEST["diaSemana"]);
            $empieza = Seguridad::limpiar($_REQUEST["empieza"]);
            $acaba = Seguridad::limpiar($_REQUEST["acaba"]);

            $result = $this->horario->insert($diaSemana, $empieza, $acaba);
            if ($result == 1) {
                header("Location: index.php?controller=HorarioController&action=mostrarListaHorario");
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
       
        }
        
    }
       
           // --------------------------------- Borrar Horario ----------------------------------------
       public function borrarHorario()
       {
           if (Seguridad::haySesion()) {
               // Recuperamos el id del horario que hay que borrar
               $id = Seguridad::limpiar($_REQUEST["id"]);
               // Pedimos al modelo que intente borrar el horario
               $result = $this->horario->delete($id);
               // Comprobamos si el borrado ha tenido éxito
               if ($result == 0) {
                   $data["error"] = "Ha ocurrido un error al borrar el horario. Por favor, inténtelo de nuevo";
               } else {
                   $data["info"] = "horario borrado con éxito";
               }
               header("Location: index.php?controller=HorarioController&action=mostrarListaHorario");

           } else {
               $data["error"] = "No tienes permiso para eso";
               View::render2("login", $data);
           }
       }


    // --------------------------------- FORMULARIO MODIFICAR HORARIO ----------------------------------------

    public function formularioModificarHorario()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos los datos del horarios a modificar
            $result = $this->horario->get(($_REQUEST["id"]));
            $data["listaHorario"] = $result[0];
           View::render("horario/form", $data);
        }
        
    }

    // --------------------------------- MODIFICAR HORARIO ----------------------------------------

    public function modificarHorario()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $diaSemana = Seguridad::limpiar($_REQUEST["diaSemana"]);
            $empieza = Seguridad::limpiar($_REQUEST["empieza"]);
            $acaba = Seguridad::limpiar($_REQUEST["acaba"]);

            // Pedimos al modelo que haga el update
            $result = $this->horario->update($id,$diaSemana, $empieza, $acaba);
            if ($result == 1) {
                header("Location: index.php?action=mostrarListaHorario&controller=HorarioController");
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render2("login", $data);
        }
    
        }
    }


        // --------------------------------- BUSCAR horarios ----------------------------------------

        public function buscarHorario()
        {
            if (Seguridad::haySesion()) {
                // Recuperamos el texto de búsqueda de la variable de formulario
                $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
                // Buscamos los horario que coinciden con la búsqueda
                $data["listaHorario"] = $this->horario->search($textoBusqueda);
                $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
                // Mostramos el resultado en la misma vista que la lista completa de horarios
                View::render("horario/all", $data);
               
            }
        }

    }