<?php
// VISTA PARA LA LISTA DE horario

// Recuperamos la lista de horario
$listaHorario = $data["listaHorario"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form class='d-flex form-control' action='index.php'> 
        <input type='hidden' name='controller' value='HorarioController'>
        <input type='hidden' name='action' value='buscarHorario'>
        <input class='form-control' type='text' name='textoBusqueda'>
        <input class='btn btn-outline-dark' type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de los recursos
if (count($listaHorario) == 0) {
  echo "No hay datos";
} else {
  echo "<table border ='1' class='table' >";
  foreach ($listaHorario as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->id . "</td>";
    echo "<td>" . $fila->diaSemana . "</td>";
    echo "<td>" . $fila->empieza . "</td>";
    echo "<td>" . $fila->acaba . "</td>";
    echo "<td><a class='btn btn-outline-primary' href='index.php?controller=HorarioController&action=formularioModificarHorario&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><button type='button' class='btn btn-outline-danger ' onclick='confirmarBorrado (" . $fila->id . ")'>Borrar</button></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a class='btn btn-outline-primary' href='index.php?controller=HorarioController&action=formularioInsertarHorario'>Nuevo</a></p>";

?>

<script type = "text/javascript">
  function confirmarBorrado(id){
    if (confirm("¿Seguro que desea borrar este horario?")){
      window.location.href='index.php?controller=HorarioController&action=borrarHorario&id=' + id;
    }

  }
  </script>

