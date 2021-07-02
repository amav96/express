<?php

if (isset($_GET['asignacion'])) {

require_once '../model/asignacion.php';
require_once '../model/usuario.php';
require_once '../helpers/utils.php';
require_once '../config/db.php';
require_once "../vendor/autoload.php";

session_start();
$accion = $_GET['asignacion'];
$asignacion = new asignacionController();
$asignacion->$accion();

} else {

require_once 'model/asignacion.php';
require_once 'model/usuario.php';
require_once "vendor/autoload.php";
}


class asignacionController{


    public function bases(){
        Utils::AuthAdmin();
        require_once  'vue/src/view/admin/assignment.php';
    }

   

    

}