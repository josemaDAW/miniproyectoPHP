<?php
                                        // VISTA PARA INSERCIÓN/EDICIÓN DE RECURSOS
if ($data != null) {   
extract($data);
}
// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,


if (isset($recursos)) {   
    echo "<h1>Modificación de Recursos</h1>";
} else {
    echo "<h1>Inserción de Recursos</h1>";
}

// Sacamos los datos del recurso (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay recurso, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $recursos->id ?? "";
$nombre = $recursos->nombre ?? "";
$Descripcion = $recursos->Descripcion ?? "";
$localizacion = $recursos->localizacion ?? "";
$imagen = $recursos->imagen ?? "";

// Creamos el formulario con los campos del recursos
echo "<form action = 'index.php' method = 'post' enctype='multipart/form-data'> 
        <div class='d-grid gap-4 col-4 mx-auto'>
        <input type='hidden' name='id' value='$id'>
        Nombre:<input class='form-control' type='text' name='nombre' value='$nombre'>
        Descripcion:<input class='form-control' type='text' name='Descripcion' value='$Descripcion'>
        Localizacion:<input class='form-control' type='text' name='localizacion' value='$localizacion'>
        Imagen:<input class='form-control' type='file' name='imagen' value='$imagen'>
        <input  type='hidden' name='controller' value='RecursosController'></div>";
      
// Finalizamos el formulario
if (isset($recursos)) {
    echo "  <input  type='hidden' name='action' value='modificarRecurso'>";
} else {
    echo "  <input type='hidden' name='action' value='insertaRecursos'>";
}
echo "<br>	<input class='btn btn-outline-success d-grid gap-2 col-2 mx-auto' type='submit'><br>";
echo " <input class='btn btn-outline-danger d-grid gap-2 col-2 mx-auto' type='reset' value='Restablecer'></form><br>";
echo "<p><a class='btn btn-outline-warning d-grid gap-2 col-2 mx-auto' href='index.php?action=mostrarListarecursos&controller=RecursosController'>Volver</a></p>";

