<?php
                                        // VISTA PARA INSERCIÓN/EDICIÓN DE usuario
if ($data != null) {   
extract($data);
}
// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,


if (isset($listaUsuarios)) {   
    echo "<h1>Modificación de Usuarios</h1>";
} else {
    echo "<h1>Inserción de Usuarios</h1>";
}

// Sacamos los datos del usuario (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay usuario, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $listaUsuarios->id ?? "";
$usuario = $listaUsuarios->usuario ?? "";
$contraseña = $listaUsuarios->contraseña ?? "";
$nombre = $listaUsuarios->nombre ?? "";
$tipo = $listaUsuarios->tipo ?? "";

// Creamos el formulario con los campos del usuario
echo "<form action = 'index.php' method = 'get'>
        <div class='d-grid gap-1 col-3 mx-auto'>
        <input type='hidden' name='id' value='$id'><br>   
        Usuario:<input class='form-control' type='text' name='usuario' value='$usuario'><br>
        Contraseña:<input class='form-control' type='text' name='contraseña' value='$contraseña'><br>
        Nombre:<input class='form-control' type='text' name='nombre' value='$nombre'><br>
        Tipo:<input class='form-control' type='text' name='tipo' value='$tipo'><br>
        <input type='hidden' name='controller' value='UsuariosController'></div>";

// Finalizamos el formulario
if (isset($listaUsuarios)) {
    echo "  <input type='hidden' name='action' value='modificarUsuarios'>";
} else {
    echo "  <input type='hidden' name='action' value='insertaUsuarios'>";
}
echo "	<input class='btn btn-outline-success d-grid gap-2 col-2 mx-auto' type='submit'><br>";
echo " <input class='btn btn-outline-danger d-grid gap-2 col-2 mx-auto' type='reset' value='Restablecer'></form><br>";
echo "<p><a class='btn btn-outline-warning d-grid gap-2 col-2 mx-auto' href='index.php?action=mostrarListaUsuarios&controller=UsuariosController'>Volver</a></p>";

