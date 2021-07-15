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
        $assigned = isset($request->assigned) ? $request->assigned : null ;


        $get = new Asignacion();

        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        if($assigned !==  null){
           $get->setCondition($assigned);
        }

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

    public function getEquiposByPostalCodeRangeAndCountry(){
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);

        $cp_start = isset($Request->numberStart) ? $Request->numberStart : false; 
        $cp_end = isset($Request->numberEnd) ? $Request->numberEnd : false; 
        $id_country = isset($Request->word->id) ? $Request->word->id : false;
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;
        $assigned = isset($Request->assigned) ? $Request->assigned : null ;

        $get = new Asignacion();
        $get->setPostal_code_start($cp_start);
        $get->setPostal_code_end($cp_end);
        $get->setId_country($id_country);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        if($assigned !==  null){
           $get->setCondition($assigned);
        }

        $count = $get->countEquiposByPostalCodeRangeAndCountry();
        if($count){
            $data = $get->getEquiposByPostalCodeRangeAndCountry();
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

    public function getEquiposByPurse(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
     
        $Request =  json_decode($dataRequest);

        $cartera = isset($Request->word) ? $Request->word: false;
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;
        $assigned = isset($Request->assigned) ? $Request->assigned : null ;

        $get = new Asignacion();
       
        $get->setCartera($cartera);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        if($assigned !==  null){
           $get->setCondition($assigned);
        }

        $count = $get->countEquiposByPurse();
        if($count){
            $data = $get->getEquiposByPurse();
            if($data){
                $cp = $get->getCpByPurse();
                if($cp){
                    $this->showEquipments($count,$data,$cp,'aux');
                }else{
                    $this->showEquipments($count,$data);
                }
                
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }

    }

    public function getEquiposByUserAssigned(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
        $id_usuario_asignado = isset($Request->word) ? $Request->word: false;
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;

        $get = new Asignacion();
        
        $get->setId_user($id_usuario_asignado);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countEquiposByUserAssigned();
        if($count){
            $data = $get->getEquiposByUserAssigned();
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

    // DATA FILTER

    public function getFilterEquipos(){

        $Request = json_decode($_GET['dataRequest']);

        $filter = isset($Request->filter) ? $Request->filter : false ; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false ; 
        $limit = isset($Request->limit) ? $Request->limit : false ;
        $assigned = isset($Request->assigned) ? $Request->assigned : null ;

    
        $get = new Asignacion();
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        
        if($assigned !==  null){
           $get->setCondition($assigned);
        }

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

    public function getFilterEquiposByPostalCodeRangeAndCountry(){

        $Request = json_decode($_GET['dataRequest']);

    
        $id_country = isset($Request->word->id) ? $Request->word->id : false ; 
        $filter = isset($Request->filter) ? $Request->filter : false ; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false ; 
        $limit = isset($Request->limit) ? $Request->limit : false ;
        $cp_start = isset($Request->numberStart) ? $Request->numberStart : false ;
        $cp_end = isset($Request->numberEnd) ? $Request->numberEnd : false ;
        $assigned = isset($Request->assigned) ? $Request->assigned : null ;

        $get = new Asignacion();
        $get->setPostal_code_start($cp_start);
        $get->setPostal_code_end($cp_end);
        $get->setId_country($id_country);
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        if($assigned !==  null){
           $get->setCondition($assigned);
        }

        $count = $get->countFilterEquiposByPostalCodeRangeAndCountry();
            if($count){
                $data = $get->getFilterEquiposByPostalCodeRangeAndCountry();
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

    public function getFilterEquiposByPurse(){

        $Request = json_decode($_GET['dataRequest']);

        $cartera = isset($Request->word) ? $Request->word: false;
        $filter = isset($Request->filter) ? $Request->filter : false ; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false ; 
        $limit = isset($Request->limit) ? $Request->limit : false ;
        $assigned = isset($Request->assigned) ? $Request->assigned : null ;
        
        $get = new Asignacion();
        $get->setCartera($cartera);
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        if($assigned !==  null){
           $get->setCondition($assigned);
        }

        $count = $get->countFilterEquiposByPurse();
            if($count){
                $data = $get->getFilterEquiposByPurse();
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

    public function getFilterEquiposByUserAssigned(){

        $Request = json_decode($_GET['dataRequest']);

     
        $filter = isset($Request->filter) ? $Request->filter : false ; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false ; 
        $limit = isset($Request->limit) ? $Request->limit : false ;
        $id_usuario_asignado = isset($Request->word) ? $Request->word: false;
        
        $get = new Asignacion();
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        $get->setId_user($id_usuario_asignado);

        $count = $get->countFilterEquiposByUserAssigned();
            if($count){
                $data = $get->getFilterEquiposByUserAssigned();
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
            if(isset($Request->dateRange) && $Request->dateRange && $Request->dateRange !== null){
                $action->setDateRange($Request->dateRange);
            }
           
            $action = $action->toAssign();
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

    // HELPERS

    public function showEquipments($count,$data,$aux = null,$name = null){

    
        if($count && $data){
        
            foreach ($count as $dataCounter){
            $arrCount = $dataCounter["count"];
            }

            foreach($data as $dataResponse){
                $arrData[]=array(
                        'success' => true,
                        'id' => $dataResponse["id"],
                        'identificacion' => $dataResponse["identificacion"],
                        'id_usuario_asignado' => $dataResponse["id_usuario_asignado"],
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
                        'name_assigned' => $dataResponse["name"],
                        'name_alternative' => $dataResponse["name_alternative"],
                        'belongs' => $this->getUserByZoneAndDigit($dataResponse["codigo_postal"],substr($dataResponse["identificacion"],-2),$dataResponse["pais"])
                );
        }

        if($aux !== null && $name !== null){

            foreach($aux as $dataResponse){
                $arrAux[]=array(
                    'id'    => $dataResponse["codigo_postal"],
                    'slug'  => $dataResponse["codigo_postal"]
                );
            }

            $object = array(
                $name => $arrAux,
                'count' => $arrCount,
                'data' => $arrData
            );
           
        }else{

            $object = array(
                'count' => $arrCount,
                'data' => $arrData
            );

        }
    
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

    public function getUserByZoneAndDigit($zone,$digit,$pais){

        $get = new Asignacion();
        $get->setPostal_code($zone);
        $get->setId_country($pais);
        $get = $get->getUserByZoneAndDigit();
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

    public function  getAllWallets(){

        $get = new Asignacion();
        $get = $get->getAllWallets();

        if($get){
            foreach ($get as $element){
                $object[]=array(
                    'id'    => $element["cartera"],
                    'slug'  => $element["cartera"]
                );
            }
        }else {
            $object = array(
                'error' => true
            );
        }
    
        $jsonstring = json_encode($object);
        echo $jsonstring;



    }


}