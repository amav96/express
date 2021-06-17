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


    //BUSCADORES DIRECTOS DE COBERTURA PARA TABLAS

    public function getAllCoverage(){
        
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;

        $get = new cobertura();
        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countAllCoverage();
        if($count){
            $data = $get->getAllCoverage();
            if($data){
                $this->showCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }

    }

    public function getAllEmptyCoverage(){
        //  Utils::AuthAdmin();
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $request =  json_decode($dataRequest);
        $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
        $limit = isset($request->limit) ? $request->limit : false;

        $get = new cobertura();
        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countAllEmptyCoverage();
        if($count){
            $data = $get->getAllEmptyCoverage();
            if($data){
                $this->showEmptyCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }

    }

    public function getAllHistoryCoverage(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $request =  json_decode($dataRequest);
        $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
        $limit = isset($request->limit) ? $request->limit : false;

        $get = new cobertura();
        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countAllHistoryCoverage();
        if($count){
            $data = $get->getAllHistoryCoverage();
            if($data){
                $this->showHistoryCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }

    }

    public function getPostalCodeRangeAndCountry(){
    
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);

    

        $cp_start = isset($Request->numberStart) ? $Request->numberStart : false; 
        $cp_end = isset($Request->numberEnd) ? $Request->numberEnd : false; 
        $id_country = isset($Request->word->id) ? $Request->word->id : false;
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;

        $get = new Cobertura();
        $get->setPostal_code($cp_start);
        $get->setPostal_code_range($cp_end);
        $get->setId_country($id_country);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countPostalCodeRangeAndCountry();
        if($count){
            $data = $get->getPostalCodeRangeAndCountry();
            if($data){
                $this->showCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }
    }

    public function getCoverageByUsers(){
        
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
        
        $id_user = isset($Request->word) ? $Request->word : false; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;
    
        $get = new Cobertura();
        $get->setId_user($id_user);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);

        $count = $get->countCoverageByUsers();
        if($count){
            $data = $get->getCoverageByUsers();
            if($data){
                $this->showCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }

    }


    //BUSCADORES FILTRO

    public function getFilterCoverage(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
    
        $filter = isset($Request->filter) ? $Request->filter : false; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;

        $get = new cobertura();
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        $count = $get->countFilterCoverage();
        if($count){
            $data = $get->getFilterCoverage();
            if($data){
                $this->showCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }

    }

    public function getFilterByWordByPostalCodeRangeAndCountry(){
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
        
        $cp_start = isset($Request->numberStart) ? $Request->numberStart : false; 
        $cp_end = isset($Request->numberEnd) ? $Request->numberEnd : false; 
        $id_country = isset($Request->word->id) ? $Request->word->id : false;
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

        $count = $get->countFilterByWordByPostalCodeRangeAndCountry();
        if($count){
            $data = $get->getFilterByWordByPostalCodeRangeAndCountry();
            if($data){
                $this->showCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
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
        
        $get = new cobertura();
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        $count = $get->countFilterEmptyCoverage();
        if($count){
            $data = $get->getFilterEmptyCoverage();
            if($data){
                $this->showEmptyCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }

    }

    public function getFilterAllHistoryCoverage(){
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);
        $filter = isset($Request->filter) ? $Request->filter : false; 
        $fromRow = isset($Request->fromRow) ? $Request->fromRow : false; 
        $limit = isset($Request->limit) ? $Request->limit : false;
        
        $get = new cobertura();
        $get->setFilter($filter);
        $get->setFromRow($fromRow);
        $get->setLimit($limit);
        $count = $get->countFilterAllHistoryCoverage();
        if($count){
            $data = $get->getFilterAllHistoryCoverage();
            if($data){
                $this->showHistoryCoverage($count,$data);
            }else{
                $object=array('error' => true);
                $jsonstring = json_encode($object); echo $jsonstring;
            }
        }else{
            $object=array('error' => true);
            $jsonstring = json_encode($object); echo $jsonstring;
        }
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
        $id_user =isset($_GET['id_user']) ? $_GET['id_user'] : false ;
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
            $verifyNotExistUser = false;

            if($type === 'recolector' || $type === 'comercio'){
                $verifyNotExistUser = $save->verifyNotExistUser();
            }
            if($type === 'correo' || $type=== 'terminal'){
                $verifyNotExistUser = $save->verifyNotExistStationByCP();
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
                                'name_assigned' => $element["name_assigned"],
                                'timeScheduleA' => $element["timeScheduleA"],
                                'timeScheduleB' => $element["timeScheduleB"],
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

    public function saveEmptyCoverage(){

    
        $id_country = isset($_GET['id_country']) ? $_GET['id_country'] : false ;
        $id_province = isset($_GET['id_province']) ? $_GET['id_province'] : false ;
        $id_locate = isset($_GET['id_locate']) ? $_GET['id_locate'] : false ;
        $postal_code = isset($_GET['postal_code']) ? $_GET['postal_code'] : false ;
        $home_address = isset($_GET['home_address']) ? $_GET['home_address'] : false ;
        $lat = isset($_GET['lat']) ? $_GET['lat'] : false ;
        $lng = isset($_GET['lng']) ? $_GET['lng'] : false ;
        $id_user =isset($_GET['id_user']) ? $_GET['id_user'] : false ;
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
        
            if($save->save()){
                $getRecentCodes = $save->getRecentCodes();
                if($getRecentCodes){
                    $this->showSimpleCoverage($getRecentCodes);
                }else{
                    $object = array('error' => 'not_result');
                    $jsonstring = json_encode($object);
                    echo $jsonstring;
                }
            }else{
                $object = array('error' => 'not_save');
                $jsonstring = json_encode($object);
                echo $jsonstring;
            }
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
        $Request =  json_decode($dataRequest);

        //  Utils::AuthAdmin();
        
        $home_address = isset($Request->home_address) ? $Request->home_address : false ;
        $lat = isset($Request->lat) ? $Request->lat : false ;
        $lng = isset($Request->lng) ? $Request->lng : false ;
        $id_user = isset($Request->id_user) && !empty($Request->id_user)? $Request->id_user : false ;
        $type = isset($Request->type) ? $Request->type : false ;
        $admin = isset($Request->admin) ? $Request->admin : false ;
        $created_at = isset($Request->created_at) ? $Request->created_at : false ;
        $timeSchedule = isset($Request->timeSchedule) ? $Request->timeSchedule : false ;

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
        foreach ($Request as $element){
            if (gettype($element) === 'array'){
               
                foreach ($element as $childElement){
                    $update->setId($childElement->id);
                    $update->setPostal_code($childElement->postal_code);

                        if($type === 'recolector' || $type === 'comercio'){
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
                        if($type === 'correo' || $type === 'terminal'){

                            if(!$update->verifyExistStationByIdAndHomeAddress()){
                                if($update->removeToHistory()){
                                    if($update->update()){
                                        array_push($idModified,$childElement->id);
                                        $process = true;
                                    } else {$object=array('error' => 'not_update');}
                                } else {$object=array('error' => 'not_removeToHistory');}
                            }else {
                                if($update->removeToHistory()){
                                    if($update->delete()){
                                       true;
                                    }else {$object=array('error' => 'not_delete');}
                                }else {$object=array('error' => 'not_removeToHistory');}
                            }
                        }
                }
            }  
        }

        if($process){
            $idFinally = array_filter($idModified);
            $update->setId($idFinally);
            $get = $update->getCodesById();
            if($get){
            $this->showSimpleCoverage($get);
            }
        }
        else {$object=array('error' => 'not_process');}
        if(is_array($object)){
            $jsonstring = json_encode($object);echo $jsonstring;
        }
    }

    public function updateOnlyOne(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);

        $id = isset($Request->id) ? $Request->id : false ;
        // postal code es para verificar si existe ya en la zona
        $postal_code = isset($Request->postal_code) ? $Request->postal_code : false ;
        $home_address = isset($Request->home_address) ? $Request->home_address : false ;
        $lat = isset($Request->lat) ? $Request->lat : false ;
        $lng = isset($Request->lng) ? $Request->lng : false ;
        $id_user = isset($Request->id_user) ? $Request->id_user : false ;
        $type = isset($Request->type) ? $Request->type : false ;
        $admin = isset($Request->admin) ? $Request->admin : false ;
        $created_at = isset($Request->created_at) ? $Request->created_at : false ;
        $timeSchedule = isset($Request->timeSchedule) ? $Request->timeSchedule : false ;


        $update = new cobertura();
        $update->setId_user($id_user);
        $update->setHome_address($home_address);
        $update->setType($type);
        $update->setUser_managent_id($admin);
        $update->setCreated_at($created_at);
        $update->setCustomer_service_hours($timeSchedule);
        $update->setLat($lat);
        $update->setLng($lng);
        $update->setId($id);
        $update->setPostal_code($postal_code);
        $process = false;
        $object= false;

        if($type === 'recolector' || $type === 'comercio'){

            if(!$update->verifyExist()){
                if($update->removeToHistory()){
                    if($update->update()){
                        $process = true;
                    } else {
                        $object=array('error' => 'not_update');
                        $jsonstring = json_encode($object);echo $jsonstring;
                        return ;
                    }
                } else {
                    $object=array('error' => 'not_removeToHistory');
                    return  $jsonstring = json_encode($object);echo $jsonstring;
                }
            }else  {
                $object=array('error' => 'exist');
                $jsonstring = json_encode($object);echo $jsonstring;
                return;
        
            }
        }

      

        if($type === 'correo' || $type === 'terminal'){
            if(!$update->existSamePoint()){
                if($update->update()){
                    $process = true;
                } else {
                    $object=array('error' => 'not_update');
                    $jsonstring = json_encode($object);echo $jsonstring;
                    return ;
                }
            }else {
                $object=array('error' => 'exist');
                $jsonstring = json_encode($object);echo $jsonstring;
                return;
            }
        }
        
        if($process){
            $get = $update->getCodesById();
            if($get){
                $this->showSimpleCoverage($get);
            }else {
                $object=array('error' => 'not_result');
                $jsonstring = json_encode($object);echo $jsonstring;
                return;
            }
        }else {
            $object=array('error' => 'not_process');
            $jsonstring = json_encode($object);echo $jsonstring;
            return;
        }

    }


    public function removeAndDelete(){
        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $Request =  json_decode($dataRequest);

        $id = isset($Request->id) ? $Request->id : false ;
        $admin = isset($Request->admin) ? $Request->admin : false ;
        $motive = isset($Request->motive) ? $Request->motive : false ;
        $created_at = isset($Request->created_at) ? $Request->created_at : false ;
        if($this->validateRemoveAndDelete($Request)){
            $removeAndDelete = new cobertura();
            $removeAndDelete->setId($id);
            $removeAndDelete->setUser_managent_id($admin);
            $removeAndDelete->setMotive($motive);
            $removeAndDelete->setCreated_at($created_at);
        
            if($removeAndDelete->removeToHistory()){
                if($removeAndDelete->delete()){
                    $object=array('success' => true);
                }
            }else {$object=array('error' => 'not_remove');}

            $jsonstring = json_encode($object);echo $jsonstring;
        }
    }

    //SHOW 

    public function showCoverage($count,$data){

        if($count && $data){
        
            foreach ($count as $dataCounter){
            $arrCount = $dataCounter["count"];
            }

            foreach($data as $dataResponse){
            $arrData[]=array(
                'success' => true,
                'id' => $dataResponse["id"],
                'postal_code' => $dataResponse["postal_code"],
                'locate' => $dataResponse["locate"],
                'home_address' => $dataResponse["home_address"], 
                'provinceInt' => $dataResponse["provinceInt"], 
                'province' => $dataResponse["province"],
                'name_country' => $dataResponse['name_country'],
                'type' => $dataResponse["type"],
                'id_user' => $dataResponse["id_user"],
                'name_assigned' => $dataResponse["name_assigned"].' '.$dataResponse["name_alternative"],
                'timeScheduleA' => $dataResponse["timeScheduleA"],
                'timeScheduleB' => $dataResponse["timeScheduleB"],
                'lat' => $dataResponse["lat"],
                'lng' => $dataResponse["lng"],
                'created_at' => $this->getDataTime($dataResponse["created_at"])
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

    public function showHistoryCoverage($count,$data){

        if($count && $data){
        
            foreach ($count as $dataCounter){
            $arrCount = $dataCounter["count"];
            }

            foreach($data as $dataResponse){
            $arrData[]=array(
                'success' => true,
                'id' => $dataResponse["id"],
                'postal_code' => $dataResponse["postal_code"],
                'locate' => $dataResponse["locate"],
                'home_address' => $dataResponse["home_address"], 
                'provinceInt' => $dataResponse["provinceInt"], 
                'province' => $dataResponse["province"],
                'name_country' => $dataResponse['name_country'],
                'type' => $dataResponse["type"],
                'id_user' => $dataResponse["id_user"],
                'name_assigned' => $dataResponse["name_assigned"].' '.$dataResponse["name_alternative"],
                'timeScheduleA' => $dataResponse["timeScheduleA"],
                'timeScheduleB' => $dataResponse["timeScheduleB"],
                'status_process' => $dataResponse["status_process"],
                'motive' => $dataResponse["motive"],
                'lat' => $dataResponse["lat"],
                'lng' => $dataResponse["lng"],
                'created_at' => $this->getDataTime($dataResponse["created_at"])
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

    public function showSimpleCoverage($data){
        //este se usa para mostrar la inforamcion luego de ser insertada o actualizada
        if($data){
        
            foreach($data as $dataResponse){
            $arrData[]=array(
                'success' => true,
                'id' => $dataResponse["id"],
                'postal_code' => $dataResponse["postal_code"],
                'locate' => $dataResponse["locate"],
                'home_address' => $dataResponse["home_address"], 
                'provinceInt' => $dataResponse["provinceInt"], 
                'province' => $dataResponse["province"],
                'name_country' => $dataResponse['name_country'],
                'type' => $dataResponse["type"],
                'id_user' => $dataResponse["id_user"],
                'name_assigned' => $dataResponse["name_assigned"],
                'timeScheduleA' => $dataResponse["timeScheduleA"],
                'timeScheduleB' => $dataResponse["timeScheduleB"],
                'lat' => $dataResponse["lat"],
                'lng' => $dataResponse["lng"],
                'created_at' => $this->getDataTime($dataResponse["created_at"])
            );
        }

        $object = array(
            'data' => $arrData
        );
    
        $jsonstring = json_encode($object);
        echo $jsonstring;
        }
        
    }

    public function showEmptyCoverage($count,$data){
        if($count && $data){
        
            foreach ($count as $dataCounter){
            $arrCount = $dataCounter["count"];
            }

            foreach($data as $dataResponse){
            $arrData[]=array(
                'success' => true,
                'postal_code' => $dataResponse["postal_code"],
                'locate' => $dataResponse["locate"],
                'id_locate' => $dataResponse["id_locate"],
                'provinceInt' => $dataResponse["provinceInt"], 
                'province' => $dataResponse["province"],
                'id_province' => $dataResponse["id_province"],
                'name_country' => $dataResponse['name_country'],
                'id_country' => $dataResponse['id_country'],
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

    // HELPER

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


    //validate

    public function validateRemoveAndDelete($Request){

        if(!isset($Request->motive) || $Request->motive === '' ||$Request->motive === 0 ){
            $object=array('error' => 'Debes ingresar un motivo');
            $jsonstring = json_encode($object);echo $jsonstring;
            return false;
        }
        if(!isset($Request->admin) || $Request->admin === '' ||$Request->admin === 0 ){
            $object=array('error' => 'No se reconoce el operador/a');
            $jsonstring = json_encode($object);echo $jsonstring;
            return false;
        }
        if(!isset($Request->id) || $Request->id === '' ||$Request->id === 0 ){
            $object=array('error' => 'No hay registro seleccionado para eliminar');
            $jsonstring = json_encode($object);echo $jsonstring;
            return false;
        }

        return true;
    }

    // SCOPE


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

        $get = new Cobertura();
        $get->setId_country($id_country);
        $get->setProvince($id_province);
        $get->setLocate($locate);
        $get = $get->getPostalCodeByLocateAndProvinceAndCountry();

        if($get){
            foreach ($get as $element){
                    $object[]=array('postal_code' => $element["postal_code"],);
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

    
        $home_address = isset($_GET['home_address']) ? $_GET['home_address'] : false ;
        $type = isset($_GET['type']) ? $_GET['type'] : false ;
        $country = isset($_GET['country']) ? $_GET['country'] : false ;
        $cp_start = isset($_GET['cp_start']) ? $_GET['cp_start'] : false ;
        $cp_end = isset($_GET['cp_end']) ? $_GET['cp_end'] : false ;
        $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : false ;


        $get = new cobertura();
        $get->setId_country($country);
        $get->setPostal_code($cp_start);
        $get->setPostal_code_range($cp_end);
        $get->setId_user($id_user);
        $get->setHome_address($home_address);
    
        if($type === 'recolector' || $type=== 'comercio'){
        
            $get = $get->getPointZoneExceptUserCurrent();
        }
        if($type === 'correo' || $type=== 'terminal'){
        
            $get = $get->getAllPointExceptCpAndHomeAdressCurrent();
        }
        
        if($get){
            foreach ($get as $element){
                    $object[]= array(
                        'id' => $element["id"],
                        'postal_code' => $element["postal_code"],
                        'locate' => $element["locate"],
                        'province' => $element["province"],
                        'country' => $element["country"],
                        'home_address' => $element["home_address"],
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

    public function getMotivesDown(){
        $get = new Cobertura();
        $get = $get->getMotivesDown();
        if($get){
            foreach ($get as $element){
                $object[] = array(
                    'id'    => $element["id"],
                    'slug'  => $element["motive"]
                );
            }
        }

        $jsonstring = json_encode($object);
        echo $jsonstring;

    }

    public function hasAlreadyCommerceBeenGeocoded(){
        $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : false ;

        $get = new cobertura();
        $get->setId_user($id_user);
        $get = $get->hasAlreadyCommerceBeenGeocoded();
        if($get){
            foreach ($get as $element){
                $object= array(
                    'success'     => true,
                    'id_country'  => $element["id_country"],
                    'id_province' => $element["id_province"],
                    'id_locate'   => $element["id_locate"],
                    'home_address'=> $element["home_address"],
                    'lat'         => $element["lat"],
                    'lng'         => $element["lng"],
                );
            }
        }else {
            $object= array('error' => true);
        }

        $jsonstring = json_encode($object);
        echo $jsonstring;
        
    }

    public function hasAlreadyPointBeenGeocoded(){
        
    }


}