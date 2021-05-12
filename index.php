<?php 
session_start();
//  require_once 'config/0code.php';
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parametros.php';
require_once 'helpers/utils.php';
require_once 'resources/fpdf/fpdf.php';


function show_error(){
    $error = new errorController();
    $error->index();
}

if(isset($_GET["controller"])){
    $nombre_controlador = $_GET['controller'].'Controller';
}else if(!isset($_GET["controller"]) && !isset($_GET["action"])){
    $nombre_controlador = controller_default;
} 

else {
    show_error();
    exit();
}

if(class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador();

    if(isset($_GET["action"]) && method_exists($controlador, $_GET["action"])){

        $action = $_GET["action"];
        $controlador->$action();
    
    }
    else if(!isset($_GET["controller"]) && !isset($_GET["action"])){
        $action_default = action_default;
        $controlador->$action_default();
    }     
    else {
        show_error();
    }
}else {
    show_error();
}

?>

<script>
 const base_url = "http://localhost/express/";
 


function inactividad() {
      localStorage.clear();
      window.location.href = base_url+"/usuario/logOut";
    }
    var t = null;

    function contadorInactividad() {
      t = setTimeout("inactividad()", 20000000);
    }
    window.onblur = window.onmousemove = function() {
      if (t) clearTimeout(t);
      contadorInactividad();
    }

</script>


