<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Recursos Celia</title>
</head>
<body class="menuprincipal">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="alert alert-secondary text-center" role="alert">
<h1>Bienvenid@</h1>
MENÚ DE OPCIONES
</div>
<ul class="nav justify-content-center">
  <li class="nav-item p-1">
    <a class="btn btn-outline-primary" aria-current="page" href='index.php?action=mostrarListarecursos&controller=RecursosController'>Mantenimiento de recursos</a>
  </li>
  <br>
  <li class="nav-item p-1">
    <a class="btn btn-outline-primary" href='index.php?action=mostrarListaHorario&controller=HorarioController'>Mantenimiento de tramos horarios</a> <br>
  </li>
  <li class="nav-item p-1">
    <a class="btn btn-outline-primary" href='index.php?action=mostrarListaUsuarios&controller=UsuariosController'>Mantenimiento de usuarios</a> <br>
  </li>
  <li class="nav-item p-1">
    <a class="btn btn-outline-danger" href='index.php?action=cerrarSesion&controller=RecursosController'>Cerrar sesión</a> <br>
  </li>
  
</ul>


</body>
</html>


