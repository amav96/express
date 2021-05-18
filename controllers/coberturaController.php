<?php if (isset($_GET['cobertura'])) {

require_once '../model/cobertura.php';
require_once '../config/db.php';

session_start();
$accion = $_GET['cobertura'];
$cobertura = new coberturaController();
$cobertura->$accion();
} else {

require_once 'model/cobertura.php';
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

//BUSCADORES DIRECTOS DE COBERTURA PARA TABLAS
public function getAllCoverage(){

            $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
            $request =  json_decode($dataRequest);
            $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
            $limit = isset($request->limit) ? $request->limit : false;

            $getAllCoverage = new cobertura();
            $getAllCoverage->setFromRow($fromRow);
            $getAllCoverage->setLimit($limit);
            $getAllCoverage = $getAllCoverage-> getAllCoverage();

            if(is_object($getAllCoverage)){
                
            foreach($getAllCoverage as $element){

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








public function HistoricalInactive(){

    $HistoricalInactive = new cobertura();
    $HistoricalInactive = $HistoricalInactive-> HistoricalInactive();

    
    if(is_object($HistoricalInactive)){
                
        foreach($HistoricalInactive as $element){

                     $object[]=array(
                         'result' => '1',
                         'id' => $element["id"],
                         'postal_code' => $element["postal_code"],
                         'locate' => $element["locate"],
                         'home_address' => $element["home_address"], 
                         'province' => $element["province"],
                         'customer_service_hours' => $element["customer_service_hours"],
                         'lat' => $element["lat"],
                         'lng' => $element["lng"],
                         'operator_name' => $element["operator_name"],
                         'id_country' => $element["id_country"],
                         'detailed_type'  => $element['detailed_type'], 
                         'country_color'  => $element['country_color'], 
                         'type_color'  => $element['type_color'], 
                         'name_country' => $element['name_country'],
                         'type' => $element["type"],
                         'name' => $element["name"],
                         'id_user' => $element["id_user"],
                         'id_operator' => $element["id_operator"],
                         'motive' => $element["motive"],
                         'status_history' =>$element["status_history"], 
                         'updated_at' =>$element["updated_at"], 
                     );
        }

        }else{

            $object[]=array(
                'result' => '2',
        
            );

        }

        $jsonstring = json_encode($object);
        echo $jsonstring;



}

public function activateAgain(){

    if($_POST){

        $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false ;
        $locate = isset($_POST['object']['locate']) ? $_POST['object']['locate'] : false ;
        $province = isset($_POST['object']['province']) ? $_POST['object']['province'] : false ;
        $home_address = isset($_POST['object']['home_address']) ? $_POST['object']['home_address'] : false ;
        $type = isset($_POST['object']['type']) ? $_POST['object']['type'] : false ;
        $id_user = isset($_POST['object']['id_user']) ? $_POST['object']['id_user'] : false ;
        $name = isset($_POST['object']['name']) ? $_POST['object']['name'] : false ;
        $user_managent_id = isset($_POST['object']['user_managent_id']) ? $_POST['object']['user_managent_id'] : false ;
        $customer_service_hours = isset($_POST['object']['customer_service_hours']) ? $_POST['object']['customer_service_hours'] : false ;
        $postal_code = isset($_POST['object']['postal_code']) ? $_POST['object']['postal_code'] : false ;
        $lat = isset($_POST['object']['lat']) ? $_POST['object']['lat'] : false ;
        $lng = isset($_POST['object']['lng']) ? $_POST['object']['lng'] : false ;
        $id_operator = isset($_POST['object']['id_operator']) ? $_POST['object']['id_operator'] : false ;
        $created_at = isset($_POST['object']['created_at']) ? $_POST['object']['created_at'] : false ;


        $searchUnique = new cobertura();
        $searchUnique->setId_country($id_country);
        $searchUnique->setLocate($locate);
        $searchUnique->setProvince($province);
        $searchUnique->setHome_address($home_address);
        $searchUnique = $searchUnique->searchUnique();

        if($searchUnique){

        $activateAgain = new cobertura();
        $activateAgain->setId_country($id_country);
        $activateAgain->setLocate($locate);
        $activateAgain->setProvince($province);
        $activateAgain->setHome_address($home_address);
        $activateAgain->setType($type);
        $activateAgain->setId_user($id_user);
        $activateAgain->setName($name);
        $activateAgain->setUser_managent_id($user_managent_id);
        $activateAgain->setCustomer_service_hours($customer_service_hours);
        $activateAgain->setCreated_at($created_at);
        $activateAgain->setPostal_Code($postal_code);
        $activateAgain->setLat($lat);
        $activateAgain->setLng($lng);
        $activateAgain->setId_operator($id_operator);
        $activateAgain = $activateAgain->activateAgain();
 
        if($activateAgain){

            $searchOneCode = new cobertura();
            $searchOneCode->setId($activateAgain);
            $searchOneCode = $searchOneCode->searchOneCode();
        
            if(is_object($searchOneCode)){

                foreach($searchOneCode as $element){

                    $object[] = array(

                    'result' => '1',
                    'id'  => $element['id'], 
                    'postal_code'  => $element['postal_code'], 
                    'locate'  => $element['locate'],  
                    'home_address'  => $element['home_address'], 
                    'province'  => $element['province'],  
                    'id_country'  => $element['id_country'], 
                    'type'  => $element['type'], 
                    'name'  => $element['name'], 
                    'id_user'  => $element['id_user'], 
                    'user_managent_id'  => $element['user_managent_id'], 
                    'status'  => $element['status'], 
                    'action'  => $element['action'], 
                    'customer_service_hours'  => $element['customer_service_hours'],  
                    'lat'  => $element['lat'], 
                    'lng'  => $element['lng'], 
                    'operator_name' => $element['operator_name'], 
                    'id_operator'  => $element['id_operator'], 
                    'motive'  => $element['motive'], 
                    'detailed_type'  => $element['detailed_type'], 
                    'country_color'  => $element['country_color'], 
                    'type_color'  => $element['type_color'], 
                    'name_country' => $element['name_country'],
                    'created_at'  => $element['created_at'], 
                    'updated_at'  => $element['updated_at']

                  );
                
                }

              }else{

                $object[] = array(
                    'result' => '2'
                );

              }
            }else{

                $object[] = array(
                    'result' => '3'
                );

            }

        }else{

            $object[] = array(
                'result' => '4'
            );
    
        }
    }

        $jsonstring = json_encode($object);
              echo $jsonstring;       

}

public function save(){


            $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false ;
            $locate = isset($_POST['object']['locate']) ? $_POST['object']['locate'] : false ;
            $province = isset($_POST['object']['province']) ? $_POST['object']['province'] : false ;
            $home_address = isset($_POST['object']['home_address']) ? $_POST['object']['home_address'] : false ;
            $type = isset($_POST['object']['type']) ? $_POST['object']['type'] : false ;
            $id_user = isset($_POST['object']['id_user']) ? $_POST['object']['id_user'] : false ;
            $name = isset($_POST['object']['name']) ? $_POST['object']['name'] : false ;
            $user_managent_id = isset($_POST['object']['user_managent_id']) ? $_POST['object']['user_managent_id'] : false ;
            $customer_service_hours = isset($_POST['object']['customer_service_hours']) ? $_POST['object']['customer_service_hours'] : false ;
            $postal_code = isset($_POST['object']['postal_code']) ? $_POST['object']['postal_code'] : false ;
            $lat = isset($_POST['object']['lat']) ? $_POST['object']['lat'] : false ;
            $lng = isset($_POST['object']['lng']) ? $_POST['object']['lng'] : false ;
            $id_operator = isset($_POST['object']['id_operator']) ? $_POST['object']['id_operator'] : false ;
           
            $created_at = isset($_POST['object']['created_at']) ? $_POST['object']['created_at'] : false ;

            $save = new cobertura();
            $save->setId_country($id_country);
            $save->setLocate($locate);
            $save->setProvince($province);
            $save->setHome_address($home_address);
            $save->setType($type);
            $save->setId_user($id_user);
            $save->setName($name);
            $save->setUser_managent_id($user_managent_id);
            $save->setCustomer_service_hours($customer_service_hours);
            $save->setCreated_at($created_at);
            $save->setPostal_Code($postal_code);
            $save->setLat($lat);
            $save->setLng($lng);
            $save->setId_operator($id_operator);
            $save = $save->save();

            
              if(is_object($save)){

                //despues de haber insertado todos los datos los consulto y los devuelvo al front
                foreach($save as $element){

                    $object[] = array(

                    'result' => '1',
                    'id'  => $element['id'], 
                    'postal_code'  => $element['postal_code'], 
                    'locate'  => $element['locate'],  
                    'home_address'  => $element['home_address'], 
                    'province'  => $element['province'],  
                    'id_country'  => $element['id_country'], 
                    'type'  => $element['type'], 
                    'name'  => $element['name'], 
                    'id_user'  => $element['id_user'], 
                    'user_managent_id'  => $element['user_managent_id'], 
                    'status'  => $element['status'], 
                    'action'  => $element['action'], 
                    'customer_service_hours'  => $element['customer_service_hours'],  
                    'lat'  => $element['lat'], 
                    'lng'  => $element['lng'], 
                    'operator_name' => $element['operator_name'], 
                    'id_operator'  => $element['id_operator'], 
                    'motive'  => $element['motive'], 
                    'name_country' => $element['name_country'],
                    'created_at'  => $element['created_at'], 
                    'updated_at'  => $element['updated_at']

                   
                  );
                
                }

              }else{

                $object[] = array(
                    'result' => '2'
                );

              }

              $jsonstring = json_encode($object);
              echo $jsonstring;            
    
}

public function update(){

    if($_POST){

        //se pide postal_code para  definir el rango = no para reemplazar el codigo postal
    $home_address = isset($_POST['object']["home_address"]) ? $_POST['object']["home_address"] : false ;

    // el id es un array que trae los id que se reemplazaran( los codigos postales seleccionados en el metodo update
    // y el id seleccionado en el metodo update JS)
    $id = isset($_POST['object']["id"]) ? $_POST['object']["id"] : false ;
    $type = isset($_POST['object']["type"]) ? $_POST['object']["type"] : false ;
    $name = isset($_POST['object']["name"]) ? $_POST['object']["name"] : false ;
    $id_user = isset($_POST['object']["id_user"]) ? $_POST['object']["id_user"] : false ;
    $customer_service_hours = isset($_POST['object']["customer_service_hours"]) ? $_POST['object']["customer_service_hours"] : false ;
    $user_managent_id = isset($_POST['object']["user_managent_id"]) ? $_POST['object']["user_managent_id"] : false ;
    $lat = isset($_POST['object']['lat']) ? $_POST['object']['lat'] : false ;
    $lng = isset($_POST['object']['lng']) ? $_POST['object']['lng'] : false ;
    $id_operator = isset($_POST['object']['id_operator']) ? $_POST['object']['id_operator'] : false ;
    $created_at  = isset($_POST['object']["created_at"]) ? $_POST['object']["created_at"] : false ;

            //    consulto los id que voy a actualizar para obtener sus datos antes de actualizarlos y  los inserto
            //    en una tabla historica. 
            $beforeHistory = new cobertura();
            $beforeHistory->setId($id);

        if( $id && is_array($id) && count($id) > 0){
            $beforeHistory->setId(implode(",",$id));
        }
        $beforeHistory = $beforeHistory->lookHistory();
        
        //    si se inserto en la tabla historica, los seteo y los actualizo en la tabla coverage
        if($beforeHistory){

            $update = new cobertura();
            $update->setHome_address($home_address);
            $update->setType($type);
            $update->setId_user($id_user);
            $update->setCustomer_service_hours($customer_service_hours);
            $update->setUser_managent_id($user_managent_id);
            $update->setLat($lat);
            $update->setLng($lng);
            $update->setId_operator($id_operator);
            $update->setName($name);
            $update->setCreated_at($created_at);
        
        if( $id && is_array($id) && count($id) > 0){
            $update->setId(implode(",",$id));
        }
            $update =  $update->update();
            
        }else{

            $object []=array(
                'result' => '4'
            );
        }
        
        // si update es true es porque se ejecuto el metodo de actualizar por rango 
        // luego pido lo que actualize con el metodo searchCodes
        if($update){

                $searchCodes = new cobertura;
            if( $id && is_array($id) && count($id) > 0){
                $searchCodes->setId(implode(",",$id));
            }
                $searchCodes = $searchCodes->searchCodes();
                
                    if(is_object($searchCodes)){
                        
                        foreach($searchCodes as $element){
                
                            $object[] = array(
                                'result' => '1',
                                'id'  => $element['id'], 
                                'postal_code'  => $element['postal_code'], 
                                'locate'  => $element['locate'],  
                                'home_address'  => $element['home_address'], 
                                'province'  => $element['province'],  
                                'id_country'  => $element['id_country'], 
                                'type'  => $element['type'], 
                                'name'  => $element['name'], 
                                'id_user'  => $element['id_user'], 
                                'user_managent_id'  => $element['user_managent_id'], 
                                'status'  => $element['status'], 
                                'action'  => $element['action'], 
                                'customer_service_hours'  => $element['customer_service_hours'],  
                                'lat'  => $element['lat'], 
                                'lng'  => $element['lng'], 
                                'operator_name' => $element['operator_name'], 
                                'id_operator'  => $element['id_operator'], 
                                'name_country' => $element['name_country'], 
                                'motive'  => $element['motive'], 
                                'created_at'  => $element['created_at'], 
                                'updated_at'  => $element['updated_at']
                            );
                        }
                    }else{
                
                        $object[]=array(
                            'result' => '3',
                        );
                }
        }else{

            $object []=array(
                'result' => '2'
            );
        }

        $jsonstring= json_encode($object);
        echo $jsonstring;

    }else{
        header('Location:'.base_url);
    }
   

}

public function searchCodes(){


    $postal_code = isset($_POST['object']['postal_code']) ? $_POST['object']['postal_code'] : false ;
    $postal_code_range = isset($_POST['object']['postal_code_range']) ? $_POST['object']['postal_code_range'] : false ;
    $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false ;
    $array_id = isset($_POST['object']['id']) ? $_POST['object']['id'] : false ;

    $searchCodes = new cobertura();
    $searchCodes->setPostal_code($postal_code);
    $searchCodes->setPostal_code_range($postal_code_range);
    $searchCodes->setId_country($id_country);

    //si es un array es porque viene con la seleccion // viene del retorno de update range, los id/codigos seleccionados se usan en una segunda llamada para mostrar lo seleccionado (lo actualizado)

    if( $array_id && is_array($array_id) &&  count($array_id) > 0){
       $searchCodes->setId(implode(",",$array_id));
     }

   
    $searchCodes =  $searchCodes->searchCodes();

    if(is_object($searchCodes)){
        
        foreach($searchCodes as $element){

            $object[]=array(
                'result' => '1',
                'id' => $element["id"],
                'postal_code' => $element["postal_code"],
                'locate' => $element["locate"],
                'home_address' => $element["home_address"], 
                'province' => $element["province"],
                'customer_service_hours' => $element["customer_service_hours"],
                'lat' => $element["lat"],
                'lng' => $element["lng"],
                'operator_name' => $element["operator_name"],
                'id_country' => $element["id_country"],
                'detailed_type'  => $element['detailed_type'], 
                'country_color'  => $element['country_color'], 
                'type_color'  => $element['type_color'], 
                'name_country' => $element['name_country'],
                'type' => $element["type"],
                'name' => $element["name"],
                'id_user' => $element["id_user"]

            );
        }
     }else{
 
         $object[]=array(
             'result' => '2',
         );
 
     }
 
 
     $jsonstring = json_encode($object);
     echo $jsonstring;


}

public function searchOneCode(){

    $id = isset($_POST['object']['id']) ? $_POST['object']['id'] : false ;

    $searchCodes = new cobertura();
   
    $searchCodes->setId($id);

    $searchCodes =  $searchCodes->searchOneCode();

    if(is_object($searchCodes)){

        foreach($searchCodes as $element){

 
                  $object[]=array(

                    'result' => '1',
                    'id'  => $element['id'], 
                    'postal_code'  => $element['postal_code'], 
                    'locate'  => $element['locate'],  
                    'home_address'  => $element['home_address'], 
                    'province'  => $element['province'],  
                    'id_country'  => $element['id_country'], 
                    'type'  => $element['type'], 
                    'name'  => $element['name'], 
                    'id_user'  => $element['id_user'], 
                    'user_managent_id'  => $element['user_managent_id'], 
                    'status'  => $element['status'], 
                    'action'  => $element['action'], 
                    'customer_service_hours'  => $element['customer_service_hours'],  
                    'lat'  => $element['lat'], 
                    'lng'  => $element['lng'], 
                    'operator_name' => $element['operator_name'], 
                    'id_operator'  => $element['id_operator'], 
                    'motive'  => $element['motive'], 
                    'detailed_type'  => $element['detailed_type'], 
                    'country_color'  => $element['country_color'], 
                    'type_color'  => $element['type_color'], 
                    'name_country' => $element['name_country'],
                    'created_at'  => $element['created_at'], 
                    'updated_at'  => $element['updated_at']
            );

                
        }
     }else{
 
         $object[]=array(
             'result' => '2',
         );
 
     }
 
 
     $jsonstring = json_encode($object);
     echo $jsonstring;

}

public function delete(){

    $user_managent_id = isset($_POST['object']['user_managent_id']) ? $_POST['object']['user_managent_id'] : false ;
    $id = isset($_POST['object']['id']) ? $_POST['object']['id'] : false ;
    $motive = isset($_POST['object']['motive']) ? $_POST['object']['motive'] : false ;
    $status = 'down';

            $beforeHistory = new cobertura();
            $beforeHistory->setId($id);
            $beforeHistory->setUser_managent_id($user_managent_id);
            $beforeHistory->setMotive($motive);
            $beforeHistory->setStatus($status);
            

        if( $id && is_array($id) && count($id) > 0){
            $beforeHistory->setId(implode(",",$id));
        }

        $beforeHistory = $beforeHistory->lookHistory();

        if($beforeHistory){

        $delete = new cobertura();   
        if( $id && is_array($id) && count($id) > 0){
            $delete->setId(implode(",",$id));
        } 
        $delete = $delete->delete();

    }else{

        $object []=array(
            'result' => '2'
        );
    }

        if($delete){

            $object []=array(
                'result' => '1'
            );

        }else{

            $object []=array(
                'result' => '2'
            );

        }

    $jsonstring= json_encode($object);
    echo $jsonstring;

}

public function getUsers(){

        $get_country = isset($_POST["object"]["id_country"]) ? $_POST["object"]["id_country"] : false ;
        $id_country = $get_country === '1' ? 'Argentina' : 'Uruguay';
        $type = isset($_POST["object"]["type"]) ? $_POST["object"]["type"] : false ; 
        $id_user =  isset($_POST["object"]["id_user"]) ? $_POST["object"]["id_user"] : false ; 
          
        $getUsers = new cobertura();
        $getUsers->setId_country($id_country);    

        //si el objeto viene con all es para obtener los usuarios por pais y por role 

        if($_POST["object"]["centinel"] === 'all'){
      
        $getUsers->setType($type);

       }else if($_POST["object"]["centinel"] === 'one'){
       
        $getUsers->setId_user($id_user);

       }

        $getUsers = $getUsers->getUsers();

        if(is_object($getUsers)){

            foreach($getUsers as $element){

                $object[]=array(
                    'result' => '1',
                    'id' => $element["id"],
                    'name' => $element["name"],
                    'name_alternative' => $element["name_alternative"],
                    'home_address' => $element["home_address"],
                    'phone_number' => $element["phone_number"],
                    'customer_service_hours' => $element["customer_service_hours"],
                    'role' => $element["role"],
                    'province' => $element["province"],
                    'location' => $element["location"],
                    'postal_code' => $element["postal_code"]
                ); 
            }

        }else{
            $object[]=array(
                'result' => '2'
            );
        }

       
        

        $jsonstring =  json_encode($object);
        echo $jsonstring;
}

public function getOperators(){

    if($_POST){

        $postal_code = isset($_POST['object']['postal_code']) ? $_POST['object']['postal_code'] : false ;
        $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false ;

            $getOperators = new cobertura();
            $getOperators->setPostal_code($postal_code);
            $getOperators->setId_country($id_country);
            $getOperators = $getOperators->getOperators();

            if(is_object($getOperators)){

                
                foreach($getOperators as $element){

                    $object[] = array(
                        'result' => '1',
                        'id' => $element["id_user"],
                        'name' => $element["name"],
                    );

                }

            }else {

                $object[] = array(
                    'result' => '2',
                );

            }

            $jsonstring = json_encode($object);
            echo $jsonstring;


    }
}

public function getProvince(){

   $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false ;

   $getProvince = new cobertura;
   $getProvince->setId_country($id_country);
   $getProvince = $getProvince->province();

   if(is_object($getProvince)){

      foreach($getProvince as $province){

        $object[] = array(
            'result' => '1',
            'id' => $province["id"],
            'province' => $province["province"]
        );

      }

   }else{

    $object[] = array(

        'result' => '2'
    );

   }

   $jsonstring =  json_encode($object);
   echo $jsonstring;
}

public function getLocate(){

   
    if(isset($_POST["id_province"]) && isset($_POST["id_country"])){

        $id_province = $_POST["id_province"];
        $id_country = $_POST["id_country"];

    }else{
        $id_province = isset($_POST['object']['id_province']) ? $_POST['object']['id_province'] : false ;
        $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false ;
    }

   $getLocate = new cobertura;
   $getLocate->setProvince($id_province);
   $getLocate->setId_country($id_country);
   $getLocate = $getLocate->locate();

   if(is_object($getLocate)){

      foreach($getLocate as $locate){

        $object[] = array(
            'result' => '1',
            'locate' => $locate["locate"],
            'postal_code' => $locate["postal_code"]
        );

      }

   }else{

    $object[] = array(

        'result' => '2'
    );

   }

   $jsonstring =  json_encode($object);
   echo $jsonstring;

}

public function getAllCpByZone(){

     if($_POST){

        $locate = isset($_POST['object']['locate']) ? $_POST['object']['locate'] : false ;
        $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false ;
        $id_province = isset($_POST['object']['id_province']) ? $_POST['object']['id_province'] : false ;

    
        $getAllCpByZone = new cobertura();
        $getAllCpByZone->setLocate($locate);
        $getAllCpByZone->setId_country($id_country);
        $getAllCpByZone->setProvince($id_province);
        $getAllCpByZone = $getAllCpByZone->getAllCpByZone();

        if(is_object($getAllCpByZone)){

            foreach($getAllCpByZone as $element){

                $object[] = array(

                    'result' => '1',
                    'postal_code' => $element["postal_code"],
                    'type' => $element["type"],
                    'status' => $element["status"],
                    'name' => $element["name"]
                );
            }

        }else {

            $object[] = array(
                'result' => '2',
              
            );

        }

        $jsonstring =  json_encode($object);
        echo $jsonstring;

     }
}


}