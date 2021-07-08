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

    // DATA
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

    public function getFilterEquipos(){

        $Request = json_decode($_GET['dataRequest']);
        
        $filter = isset($Request->filter) ? $Request->filter : false ; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false ; 
        $limit = isset($Request->limit) ? $Request->limit : false ;

        $get = new Asignacion();
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countFilterEquipos();
            if($count){
                $data = $get->getFilterEquipos();
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
                    'cartera' => $dataResponse["cartera"],
                    'pais' => $dataResponse["pais"],
                    'codigo_postal' => $dataResponse["codigo_postal"],
                    'digito' => $dataResponse["digito"],
                    'name_assigned' => $dataResponse["name"],
                    'name_alternative' => $dataResponse["name_alternative"],
                    'belongs' => $this->getZoneByUserAndDigit($dataResponse["codigo_postal"],$dataResponse["digito"],$dataResponse["pais"])
                   
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

    public function getZoneByUserAndDigit($zone,$digit,$pais){

    
        $get = new Asignacion();
        $get->setPostal_code($zone);
        $get->setId_country($pais);
        $get = $get->getZoneByUserAndDigit();
        $usersAvailables=[];
        $belongsToTheUser='';
        $objectUserInRange = [];
        $totalZone = 99;
        $start=0;
        $finish='';
        $count = 1;
        $countAux = 0;
       
         if($get){
             foreach ($get as $element){
                 $usersAvailables[] = array(
                     'id_user'       => $element["id_user"],
                     'name'     => $element["name"]
                 );  
             }
         }else{
            $belongsToTheUser = false;
         }

         if($usersAvailables && count($usersAvailables) >0){
            $countUsersAvailables = count($usersAvailables);
            $dividingZone = ceil($totalZone/$countUsersAvailables);
            
            foreach($usersAvailables as $key => $element){
                $zoneCurrent = ($dividingZone*$count);
                $startNext =  ($dividingZone*$countAux);
                if($key<1){
                    $finish = $dividingZone;
                    $startNext =  ($dividingZone*$count);
                    $objectUserInRange[]= array(
                        'id_user'   => $element["id_user"],
                        'name'      => $element["name"],
                        'start'     => $start,
                        'finish'    => $finish
                    );
                }else{
                    $start = $startNext+1;
                        if($zoneCurrent >= 100){
                            $finish = $zoneCurrent-1;
                        }else{
                            $finish = $zoneCurrent;
                        }
                    $objectUserInRange[]= array(
                        'id_user'   => $element["id_user"],
                        'name'      => $element["name"],
                        'start'     => $start,
                        'finish'    => $finish
                    );
                }
                $count++;
                $countAux++;
            }
         }

         foreach ($objectUserInRange as $element){
            if($digit>=$element["start"] && $digit <= $element["finish"]){
              
                $belongsToTheUser = array(
                    'id_user'   => $element["id_user"],
                    'name'      => $element["name"]
                );
            }
         }
         return $belongsToTheUser;
         
    }

    // ACTION

    public function toAssign(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
        $update = false;
        
        foreach ($Request->value as $singleElement){

            $action = new Asignacion();
            $action->setId($singleElement->id);
            $action->setId_user($singleElement->id_user);
            $action->setCreated_at($Request->created_at);
            $action->setId_admin($Request->admin);
            $action = $action->automaticallyAssign();
            if($action){$update= true;}
            else{$update = false;}
         
        }
        
         if($update){$object = array('success' => true);}
         else{$object = array('error' => true);}

         $jsonstring = json_encode($object);
         echo $jsonstring;
    }

    public function removeAssign(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
        $remove = false;
        foreach ($Request->value as $singleElement){

             $action = new Asignacion();
             $action->setId($singleElement->id);
             $action->setCreated_at($Request->created_at);
             $action->setId_admin($Request->admin);
             $action = $action->removeAssign();
             if($action){$remove= true;}
             else{$remove = false;}
        }
        
          if($remove){$object = array('success' => true);}
          else{$object = array('error' => true);}

          $jsonstring = json_encode($object);
          echo $jsonstring;
    }


}