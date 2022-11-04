<?php
// MODELO DE horario

include_once "model.php";

class Horario extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "horario";
        $this->idColumn = "id";
        parent::__construct();
    }
       // Inserta un horario. Devuelve 1 si tiene éxito o 0 si falla.
       public function insert($diaSemana, $empieza, $acaba)
       {
           return $this->db->dataManipulation("INSERT INTO horario (diaSemana,empieza,acaba) VALUES ('$diaSemana','$empieza', '$acaba')");
       }

           // Busca un texto en las tablas de horario y autores. Devuelve un array de objetos con todos los horario
    // que cumplen el criterio de búsqueda.
    public function search($textoBusqueda)
    {
        // Buscamos los horario de la biblioteca que coincidan con el texto de búsqueda
        $result = $this->db->dataQuery("SELECT * FROM horario
					                    WHERE horario.diaSemana LIKE '%$textoBusqueda%'
					                    OR horario.empieza LIKE '%$textoBusqueda%'
					                    OR horario.acaba LIKE '%$textoBusqueda%'
					                    ORDER BY horario.diaSemana");
        return $result;
    }
    
        // Actualiza un horario (todo menos sus autores). Devuelve 1 si tiene éxito y 0 en caso de fallo.
        public function update($id,$diaSemana, $empieza, $acaba)
        {

            $ok = $this->db->dataManipulation("UPDATE horario SET
                                    diaSemana = '$diaSemana',
                                    empieza = '$empieza',
                                    acaba = '$acaba'
                                    WHERE id = '$id'");
            return $ok;
        }
      
}