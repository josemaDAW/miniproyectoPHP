<?php
                                        // VISTA PARA INSERCIÓN/EDICIÓN DE horario
if ($data != null) {   
extract($data);
}
// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,


if (isset($listaHorario)) {   
    echo "<h1>Modificación de Horario</h1>";
} else {
    echo "<h1>Inserción de Horario</h1>";
}

// Sacamos los datos del horario (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay horario, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $listaHorario->id ?? "";
$diaSemana = $listaHorario->diaSemana ?? "";
$empieza = $listaHorario->empieza ?? "";
$acaba = $listaHorario->acaba ?? "";

// Creamos el formulario con los campos del horario

echo "<form action = 'index.php' method = 'get'>
        <div class='d-grid gap-3 col-3 mx-auto '>
        <input type='hidden' name='id' value='$id'><br>   
        Dia de la semana:<input class='form-control' type='text' name='diaSemana' value='$diaSemana'><br>
        Empieza:<input class='form-control' type='text' name='empieza' value='$empieza'><br>
        Acaba:<input class='form-control' type='text' name='acaba' value='$acaba'><br>
        <input type='hidden' name='controller' value='HorarioController'></div>";

// Finalizamos el formulario
if (isset($listaHorario)) {
    echo "  <input type='hidden' name='action' value='modificarHorario'>";
} else {
    echo "  <input type='hidden' name='action' value='insertaHorario'>";
}
echo "	<input class='btn btn-outline-success d-grid gap-2 col-2 mx-auto' type='submit'><br>";
echo " <input class='btn btn-outline-danger d-grid gap-2 col-2 mx-auto' type='reset' value='Restablecer'></form><br>";
echo "<p><a class='btn btn-outline-warning d-grid gap-2 col-2 mx-auto' href='index.php?action=mostrarListaHorario&controller=HorarioController'>Volver</a></p>";

