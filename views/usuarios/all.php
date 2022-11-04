<?php
// VISTA PARA LA LISTA DE usuario

// Recuperamos la lista de usuario
$listaUsuarios = $data["listaUsuarios"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form class='d-flex form-control' action='index.php'> 
      <input type='hidden' name='controller' value='UsuariosController'>
        <input type='hidden' name='action' value='buscarUsuarios'>
        <input class='form-control' type='text' name='textoBusqueda'>
        <input class='btn btn-outline-dark' type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de los usuario
if (count($listaUsuarios) == 0) {
  echo "No hay datos";
} else {
  echo "<table class='table' border ='1'>";
  foreach ($listaUsuarios as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->id . "</td>";
    echo "<td>" . $fila->usuario . "</td>";
    echo "<td>" . $fila->contraseña . "</td>";
    echo "<td>" . $fila->nombre . "</td>";
    echo "<td>" . $fila->tipo . "</td>";
    echo "<td><a class='btn btn-outline-primary' href='index.php?controller=UsuariosController&action=formularioModificarUsuarios&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><button type='button' class='btn btn-outline-danger' onclick='confirmarBorrado (" . $fila->id . ")'>Borrar</button></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a class='btn btn-outline-primary' href='index.php?controller=UsuariosController&action=formularioInsertarUsuarios'>Nuevo</a></p>";

?>
<script type = "text/javascript">
  function confirmarBorrado(id){
    if (confirm("¿Seguro que desea borrar este usuario?")){
      window.location.href='index.php?controller=UsuariosController&action=borrarUsuarios&id=' + id;
    }

  }
  </script>