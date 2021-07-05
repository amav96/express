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

    public function getAllEquipos(){
        // Utils::AuthAdmin();

        
        $Request = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
      
        $request =  json_decode($Request);
        $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
        $limit = isset($request->limit) ? $request->limit : false;

        $get = new Asignacion();

        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countAllEquipos();
        if($count){
            $data = $get->getAllEquipos();
            if($data){
                $this->showEquipments($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }
    }

    // HELPERS

    public function showEquipments($count,$data){

        if($count && $data){
        
            foreach ($count as $dataCounter){
            $arrCount = $dataCounter["count"];
            }

            foreach($data as $dataResponse){
            $arrData[]=array(
                    'success' => true,
                    'id' => $dataResponse["id"],
                    'identificacion' => $dataResponse["identificacion"],
                    'id_user_assigned' => $dataResponse["id_user_assigned"],
                    'estado' => $dataResponse["estado"],
                    'empresa' => $dataResponse["empresa"],
                    'terminal' => $dataResponse["terminal"],
                    'serie' => $dataResponse["serie"],
                    'serie_base' => $dataResponse["serie_base"],
                    'tarjeta' => $dataResponse["tarjeta"],
                    'created_at' => $this->getDataTime($dataResponse["created_at"]),
                    'nombre_cliente' => $dataResponse["nombre_cliente"],
                    'direccion' => $dataResponse["direccion"],
                    'provincia' => $dataResponse["provincia"],
                    'localidad' => $dataResponse["localidad"],
                    'codigo_postal' => $dataResponse["codigo_postal"],
                    'digito' => $dataResponse["digito"],
                    'name_assigned' => $dataResponse["name"],
                    'name_alternative' => $dataResponse["name_alternative"],
                    'belongs' => $this->getUserByZone($dataResponse["codigo_postal"],$dataResponse["digito"]),
                
            );
        }

        $object = array(
            'count' => $arrCount,
            'data' => $arrData
        );
    
        $jsonstring = json_encode($object);
        echo $jsonstring;
        }
    }

    public function getDataTime($data){
        if($data){
            $arrayDateTime = explode(' ', trim($data));
            $arrayDate = explode('-',$arrayDateTime[0]);
            $dateFormated = $arrayDate[2].'/'.$arrayDate[1].'/'.$arrayDate[0];
            $dateTimeFormated = $dateFormated.' '.$arrayDateTime[1];
            return $dateTimeFormated;
        }else {
            return '';
        }
    }

    public function getUserByZone($zone,$identification){
        echo '<pre>';
        print_r('zona-> '.$zone);
        echo '</pre>';
        echo '<pre>';
        print_r('digito-> '.$identification);
        echo '</pre>';
    }

   

    

}