<?php 
if(isset($_GET['delete'])){
    $accion = $_GET['delete'];
    $usuario = new deleteController();
    $usuario->$accion();
}

class deleteController{

    public function deleteExcelFile(){

        if($_GET){

            $path = $_GET["path"];
            $arrayPath = explode('/',$path);
            $url = '../resources/excel/';
            unlink($url.$arrayPath[5]);
            // cambia a 6 cuando es local
            // unlink($url.$arrayPath[6]);
            if(!file_exists($path)){ $object = array('success' => true,);}
            else {$object = array('error' => true,);}
            $jsonstring = json_encode($object);
            echo $jsonstring;
        }   
    }

    public function deletePDF(){

        if($_GET){

            $path = $_GET["path"];
            $arrayPath = explode('/',$path);
            $url = '../resources/pdf/';
            unlink($url.$arrayPath[5]);
            // cambia a 6 cuando es local
            // unlink($url.$arrayPath[6]);
            if(!file_exists($path)){ $object = array('success' => true,);}
            else {$object = array('error' => true,);}
            $jsonstring = json_encode($object);
            echo $jsonstring;
        }   

    }

}