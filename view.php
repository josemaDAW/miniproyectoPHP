<?php

class View{
    public static function render($nombreVista, $data = null){
 
    if ($nombreVista != "menuprincipal"){
    include("views/recursos/header.php");
    include("views/recursos/nav.php");
    include("views/$nombreVista.php");
    include("views/recursos/footer.php");
    }
    else{
        include("views/$nombreVista.php");
    }

}
public static function render2($nombreVista, $data = null){
    include("views/recursos/header.php");
    //include("views/recursos/nav.php");
    include("views/usuarios/$nombreVista.php");
}

}