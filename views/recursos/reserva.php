<?php
                                        // VISTA PARA RESERVAS
if ($data != null) {   
extract($data);
}

if (isset($recursos)) {   
    echo "<h1>Insertar Reservas</h1>";
} 

// Sacamos los datos del recurso (si existe) a variables individuales para mostrarlo en los inputs del formulario.
$id = $recursos->id ?? "";
$nombre = $recursos->nombre ?? "";
$Descripcion = $recursos->Descripcion ?? "";
$localizacion = $recursos->localizacion ?? "";
$imagen = $recursos->imagen ?? "";

// Creamos el formulario con los campos del libro
echo "<form action = 'index.php' method = 'get'>
<div class='d-grid gap-4 col-4 mx-auto'>
        <input type='hidden' name='id' value='$id'>
        Fecha reserva: <input class='form-control' type='date' name='reserva' value='$'>
        <input type='hidden' name='controller' value='RecursosController'>
        <select class='form-select' name='horario'>";
        foreach ($listaHorario as $fila) {
            echo "<option value='$fila->id'> ". $fila->diaSemana ." " . $fila->empieza . " " . $fila->acaba. "</option>";
        }
       "</select'></div>";

// Finalizamos el formulario
if (isset($recursos)) {
    echo "  <input type='hidden' name='action' value='insertaReserva'>";
} 
    echo "	<input class='btn btn-outline-success form-control ' type='submit'></form>";

echo "<br>";
echo "Nombre: $nombre <br>";
echo "Descripcion: $Descripcion <br>";
echo "Localizacion: $localizacion <br> ";
echo "Imagen:<br>";
echo "<img src= $imagen > <br>";

echo "<p><a href='index.php?action=mostrarListarecursos&controller=RecursosController'>Volver</a></p>";

?>
<style type="text/css"> img {width: 6rem; height: auto;} </style>