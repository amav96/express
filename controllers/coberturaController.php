<?php if (isset($_GET['cobertura'])) {

require_once '../model/cobertura.php';
require_once '../model/usuario.php';
require_once '../helpers/utils.php';
require_once '../config/db.php';

session_start();
$accion = $_GET['cobertura'];
$cobertura = new coberturaController();
$cobertura->$accion();
} else {

require_once 'model/cobertura.php';
require_once 'model/usuario.php';
}

class coberturaController{

public function index(){

    Utils::AuthAdmin();
    require_once  'views/admin/cobertura.php';
}

public function admin(){
    Utils::AuthAdmin();
    require_once  'vue/src/view/admin/cobertura.php';
}

//CONTADORES DE COBERTURA PARA PAGINACIONES
public function countAllCoverage(){
    
    $countAllCoverage = new cobertura();
    $countAllCoverage = $countAllCoverage-> countAllCoverage();

    if(is_object($countAllCoverage)){
        
    foreach($countAllCoverage as $element){

                $object=array(
                    'success' => true,
                    'count' => $element["count"],
                    
                );
        }
    }else{
        $object=array(
            'error' => true,
        );
    }

    $jsonstring = json_encode($object);
    echo $jsonstring;
}

public function countAllEmptyCoverage(){

    $countAllEmptyCoverage = new cobertura();
    $countAllEmptyCoverage = $countAllEmptyCoverage-> countAllEmptyCoverage();

    if(is_object($countAllEmptyCoverage)){
        
    foreach($countAllEmptyCoverage as $element){

                $object=array(
                    'success' => true,
                    'count' => $element["count"],
                    
                );
        }
    }else{
        $object=array(
            'error' => true,
        );
    }

    $jsonstring = json_encode($object);
    echo $jsonstring;

}

public function countAllHistoryCoverage(){

    $count = new Cobertura();
    $count = $count->countAllHistoryCoverage();
    if($count){
        foreach($count as $element){
                    $object=array(
                        'success' => true,
                        'count' => $element["count"],
                    );
            }
        }else{$object=array('error' => true,);}
        $jsonstring = json_encode($object);
        echo $jsonstring;

}

public function countPostalCodeRangeAndCountry(){

    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    
    $cp_start = isset($Request->cp_start) ? $Request->cp_start : false; 
    $cp_end = isset($Request->cp_end) ? $Request->cp_end : false; 
    $id_country = isset($Request->id_country) ? $Request->id_country : false;

    $count = new Cobertura();
    $count->setPostal_code($cp_start);
    $count->setPostal_code_range($cp_end);
    $count->setId_country($id_country);
    $count = $count->countPostalCodeRangeAndCountry();
    if($count){
        foreach($count as $element){
                    $object=array(
                        'success' => true,
                        'count' => $element["count"],
                    );
            }
    }else{$object=array('error' => true,);}
    
    $jsonstring = json_encode($object);
    echo $jsonstring;
}

public function countCoverageByUsers(){

    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    
    $id_user = isset($Request->id_user) ? $Request->id_user : false; 
   
    $count = new Cobertura();
    $count->setId_user($id_user);
    $count = $count->countCoverageByUsers();
     if($count){
         foreach($count as $element){
                     $object=array(
                         'success' => true,
                         'count' => $element["count"],
                     );
             }
     }else{$object=array('error' => true,);}
    
     $jsonstring = json_encode($object);
     echo $jsonstring;

}

//CONTADORES FILTRO

public function countFilterAllHistoryCoverage(){

    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    $filter = isset($Request->filter) ? $Request->filter : false; 

    $count = new Cobertura();
    $count->setFilter($filter);
    $count = $count->countFilterAllHistoryCoverage();
    // if($count){
    //     foreach($count as $element){
    //                 $object=array(
    //                     'success' => true,
    //                     'count' => $element["count"],
    //                 );
    //         }
    //     }else{$object=array('error' => true,);}
    //     $jsonstring = json_encode($object);
    //     echo $jsonstring;

}

public function countFilterByWordByPostalCodeRangeAndCountry(){
  
    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    
    $cp_start = isset($Request->cp_start) ? $Request->cp_start : false; 
    $cp_end = isset($Request->cp_end) ? $Request->cp_end : false; 
    $id_country = isset($Request->id_country) ? $Request->id_country : false; 
    $filter = isset($Request->filter) ? $Request->filter : false; 

    $count = new Cobertura();
    $count->setPostal_code($cp_start);
    $count->setPostal_code_range($cp_end);
    $count->setId_country($id_country);
    $count->setFilter($filter);
    $count = $count->countFilterByWordByPostalCodeRangeAndCountry();
    if($count){
        foreach($count as $element){
                    $object=array(
                        'success' => true,
                        'count' => $element["count"],
                    );
            }
        }else{$object=array('error' => true,);}
        $jsonstring = json_encode($object);
        echo $jsonstring;
}

public function countFilterEmptyCoverage(){

    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
  
    $filter = isset($Request->filter) ? $Request->filter : false; 

    $count = new Cobertura();
    $count->setFilter($filter);
    $count = $count->countFilterEmptyCoverage();
    if($count){
        foreach($count as $element){
                    $object=array(
                        'success' => true,
                        'count' => $element["count"],
                    );
            }
        }else{$object=array('error' => true,);}
        $jsonstring = json_encode($object);
        echo $jsonstring;

}

//BUSCADORES DIRECTOS DE COBERTURA PARA TABLAS

public function getAllCoverage(){
    Utils::AuthAdmin();
    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $request =  json_decode($dataRequest);
    $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
    $limit = isset($request->limit) ? $request->limit : false;

    $get = new cobertura();
    $get->setFromRow($fromRow);
    $get->setLimit($limit);
    $get = $get-> getAllCoverage();
    if($get){$this->showCoverage($get);}
    else{
        $object=array('error' => true);
        $jsonstring = json_encode($object); echo $jsonstring;
    }
}

public function getAllEmptyCoverage(){
    Utils::AuthAdmin();
    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $request =  json_decode($dataRequest);
    $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
    $limit = isset($request->limit) ? $request->limit : false;

    $get = new cobertura();
    $get->setFromRow($fromRow);
    $get->setLimit($limit);
    $get = $get-> getAllEmptyCoverage();
    if($get){$this->showCoverage($get);}
    else{
        $object=array('error' => true);
        $jsonstring = json_encode($object); echo $jsonstring;
    }

}

public function getAllHistoryCoverage(){

    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
    $limit = isset($Request->limit) ? $Request->limit : false;

    $get = new cobertura();
    $get->setFromRow($fromRow);
    $get->setLimit($limit);
    $get = $get-> getAllHistoryCoverage();
    if($get){$this->showCoverage($get);}
    else{
        $object=array('error' => true);
        $jsonstring = json_encode($object); echo $jsonstring;
    }

}

public function getPostalCodeRangeAndCountry(){
   
    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);

    $cp_start = isset($Request->cp_start) ? $Request->cp_start : false; 
    $cp_end = isset($Request->cp_end) ? $Request->cp_end : false; 
    $id_country = isset($Request->id_country) ? $Request->id_country : false; 
    $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
    $limit = isset($Request->limit) ? $Request->limit : false;

    $get = new Cobertura();
    $get->setPostal_code($cp_start);
    $get->setPostal_code_range($cp_end);
    $get->setId_country($id_country);
    $get->setFromRow($fromRow);
    $get->setLimit($limit);
    $get = $get->getPostalCodeRangeAndCountry();
    if($get){$this->showCoverage($get);}
    else{
        $object=array('error' => true);
        $jsonstring = json_encode($object); echo $jsonstring;
    }
}

public function getCoverageByUsers(){
    
    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    
    $id_user = isset($Request->id_user) ? $Request->id_user : false; 
    $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
    $limit = isset($Request->limit) ? $Request->limit : false;
   
    $get = new Cobertura();
    $get->setId_user($id_user);
    $get->setFromRow($fromRow);
    $get->setLimit($limit);

    $get = $get->getCoverageByUsers();
    if($get){$this->showCoverage($get);}
    else{
        $object=array('error' => true);
        $jsonstring = json_encode($object); echo $jsonstring;
    }

}


//BUSCADORES FILTRO

public function getFilterByWordByPostalCodeRangeAndCountry(){
    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    
    $cp_start = isset($Request->cp_start) ? $Request->cp_start : false; 
    $cp_end = isset($Request->cp_end) ? $Request->cp_end : false; 
    $id_country = isset($Request->id_country) ? $Request->id_country : false; 
    $filter = isset($Request->filter) ? $Request->filter : false;
    $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
    $limit = isset($Request->limit) ? $Request->limit : false; 
    
    $get = new Cobertura();
    $get->setPostal_code($cp_start);
    $get->setPostal_code_range($cp_end);
    $get->setId_country($id_country);
    $get->setFilter($filter);
    $get->setFromRow($fromRow);
    $get->setLimit($limit);

    $get = $get->getFilterByWordByPostalCodeRangeAndCountry();
    if($get){$this->showCoverage($get);}
    else{
        $object=array('error' => true);
        $jsonstring = json_encode($object); echo $jsonstring;
    }

}

public function getFilterEmptyCoverage(){

    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $Request =  json_decode($dataRequest);
    
    $filter = isset($Request->filter) ? $Request->filter : false;
    $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
    $limit = isset($Request->limit) ? $Request->limit : false; 
    
    $get = new Cobertura();
    $get->setFilter($filter);
    $get->setFromRow($fromRow);
    $get->setLimit($limit);

    $get = $get->getFilterEmptyCoverage();
    if($get){$this->showCoverage($get);}
    else{
        $object=array('error' => true);
        $jsonstring = json_encode($object); echo $jsonstring;
    }

}

// BUSCADORES DIRECTOS QUE RECUPERAN DATOS LUEGO DE INSERTAR, ACTUALIZAR O 

public function getRecentCodes(){
    Utils::AuthAdmin();
    $postal_code = isset($_GET['postal_code']) ? $_GET['postal_code'] : false ;
    $created_at = isset($_GET['created_at']) ? $_GET['created_at'] : false ;

    $getRecentCodes = new Cobertura();
    $getRecentCodes->setPostal_code($postal_code);
    $getRecentCodes->setCreated_at($created_at);
    $getRecentCodes = $getRecentCodes->getRecentCodes();

    if($getRecentCodes){
        
        foreach($getRecentCodes as $element){
    
                    $arrayDateTime = explode(' ', trim($element["created_at"]));
                    $arrayDate = explode('-',$arrayDateTime[0]);
                    $dateFormated = $arrayDate[2].'/'.$arrayDate[1].'/'.$arrayDate[0];
                    $dateTimeFormated = $dateFormated.' '.$arrayDateTime[1];
    
                    $object[]=array(
                        'success' => true,
                        'id' => $element["id"],
                        'postal_code' => $element["postal_code"],
                        'locate' => $element["locate"],
                        'home_address' => $element["home_address"], 
                        'provinceInt' => $element["provinceInt"], 
                        'province' => $element["province"],
                        'name_country' => $element['name_country'],
                        'type' => $element["type"],
                        'id_user' => $element["id_user"],
                        'name_assigned' => $element["id_user"],
                        'customer_service_hours' => $element["customer_service_hours"],
                        'lat' => $element["lat"],
                        'lng' => $element["lng"],
                        'created_at' => $dateTimeFormated
                    );
            }
        }else{
            $object=array(
                'error' => true,
            );
        }

    $jsonstring = json_encode($object);
    echo $jsonstring;
}

//ACCIONES


public function save(){
    Utils::AuthAdmin();
     $id_country = isset($_GET['id_country']) ? $_GET['id_country'] : false ;
     $id_province = isset($_GET['id_province']) ? $_GET['id_province'] : false ;
     $id_locate = isset($_GET['id_locate']) ? $_GET['id_locate'] : false ;
     $postal_code = isset($_GET['postal_code']) ? $_GET['postal_code'] : false ;
     $home_address = isset($_GET['home_address']) ? $_GET['home_address'] : false ;
     $lat = isset($_GET['lat']) ? $_GET['lat'] : false ;
     $lng = isset($_GET['lng']) ? $_GET['lng'] : false ;
     $id_user = isset($_GET['id_user']) && !empty($_GET['id_user'])? $_GET['id_user'] : false ;
     $type = isset($_GET['type']) ? $_GET['type'] : false ;
     $admin = isset($_GET['admin']) ? $_GET['admin'] : false ;
     $created_at = isset($_GET['created_at']) ? $_GET['created_at'] : false ;
     $timeSchedule = isset($_GET['timeSchedule']) ? $_GET['timeSchedule'] : false ;

        $save = new cobertura();
        $save->setId_country($id_country);
        $save->setLocate($id_locate);
        $save->setProvince($id_province);
        $save->setHome_address($home_address);
        $save->setType($type);
        $save->setId_user($id_user);
        $save->setUser_managent_id($admin);
        $save->setCreated_at($created_at);
        $save->setCustomer_service_hours($timeSchedule);
        $save->setLat($lat);
        $save->setLng($lng);
        $save->setPostal_code($postal_code);

        if($id_user){
        
            $verifyNotExistUser = $save->verifyNotExistUser();
        }else {
           
            $verifyNotExistUser = false;
        }
        
        if($verifyNotExistUser){
            foreach($verifyNotExistUser as $element){
                    $object[] = array(
                        'error'         => 'exist',
                        'name_user'     => $element["name"].' '.$element["name_alternative"],
                        'postal_code'   => $element["postal_code"]
                    );
            }
        }else{ 
            $execute = count($postal_code);
            for($i=0;$i<count($postal_code);$i++){
                $save->setPostal_code($postal_code[$i]);
                $save->save();
                $execute--;
            }
            if($execute === 0){
                $save->setPostal_code($postal_code);
                $getRecentCodes = $save->getRecentCodes();
                if($getRecentCodes){

                    foreach($getRecentCodes as $element){
        
                        $arrayDateTime = explode(' ', trim($element["created_at"]));
                        $arrayDate = explode('-',$arrayDateTime[0]);
                        $dateFormated = $arrayDate[2].'/'.$arrayDate[1].'/'.$arrayDate[0];
                        $dateTimeFormated = $dateFormated.' '.$arrayDateTime[1];
        
                        $object[]=array(
                            'success' => true,
                            'id' => $element["id"],
                            'postal_code' => $element["postal_code"],
                            'locate' => $element["locate"],
                            'home_address' => $element["home_address"], 
                            'provinceInt' => $element["provinceInt"], 
                            'province' => $element["province"],
                            'name_country' => $element['name_country'],
                            'type' => $element["type"],
                            'id_user' => $element["id_user"],
                            'name_assigned' => $element["id_user"],
                            'customer_service_hours' => $element["customer_service_hours"],
                            'lat' => $element["lat"],
                            'lng' => $element["lng"],
                            'created_at' => $dateTimeFormated
                        );
                }
                
                }else{
                    $object = array(
                        'error' => 'not_result'
                    );
                }
            }else {
                $object = array(
                    'error' => 'not_insert_complete'
                );
            }
           
        }
     
        $jsonstring = json_encode($object);
        echo $jsonstring;
}

public function delete(){
    $id = isset($_GET['id']) ? $_GET['id'] : false ;
    $admin = isset($_GET['admin']) ? $_GET['admin'] : false ;
    $created_at = isset($_GET['created_at']) ? $_GET['created_at'] : false ;

    $delete = new Cobertura();
    $delete->setId($id);
    $delete->setUser_managent_id($admin);
    $delete->setCreated_at($created_at);

    if($delete->removeToHistory()){
        if($delete->delete()){$object= array('success' => true,);}
        else {$object= array('error' => 'not_delete',);}
    }
    else {$object= array('error' => 'not_removeToHistory',);}
   
    $jsonstring = json_encode($object);
    echo $jsonstring;
}

public function update(){

    $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
    $request =  json_decode($dataRequest);
    Utils::AuthAdmin();
    
    $home_address = isset($request->home_address) ? $request->home_address : false ;
    $lat = isset($request->lat) ? $request->lat : false ;
    $lng = isset($request->lng) ? $request->lng : false ;
    $id_user = isset($request->id_user) && !empty($request->id_user)? $request->id_user : false ;
    $type = isset($request->type) ? $request->type : false ;
    $admin = isset($request->admin) ? $request->admin : false ;
    $created_at = isset($request->created_at) ? $request->created_at : false ;
    $timeSchedule = isset($request->timeSchedule) ? $request->timeSchedule : false ;

    $update = new cobertura();
    $update->setId_user($id_user);
    $update->setHome_address($home_address);
    $update->setType($type);
    $update->setUser_managent_id($admin);
    $update->setCreated_at($created_at);
    $update->setCustomer_service_hours($timeSchedule);
    $update->setLat($lat);
    $update->setLng($lng);
    $idModified[]='';
    $object= false;
    $process = false;
    foreach ($request as $element){
        if (gettype($element) === 'array'){
            foreach ($element as $childElement){
                $update->setId($childElement->id);
                $update->setPostal_code($childElement->postal_code);
                    if(!$update->verifyExist()){
                        if($update->removeToHistory()){
                            if($update->update()){
                                array_push($idModified,$childElement->id);
                                $process = true;
                            } else {$object=array('error' => 'not_update');}
                        } else {$object=array('error' => 'not_removeToHistory');}
                    }else {
                        if($update->removeToHistory()){
                            if($update->delete()){true;}
                            else {$object=array('error' => 'not_delete');}
                        }else {$object=array('error' => 'not_removeToHistory');}
                    }
            }
        }  
    }

    if($process){
        $idFinally = array_filter($idModified);
        $update->setId($idFinally);
        if($update->getCodesById()){
           $this->showCoverage($update->getCodesById());
        }
    }
    else {$object=array('error' => 'not_process');}
    if(is_array($object)){
        $jsonstring = json_encode($object);echo $jsonstring;
    }
}

public function showCoverage($response){
    if($response){
        foreach ($response as $element){
            $object[]=array(
                'success' => true,
                'id' => $element["id"],
                'postal_code' => $element["postal_code"],
                'locate' => $element["locate"],
                'home_address' => $element["home_address"], 
                'provinceInt' => $element["provinceInt"], 
                'province' => $element["province"],
                'name_country' => $element['name_country'],
                'type' => $element["type"],
                'id_user' => $element["id_user"],
                'name_assigned' => $element["id_user"],
                'customer_service_hours' => $element["customer_service_hours"],
                'lat' => $element["lat"],
                'lng' => $element["lng"],
                'created_at' => $this->getDataTime($element["created_at"])
            );
        }
    }

    $jsonstring = json_encode($object);
    echo $jsonstring;
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

// SCOPE

public function getUsersCollector(){

    Utils::AuthAdmin();
    $getUsersCollector = new Usuario();
    $getUsersCollector = $getUsersCollector->getUsersCollector();

    if($getUsersCollector){
        foreach ($getUsersCollector as $element){
            $object[] = array(
                'success' => true,
                'id' => $element["id"],
                'name_user' => $element["name_user"],
                'slug' => $element["name_user"].' '.'ID: '.$element["id"],
            );
        }
        
    }else {
        $object = array(
            'error' => true,
        );

    }

    $jsonstring = json_encode($object);
    echo $jsonstring;

}

public function getUsersCommerce(){

    Utils::AuthAdmin();
    $getUsersCommerce = new Usuario();
    $getUsersCommerce = $getUsersCommerce->getUsersCommerce();

    if($getUsersCommerce){
        foreach ($getUsersCommerce as $element){
            $object[] = array(
                'success' => true,
                'id' => $element["id"],
                'name_user' => $element["name_user"],
                'slug' => $element["name_user"].' '.'ID: '.$element["id"].' '.'Prov: '.$element["province"],
                'country' => $element["country"],
                'province' => $element["province"],
                'locate' => $element["location"],
                'home_address' => $element["home_address"],
                'customer_service_hours' => $element["customer_service_hours"],
                
            );
        }
        
    }else {
        $object = array(
            'error' => true,
        );

    }

    $jsonstring = json_encode($object);
    echo $jsonstring;
}

public function getCountry(){
    $getCountry = new Cobertura();
    $getCountry = $getCountry->getCountry();

    if($getCountry){
        foreach ($getCountry as $element){
            $object[]=array(
                'id'    => $element["id"],
                'slug'  => $element["country"]
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

public function getProvinceById(){
    $id = isset($_GET['id']) ? $_GET['id'] : false ;
    if($id){

        $getProvinceById = new Cobertura();
        $getProvinceById->setId($id);
        $getProvinceById = $getProvinceById->getProvinceById();
        if($getProvinceById){
            foreach ($getProvinceById as $element){
                $object[]=array(
                    'id'    => $element["id"],
                    'slug'  => $element["province"]
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

public function getLocateById(){
    $id = isset($_GET['id']) ? $_GET['id'] : false ;
    if($id){

        $getLocateById = new Cobertura();
        $getLocateById->setId($id);
        $getLocateById = $getLocateById->getLocateById();
        if($getLocateById){
            foreach ($getLocateById as $element){
                $object[]=array(
                    'id'    => $element["id"],
                    'slug'  => $element["locate"]
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

public function getPostalCodeByLocateAndProvinceAndCountry(){
    $id_country = isset($_GET['id_country']) ? $_GET['id_country'] : false ;
    $id_province = isset($_GET['id_province']) ? $_GET['id_province'] : false ;
    $locate = isset($_GET['locate']) ? $_GET['locate'] : false ;

    $getPostalCodeByLocateAndProvinceAndCountry = new Cobertura();
    $getPostalCodeByLocateAndProvinceAndCountry->setId_country($id_country);
    $getPostalCodeByLocateAndProvinceAndCountry->setProvince($id_province);
    $getPostalCodeByLocateAndProvinceAndCountry->setLocate($locate);
    $getPostalCodeByLocateAndProvinceAndCountry = $getPostalCodeByLocateAndProvinceAndCountry->getPostalCodeByLocateAndProvinceAndCountry();

    if($getPostalCodeByLocateAndProvinceAndCountry){
        foreach ($getPostalCodeByLocateAndProvinceAndCountry as $element){
                $object[]=array(
                    'postal_code'    => $element["postal_code"],
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

public function getAllPointInZone(){

    $country = isset($_GET['country']) ? $_GET['country'] : false ;
    $cp_start = isset($_GET['cp_start']) ? $_GET['cp_start'] : false ;
    $cp_end = isset($_GET['cp_end']) ? $_GET['cp_end'] : false ;
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : false ;

    $getAllPointInZone = new cobertura();
    $getAllPointInZone->setId_country($country);
    $getAllPointInZone->setPostal_code($cp_start);
    $getAllPointInZone->setPostal_code_range($cp_end);
    $getAllPointInZone->setId_user($id_user);
    $getAllPointInZone = $getAllPointInZone->getAllPointInZone();

    if($getAllPointInZone){
        foreach ($getAllPointInZone as $element){
                $object[]= array(
                    'id' => $element["id"],
                    'postal_code' => $element["postal_code"],
                    'locate' => $element["locate"],
                    'province' => $element["province"],
                    'country' => $element["country"],
                    'type' => $element["type"],
                    'id_user' => $element["id_user"],
                    'name' => $element["name"].' '.$element["name_alternative"],
                    'repeat' => false
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