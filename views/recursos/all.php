<?php
// VISTA PARA LA LISTA DE recursos

// Recuperamos la lista de recursos
$listaRecursos = $data["listaRecursos"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form class='d-flex form-control' action='index.php'> 
    <input type='hidden' name='controller' value='RecursosController'>
        <input type='hidden' name='action' value='buscarRecursos'>
        <input class='form-control'  type='text' name='textoBusqueda'>
        <input class='btn btn-outline-dark' type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de los recursos
if (count($listaRecursos) == 0) {
  echo "No hay datos";
} else {
  echo "<table class='table'>";
  foreach ($listaRecursos as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->id . "</td>";
    echo "<td>" . $fila->nombre . "</td>";
    echo "<td>" . $fila->Descripcion . "</td>";
    echo "<td>" . $fila->localizacion . "</td>";
    echo "<td><img src='" . $fila->imagen . "' ></td>";
    echo "<td><a class='btn btn-outline-primary ' href='index.php?controller=RecursosController&action=formularioModificarRecursos&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><a class='btn btn-outline-primary' href='index.php?controller=RecursosController&action=formularioReservarRecurso&id=" . $fila->id . "'>Reservar</a></td>";
    echo "<td><button type='button' class='btn btn-outline-danger' onclick='confirmarBorrado (" . $fila->id . ")'>Borrar</button></td>";
    echo "</tr>";
  }
  echo "</table>";
}

echo "<p><a class='btn btn-outline-primary' href='index.php?controller=RecursosController&action=formularioInsertarRecursos'>Nuevo</a></p>";

?>
<script type = "text/javascript">
  function confirmarBorrado(id){
    if (confirm("¿Seguro que desea borrar este recurso?")){
      window.location.href='index.php?controller=RecursosController&action=borrarRecursos&id=' + id;
    }

  }
  </script>

<style type="text/css">
img{
width: 6rem;
height: auto;
}
  </style>
