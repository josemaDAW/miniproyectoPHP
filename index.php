<?php                                               # CONTROLADOR PRINCIPAL
#iniciamos la sesión
session_start();

#Cargamos la seguridad e
include_once ("seguridad.php");



// Hacemos include de todos los controladores
foreach (glob("controller/*.php") as $file) {
    include $file;
}

// Miramos el valor de la variable "controller", si existe. Si no, le asignamos un controlador por defecto
if (isset($_REQUEST["controller"])) {
    $controller = $_REQUEST["controller"];
} else {
    $controller = "UsuariosController";  // Controlador por defecto
} 

// Miramos el valor de la variable "action", si existe. Si no, le asignamos una acción por defecto
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "formLogin";  // Acción por defecto
}

// Creamos un objeto de tipo $controller y llamamos al método $action()
$recursos = new $controller();
$recursos->$action();


