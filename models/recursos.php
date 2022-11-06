<?php
// MODELO DE RECURSOS

include_once "model.php";

class Recursos extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "recursos";
        $this->idColumn = "id";
        parent::__construct();
    }
       // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
       public function insert($nombre, $Descripcion, $localizacion, $imagen)
       {
           return $this->db->dataManipulation("INSERT INTO recursos (nombre,Descripcion,localizacion,imagen) VALUES ('$nombre','$Descripcion', '$localizacion', '$imagen')");
       }

     // Busca un texto en las tablas  Devuelve un array de objetos con todos los 
    // que cumplen el criterio de búsqueda.
    public function search($textoBusqueda)
    {
        // Buscamos  coincidan con el texto de búsqueda
        $result = $this->db->dataQuery("SELECT * FROM recursos
					                    WHERE recursos.nombre LIKE '%$textoBusqueda%'
					                    OR recursos.Descripcion LIKE '%$textoBusqueda%'
					                    OR recursos.localizacion LIKE '%$textoBusqueda%'
					                    OR recursos.imagen LIKE '%$textoBusqueda%'
					                    ORDER BY recursos.nombre");
        return $result;
    }
    
        // Actualiza
        public function update($id,$nombre, $Descripcion, $localizacion, $imagen)
        {

            $ok = $this->db->dataManipulation("UPDATE recursos SET
                                    nombre = '$nombre',
                                    Descripcion = '$Descripcion',
                                    localizacion = '$localizacion',
                                    imagen = '$imagen'
                                    WHERE id = '$id'");
            return $ok;
        }
  
}


class Reservas extends Model
{
    public function __construct()
    {
        $this->table = "reservas";
        $this->idColumn = "idRecurso";
        parent::__construct();
    }
public function insert2($idRecurso, $idUsuarios, $idHorario, $fecha)
{
    return $this->db->dataManipulation("INSERT INTO reservas (idRecurso,idUsuarios,idHorario,fecha) VALUES ('$idRecurso','$idUsuarios', '$idHorario', '$fecha')");
}
}