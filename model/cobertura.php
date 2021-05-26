<?php 

class cobertura{

      private $id;
      private $postal_code;
      private $postal_code_range;
      private $locate;
      private $home_address;
      private $province;
      private $code;
      private $id_country;
      private $type;
      private $name;
      private $lat;
      private $lng;
      private $id_operator;
      private $id_user;
      private $customer_service_hours;
      private $user_managent_id;
      private $status;
      private $action;
      private $motive;
      private $created_at;
      private $updated_at;
      private $fromRow;
      private $limit;

 
      public function __construct(){
            $this->db=Database::Connect();
      }

      public function setId($id){
            $this->id=$id;
      }
      public function setPostal_code($postal_code){
            $this->postal_code=$postal_code;
      }
      
      public function setPostal_code_range($postal_code_range){
            $this->postal_code_range=$postal_code_range;
      }
      public function setLocate($locate){
            $this->locate=$locate;
      }
      public function setHome_address($home_address){
            $this->home_address=$home_address;
      }
      public function setProvince($province){
            $this->province=$province;
      }
      public function setCode($code){
            $this->code=$code;
      }
      public function setId_country($id_country){
            $this->id_country=$id_country;
      }
      public function setType($type){
            $this->type=$type;
      }
      public function setName($name){
            $this->name=$name;
      }
      public function setLat($lat){
            $this->lat=$lat;
      }
      public function setLng($lng){
            $this->lng=$lng;
      }

      public function setId_operator($id_operator){
            $this->id_operator=$id_operator;
      }
      
      public function setId_user($id_user){
            $this->id_user=$id_user;
      }

      public function setCustomer_service_hours($customer_service_hours){
            $this->customer_service_hours=$customer_service_hours;
      }

      public function setUser_managent_id($user_managent_id){
            $this->user_managent_id=$user_managent_id;
      }

      public function setStatus($status){
            $this->status=$status;
      }

      public function setAction($action){
            $this->action=$action;
      }
      public function setMotive($motive){
            $this->motive=$motive;
      }

      public function setCreated_at($created_at){
            $this->created_at=$created_at;
      }

      public function setUpdated_at($updated_at){
            $this->updated_at=$updated_at;
      }

      public function setFromRow($fromRow){
            $this->fromRow = $fromRow;
      }
    
        
        public function setLimit($limit)
      {
      $this->limit = $limit;
      }
      


      public function getId(){
           return $this->id;
      }
      public function getPostal_code(){
           return $this->postal_code;
      }
      public function getPostal_code_range(){
            return $this->postal_code_range;
       }

      public function getLocate(){
           return $this->locate;
      }
      public function getHome_address(){
           return $this->home_address;
      }
      public function getProvince(){
           return $this->province;
      }
      public function getCode(){
           return $this->code;
      }
      public function getId_country(){
           return $this->id_country;
      }
      public function getType(){
           return $this->type;
      }
      public function getName(){
           return $this->name;
      }
      public function getLat(){
           return $this->lat;
      }
      public function getLng(){
           return $this->lng;
      }

      public function getId_operator(){
            return $this->id_operator;
       }

      public function getId_user(){
           return $this->id_user;
      }

      public function getCustomer_service_hours(){
            return $this->customer_service_hours;
       }


      public function getUser_managent_id(){
            return $this->user_managent_id;
       }

       public function getStatus(){
            return $this->status;
       }

       public function getAction(){
            return $this->action;
       }
       public function getMotive(){
            return $this->motive;
       }

       public function getCreated_at(){
            return $this->created_at;
       }

       public function getUpdated_at(){
            return $this->updated_at;
       }

        public function getFromRow()
       {
        return (string)$this->fromRow;
       }

      public function getLimit()
       {
        return (string)$this->limit;
       }

       //note:  Al eliminar, actualizar y crear algo, se guarda una bandera en action y la fecha de cada accion
       //se guarda en created_at. 

       //CONTADORES DE COBERTURA PARA PAGINACIONES
      public function countAllCoverage(){

            $sql = "SELECT count(DISTINCT(c.id)) as 'count'
            FROM coverage c
            left JOIN users u ON c.id_user = u.id
            LEFT JOIN country co ON c.id_country = co.id
            WHERE c.status='active'";
            

            $countAllCoverage = $this->db->query($sql);

            if($countAllCoverage && $countAllCoverage->fetch_object()->count > 0){
                  $result = $countAllCoverage;
            }else {
                  $result = false;
            }

            return $result;

      }

      public function countAllEmptyCoverage(){

            $sql = "SELECT COUNT(distinct(l.id)) AS 'count'
            FROM postal_code po
            LEFT JOIN coverage c ON c.postal_code = po.postal_code
            LEFT JOIN localities l ON l.postal_code = po.postal_code
            left JOIN provinceint p ON p.postal_code = po.postal_code
            LEFT JOIN province pr ON pr.id = po.id_province
            left JOIN users u ON c.id_user = u.id
            LEFT JOIN country co ON po.id_country = co.id
            WHERE c.postal_code IS NULL";
            

            $countAllEmptyCoverage = $this->db->query($sql);

            if($countAllEmptyCoverage && $countAllEmptyCoverage->fetch_object()->count > 0){
                  $result = $countAllEmptyCoverage;
            }else {
                  $result = false;
            }

            return $result;

      }

      //CONTADORES QUE RECUPERAN DATOS LUEGO DE INSERTAR, ACTUALIZAR O ELIMINAR

      public function countGetRecentCodes(){
            $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at(): false ;
            $postal_code  = !empty($this->getPostal_code()) ? $this->getPostal_code(): false ; 

            if( $postal_code && is_array($postal_code) && count($postal_code) > 0){
                  $stringPostalCode = implode(",",$postal_code);
              }

            $sql ="SELECT COUNT(DISTINCT(c.id)) AS 'count'
            FROM coverage c
            left JOIN provinceint p ON p.postal_code = c.postal_code
            left JOIN users u ON c.id_user = u.id
            LEFT JOIN country co ON c.id_country = co.id
            WHERE c.status='active' AND p.postal_code IN($stringPostalCode) AND c.created_at = '$created_at'";

            $countGetRecentCodes = $this->db->query($sql);
            if($countGetRecentCodes && $countGetRecentCodes->fetch_object()->count > 0){
                  $result = $countGetRecentCodes;
            }else {
                  $result = false;
            }

            return $result; 
      }
      

      //BUSCADORES DIRECTOS DE COBERTURA PARA TABLAS
      public function  getAllCoverage(){

            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){
                  $fromRow = '0';
              }

            $sql = "SELECT c.id,c.postal_code,c.locate,c.home_address,p.province AS 'provinceInt',c.province,co.country as 'name_country',
            c.type,c.id_user,u.name AS 'name_assigned',c.customer_service_hours, c.lat ,c.lng , c.id_operator, c.created_at
            FROM coverage c
            left JOIN provinceint p ON p.postal_code = c.postal_code
            left JOIN users u ON c.id_user = u.id
            LEFT JOIN country co ON c.id_country = co.id
            WHERE c.status='active' GROUP BY c.id order BY c.postal_code ASC limit $fromRow,$limit  ;";


            $getAllCoverage = $this->db->query($sql);

            if($getAllCoverage && $getAllCoverage->num_rows>0){
                  
                  $result = $getAllCoverage;
            }else{
                  $result = false;
            }

            return $result;


      }

      public function getAllEmptyCoverage(){

            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){
                  $fromRow = '0';
              }

            $sql = "SELECT c.id,po.postal_code,l.locate,c.home_address,p.province AS 'provinceInt',
            pr.province,co.country as 'name_country',c.type,c.id_user,u.name AS 'name_assigned',
            c.customer_service_hours,c.lat ,c.lng , c.id_operator, c.created_at
            FROM postal_code po
            LEFT JOIN coverage c ON c.postal_code = po.postal_code
            LEFT JOIN localities l ON l.postal_code = po.postal_code
            left JOIN provinceint p ON p.postal_code = po.postal_code
            LEFT JOIN province pr ON pr.id = po.id_province
            left JOIN users u ON c.id_user = u.id
            LEFT JOIN country co ON po.id_country = co.id
            WHERE c.postal_code IS NULL
            GROUP BY l.id 
            order BY c.postal_code ASC limit $fromRow,$limit  ;";


            $getAllEmptyCoverage = $this->db->query($sql);

            if($getAllEmptyCoverage && $getAllEmptyCoverage->num_rows>0){
                  
                  $result = $getAllEmptyCoverage;
            }else{
                  $result = false;
            }

            return $result;

            
      }

      // BUSCADORES DIRECTOS QUE RECUPERAN DATOS LUEGO DE INSERTAR, ACTUALIZAR O 
      
      public function getRecentCodes(){
            $postal_code = !empty($this->getPostal_code()) ? $this->getPostal_code() : false ;
            $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;

            if( $postal_code && is_array($postal_code) && count($postal_code) > 0){
                  $stringPostalCode = implode(",",$postal_code);
              }

                  $sql ="SELECT c.id,c.postal_code,c.locate,c.home_address,p.province AS 'provinceInt',c.province,
                  co.country as 'name_country',c.type,c.id_user,u.name AS 'name_assigned',c.customer_service_hours,
                  c.lat ,c.lng,  c.created_at
                  FROM coverage c
                  left JOIN provinceint p ON p.postal_code = c.postal_code
                  left JOIN users u ON c.id_user = u.id
                  LEFT JOIN country co ON c.id_country = co.id
                  WHERE c.status='active' AND p.postal_code IN($stringPostalCode) AND c.created_at = '$created_at'
                  GROUP BY c.id order BY c.postal_code ASC";
                  
               $getRecentCodes = $this->db->query($sql);
               if($getRecentCodes && $getRecentCodes->num_rows>0){
                  $result = $getRecentCodes;
               }else {
                  $result = false;
               }
               return $result;
               
      }

      public function HistoricalInactive(){

            $sql = "SELECT c.id,c.postal_code,c.locate,c.home_address,c.province,c.id_country,co.country as 'name_country',c.type,c.name,
            c.id_user,c.customer_service_hours, c.lat ,c.lng , c.id_operator,c.motive,c.detailed_type,c.country_color,c.type_color, u.name as 'operator_name',c.status_history,c.updated_at FROM history_coverage c
            left JOIN users u ON c.id_operator = u.id
            LEFT JOIN country co ON c.id_country = co.id";
               
            $HistoricalInactive = $this->db->query($sql);
    
            if($HistoricalInactive && $HistoricalInactive->num_rows>0){
                  
                $result = $HistoricalInactive;
            }else{
                $result = false;
            }
    
            return $result;
    

      }

      public function activateAgain(){

            $id_country= !empty($this->getId_country()) ? $this->getId_country() : false ; 
            $locate = !empty($this->getLocate()) ? $this->getLocate() : false ;
            $province = !empty($this->getProvince()) ? $this->getProvince() : false ; 
            $home_address = !empty($this->getHome_address()) ? $this->getHome_address() : false ; 
            $type= !empty($this->getType()) ? $this->getType() : false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ; 
            $name= !empty($this->getName()) ? $this->getName() : false ; 
            $user_managent_id= !empty($this->getUser_managent_id()) ? $this->getUser_managent_id() : false ; 
            $customer_service_hours = !empty($this->getCustomer_service_hours()) ? $this->getCustomer_service_hours() : false ; 
            $postal_code  = !empty($this->getPostal_code()) ? $this->getPostal_code(): false ; 
            $lat  = !empty($this->getLat()) ? $this->getLat(): false ; 
            $lng  = !empty($this->getLng()) ? $this->getLng(): false ; 
            $id_operator  = !empty($this->getId_operator()) ? $this->getId_operator(): false ; 
            $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at(): false ; 

            $sql = "INSERT INTO coverage (postal_code,locate,home_address,province,id_country,type,name,id_user,user_managent_id, customer_service_hours,lat,lng,id_operator,detailed_type,country_color,type_color,created_at,status,action) values ($postal_code,'$locate','$home_address','$province',$id_country,'$type','$name',$id_user,$user_managent_id,'$customer_service_hours','$lat','$lng','$id_operator','$created_at','active','activate_again')";
            $activateAgain = $this->db->query($sql);

            if($activateAgain){

                  $id=$this->db->insert_id;
                  $result =  $id;
                  
            }else {
                  $result = false;
            }


            return $result;
      }

      public function searchUnique(){

            $id_country= !empty($this->getId_country()) ? $this->getId_country() : false ; 
            $locate = !empty($this->getLocate()) ? $this->getLocate() : false ;
            $province = !empty($this->getProvince()) ? $this->getProvince() : false ; 
            $home_address = !empty($this->getHome_address()) ? $this->getHome_address() : false ;

         
            $sql = "SELECT * FROM coverage WHERE id_country=$id_country and locate = '$locate' and province='$province' and home_address='$home_address' ;";

            $home_address = $this->db->query($sql);

            if($home_address->num_rows>0){

                  $result = false;

            }else{
                  $result =  true;
            }
            
            return $result;
            

      }

      public function searchCodes(){

            $postal_code  = !empty($this->getPostal_code()) ? $this->getPostal_code(): false ; 
            $postal_code_range  = !empty($this->getPostal_code_range()) ? $this->getPostal_code_range(): false ; 
            $id_country= !empty($this->getId_country()) ? $this->getId_country() : false ; 
            $array_id= !empty($this->getId()) ? $this->getId() : false ; 

            //esto es para una consulta normal por rango de codigo y pais
            if($postal_code && $postal_code_range && $id_country && !$array_id){

                  $sql = "SELECT c.id,c.postal_code,c.locate,c.home_address,c.province,c.id_country,co.country as 'name_country',c.type,c.name,c.id_user,c.customer_service_hours,c.user_managent_id,c.status,c.action, c.lat ,c.lng , c.id_operator,c.detailed_type,c.country_color,c.type_color, u.name as 'operator_name',c.motive,c.created_at,c.updated_at 
                  FROM coverage c
                  left JOIN users u ON c.id_operator = u.id
                  LEFT JOIN country co ON c.id_country = co.id
                  WHERE c.postal_code >= $postal_code AND c.postal_code <= $postal_code_range AND c.id_country = $id_country AND 
                  c.status='active' GROUP BY c.id order BY c.postal_code asc";
                  $searchCodes = $this->db->query($sql);

                  
            }else if (!$postal_code && !$postal_code_range && !$id_country && $array_id){
                  //esta consulta es para buscar los  seleccionados en actualizar por rango
                  //los  seleccionados: son los que se actualizaran
                  //y los que tengo que mostrar al realizar la accion

                  $sql = "SELECT c.id,c.postal_code,c.locate,c.home_address,c.province,c.id_country ,co.country as 'name_country',c.type,c.name,c.id_user,c.customer_service_hours,c.user_managent_id,c.status,c.action, c.lat ,c.lng , c.id_operator,c.detailed_type,c.country_color,c.type_color, u.name as 'operator_name',c.motive,c.created_at,c.updated_at 
                  FROM coverage c
                  left JOIN users u ON c.id_operator = u.id
                  LEFT JOIN country co ON c.id_country = co.id
                  WHERE c.status='active' and c.id in($array_id) GROUP BY c.id order BY c.postal_code ASC ";
                  $searchCodes = $this->db->query($sql);
                 
            }

            

            if($searchCodes && $searchCodes->num_rows>0){
                  
            $result = $searchCodes;

            }
            else{

            $result = false;

            }

            return $result;

      }

      public function searchOneCode(){

            
            $id= !empty($this->getId()) ? $this->getId() : false ; 

            $sql = "SELECT c.id,c.postal_code,c.locate,c.home_address,c.province,c.id_country,c.type,c.name,
            c.id_user,c.customer_service_hours,c.user_managent_id,c.status,c.action, c.lat ,c.lng , c.id_operator,co.country as 'name_country',c.detailed_type,c.country_color,c.type_color, u.name as 'operator_name',c.motive,c.created_at,c.updated_at FROM coverage c
            left JOIN users u ON c.id_operator = u.id
            LEFT JOIN country co ON c.id_country = co.id
            WHERE c.id= '$id' and c.status='active' GROUP BY c.id";


            $searchOneCode = $this->db->query($sql);

            if($searchOneCode && $searchOneCode->num_rows>0){
                  
            $result = $searchOneCode;

            }
            else{

            $result = false;

            }

            return $result;

      }


      public function save(){

            $id_country= !empty($this->getId_country()) ? $this->getId_country() : false ; 
            $locate = !empty($this->getLocate()) ? $this->getLocate() : false ;
            $province = !empty($this->getProvince()) ? $this->getProvince() : false ; 
            $home_address = !empty($this->getHome_address()) ? $this->getHome_address() : false ; 
            $type= !empty($this->getType()) ? $this->getType() : false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ; 
            $user_managent_id= !empty($this->getUser_managent_id()) ? $this->getUser_managent_id() : false ; 
            $postal_code  = !empty($this->getPostal_code()) ? $this->getPostal_code(): false ; 
            $lat  = !empty($this->getLat()) ? $this->getLat(): false ; 
            $lng  = !empty($this->getLng()) ? $this->getLng(): false ; 
            $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at(): false ; 
            
            $sql = "INSERT INTO coverage (postal_code,locate,home_address,province,id_country,type,id_user,user_managent_id,lat,lng,created_at,status,action) values ($postal_code,'$locate','$home_address','$province',$id_country,'$type',$id_user,$user_managent_id,'$lat','$lng','$created_at','active','created')";
            $save = $this->db->query($sql);
      
            if($save){
                  $result = true;
            }else {
                  $result = false;
            }
            return $result;
      }

     

      //este metodo es para mostrar lo que hice despues de utilizar el metodo save
      public function gettersSearchCode($array){

            //esta info me llega desde el metodo save 
            // y con estos datos de este array busco los codigos recien insertados, luego, consulta en la base de datos por fecha de insertados
          
           $created_at = !empty($array["created_at"]) ? $array["created_at"]  : false ;
           $id_country = !empty($array["id_country"]) ? $array["id_country"]  : false ;
           $postal_code = !empty($array["postal_code"]) ? $array["postal_code"]  : false ;

           if(is_array($postal_code)){

            $postal_code =  implode(',',$array["postal_code"]);

           }
           
            $sql = "SELECT c.id,c.postal_code,c.locate,c.home_address,c.province,c.id_country,c.type,c.name,
            c.id_user,c.customer_service_hours,c.user_managent_id,c.status,c.action, c.lat ,c.lng , c.id_operator,co.country as 'name_country',c.detailed_type,c.country_color,c.type_color, u.name as 'operator_name',c.motive,c.created_at,c.updated_at FROM coverage c
            left JOIN users u ON c.id_operator = u.id
            LEFT JOIN country co ON c.id_country = co.id
            WHERE c.postal_code in($postal_code) and c.id_country = $id_country and c.created_at = '$created_at' and c.status='active'";
  
            $gettersSearchCode = $this->db->query($sql);

            if($gettersSearchCode->num_rows>0){

                  $result = $gettersSearchCode;

            }else{
                  $result = false;
            }
           
            return $result;

           
      }

      public function update(){

            $id = !empty($this->getId()) ? $this->getId(): false ; 
            //$postal_code  = !empty($this->getPostal_code()) ? $this->getPostal_code(): false ; 
            $home_address = !empty($this->getHome_address()) ? $this->getHome_address() : false ; 
            // $id_country= !empty($this->getId_country()) ? $this->getId_country() : false ; 
            $type= !empty($this->getType()) ? $this->getType() : false ;
            $name= !empty($this->getName()) ? trim($this->getName()) : false ; 
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ; 
            $user_managent_id= !empty($this->getUser_managent_id()) ? $this->getUser_managent_id() : false ; 
            $customer_service_hours= !empty($this->getCustomer_service_hours()) ? $this->getCustomer_service_hours() : false ; 
            $lat  = !empty($this->getLat()) ? $this->getLat(): false ; 
            $lng  = !empty($this->getLng()) ? $this->getLng(): false ; 
            $id_operator  = !empty($this->getId_operator()) ? $this->getId_operator(): false ; 
            $created_at= !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;

             $sql = "UPDATE coverage set  home_address ='$home_address' ,type = '$type',name = '$name' ,id_user =$id_user ,user_managent_id = '$user_managent_id' , lat='$lat' , lng='$lng', id_operator = $id_operator, customer_service_hours = '$customer_service_hours', created_at = '$created_at',action = 'updated' where id in($id) and status='active'";


             $update = $this->db->query($sql);

             if($update){

                  $result = true;

             }else{
                   $result = false;
             }

             return $result;

            

      }

      public function updateRange(){

            //actualizar por id
      
            $home_address = !empty($this->getHome_address()) ? $this->getHome_address() : false ; 
            $id_country= !empty($this->getId_country()) ? $this->getId_country() : false ; 
            $type= !empty($this->getType()) ? $this->getType() : false ;
            $name= !empty($this->getName()) ? $this->getName() : false ; 
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ; 
            $customer_service_hours = !empty($this->getCustomer_service_hours()) ? $this->getCustomer_service_hours() : false ;
            $user_managent_id = !empty($this->getUser_managent_id()) ? $this->getUser_managent_id() : false ;
            $lat  = !empty($this->getLat()) ? $this->getLat(): false ; 
            $lng  = !empty($this->getLng()) ? $this->getLng(): false ; 
            $id_operator  = !empty($this->getId_operator()) ? $this->getId_operator(): false ; 
            $created_at  = !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;
            $array_id= !empty($this->getId()) ? $this->getId() : false ; 

             $sql= "UPDATE coverage set  home_address ='$home_address',id_country = $id_country,type = '$type',name = '$name' ,id_user =$id_user, user_managent_id = $user_managent_id, lat='$lat' , lng='$lng', id_operator=$id_operator, created_at = '$created_at',customer_service_hours ='$customer_service_hours' ,action = 'updated' where status='active' and id_country=$id_country and id in($array_id) ";  

             echo '<pre>';
             print_r($sql);
             echo '</pre>';
             die();

              $updateRange = $this->db->query($sql);

              if($updateRange){

                   $result = true;

              }else{
                    $result = false;
              }

              return $result;

      }
      
      public function delete(){

               //actualizar por id
               
               $id= !empty($this->getId()) ? $this->getId() : false ;
            

               $sql = "DELETE FROM coverage where id = $id";
            
                 $delete = $this->db->query($sql);
   
                 if($delete){
   
                      $result = true;
   
                 }else{
                       $result = false;
                 }
   
                 return $result;
   

      }

      public function getUsers(){
            $id_country = !empty($this->getId_country()) ? $this->getId_country(): false ;
            $type = !empty($this->getType()) ? $this->getType(): false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user(): false ;


            //si entra aqui es porque pide todos los usuarios / desde el select de usuarios para asignar codigos postales
            if($id_country &&  $type){

                  $sql = "SELECT id,name,name_alternative,home_address,province,location,postal_code,phone_number,customer_service_hours,role  from users where status_process='active' and country='$id_country' and role='$type' order by postal_code" ;
                  
            }else if($id_user){

                  $sql = "SELECT id,name,name_alternative,home_address,province,location,postal_code,phone_number,customer_service_hours,role  from users where status_process='active' and id = $id_user order by postal_code " ;            

            }

           
            $getUsers = $this->db->query($sql);

            if($getUsers && $getUsers->num_rows>0){

                  $result = $getUsers;

            }else{
                  $result = false;
            }

            return $result;

      }

      public function getOperators(){

            $postal_code = !empty($this->getPostal_code()) ? $this->getPostal_code() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;

            $sql ="SELECT p.province,p.postal_code, u.name, o.id_user FROM provinces_assigned_and_formatted p
            INNER JOIN operator_by_zone o ON p.province = o.province 
            INNER JOIN users u ON o.id_user = u.id
            WHERE p.postal_code = '$postal_code' AND p.id_country = $id_country ";

         


            $getOperators = $this->db->query($sql);

            if($getOperators && $getOperators->num_rows > 0){

                  $result = $getOperators;
            }else{
                  $result = false;
            }

            return $result;
      }
      
      public function province(){

            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;


            $sql = "SELECT * from province where id_country = '$id_country' order by province asc";

           
            $province = $this->db->query($sql);

            if($province && $province->num_rows>0){

                  $result = $province;
            }else {
                  $result = false;
            }

            return $result;
            
      }

      public function locate(){
            
            $id_province = !empty($this->getProvince()) ? $this->getProvince() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;

            $sql ="SELECT postal_code,locate from localities where id_province ='$id_province' and id_country='$id_country' GROUP BY LOCATE order by locate asc ";
            $locate = $this->db->query($sql);

            if($locate && $locate->num_rows>0){
                  $result = $locate;
            }else{
                  $result = false;
            }

            return $result;
      }

      public function getAllCpByZone(){

            $locate = !empty($this->getLocate()) ? $this->getLocate() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;
            $id_province = !empty($this->getProvince()) ? $this->getProvince() : false ;

            $sql = "SELECT l.postal_code,c.status,c.type,u.name FROM localities l
            LEFT JOIN coverage c ON c.postal_code = l.postal_code
            LEFT JOIN users u ON u.id = c.id_user
            WHERE l.locate='$locate' and l.id_country = $id_country and l.id_province = $id_province
            GROUP BY l.postal_code ";

            $getAllCpByZone = $this->db->query($sql);

            if($getAllCpByZone->num_rows>0){

                  $result = $getAllCpByZone;

            }else {
                  $result =  false;
            }

            return $result;
      }

      public function lookHistory(){
            // busco los id que recibo en update range  y se lo paso al metodo settersHistory que insertara datos historicos
            $id = !empty($this->getId()) ? $this->getId() : false ;

            //user_managent_id, motive, status, es para los registros que se eliminan directamente de la tabla
            $user_managent_id = !empty($this->getUser_managent_id()) ? $this->getUser_managent_id() : false ;
            $motive = !empty($this->getMotive()) ? $this->getMotive() : false ;
            $status = !empty($this->getStatus()) ? $this->getStatus() : false ;
            

            $sql = "SELECT * from coverage where id in($id)";
           

            $beforeHistory = $this->db->query($sql);

            if($beforeHistory && $beforeHistory->num_rows>0){

                  $result = $this->settersHistory($beforeHistory,$motive,$status,$user_managent_id);

            }else{

                  $result = false;
            }

            return $result;
      }

      private function settersHistory($beforeHistory,$motive = false,$status =  false,$user_managent_id =  false){

            // lo que viene de lookHistory lo recorro y lo inserto en una tabla historica
            if($beforeHistory && is_object($beforeHistory)){

                  foreach($beforeHistory as $element){
                      
                         $id = $element["id"];
                         $postal_code = $element["postal_code"];
                         $locate = $element["locate"];
                         $home_address = $element["home_address"];
                         $province = $element["province"];
                         $id_country = $element["id_country"];
                         $type = $element["type"];
                         $name = $element["name"];
                         $id_user = $element["id_user"];
                         if(empty($element["user_managent_id"]) || !isset($element["user_managent_id"])){
                               $user_managent_id = '';
                         }else{
                               $user_managent_id = $element["user_managent_id"];
                         }
                        
                         $action = $element["action"];
                         $customer_service_hours = $element["customer_service_hours"];
                         $lat = $element["lat"];
                         $lng = $element["lng"];
                         $id_operator = $element["id_operator"] == '' || $element["id_operator"] == null ? '': $element["id_operator"];
                         $detailed_type = $element["detailed_type"];
                         $country_color = $element["country_color"];
                         $type_color = $element["type_color"];
                         if(empty($motive) || !isset($motive)){
                               $motive = '';
                         }
                         $created_at = $element["created_at"];
                         $status_history = 'inactive';
                        

                         $sql = "INSERT INTO history_coverage (id_history,postal_code ,locate ,home_address,province,id_country,type,name ,id_user,user_managent_id,status,action,customer_service_hours,lat,lng,id_operator,detailed_type,country_color,type_color,motive,status_history,created_at)values ($id,$postal_code,'$locate','$home_address','$province',$id_country,'$type','$name',$id_user,'$user_managent_id','$status','$action','$customer_service_hours','$lat','$lng','$id_operator','$detailed_type','$country_color','$type_color','$motive','$status_history','$created_at')" ;
                          $beforeHistory = $this->db->query($sql);
                       
                  }
                  if($beforeHistory){
                        $result = true;
                  }else{
                        $result = false;
                  }
                  return $result;
            }
      }

      // SCOPE

      public function getCountry(){
            $sql = "SELECT id,country from country";
            $getCountry = $this->db->query($sql);
            if($getCountry && $getCountry->num_rows>0){
                  $result = $getCountry;
            }else {
                  $result = false;
            }
            return $result;
            
      }

      public function getProvinceById(){
            $id = !empty($this->getId()) ? $this->getId() : false ;
            $sql = "SELECT id,province,id_country FROM province WHERE id_country = $id";
            $getProvinceById = $this->db->query($sql);
            if($getProvinceById && $getProvinceById->num_rows > 0){
                  $result = $getProvinceById;
            }else {
                  $result = false;
            }

            return $result;
      }

      public function getLocateById(){
            $id = !empty($this->getId()) ? $this->getId() : false ;
            $sql = "SELECT id,locate,postal_code,id_province FROM localities 
            WHERE id_province = $id
            GROUP BY locate ORDER BY postal_code";
            $getLocateById = $this->db->query($sql);
            if($getLocateById && $getLocateById->num_rows > 0){
                  $result = $getLocateById;
            }else {
                  $result = false;
            }

            return $result;
      }

      public function getPostalCodeByLocateAndProvinceAndCountry(){
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;
            $id_province = !empty($this->getProvince()) ? $this->getProvince() : false ;
            $locate = !empty($this->getLocate()) ? $this->getLocate() : false ;

            $sql = "SELECT postal_code FROM localities
            WHERE locate = '$locate' AND id_country = $id_country AND id_province = $id_province
            ORDER BY postal_code";
            $getPostalCodeByLocateAndProvinceAndCountry = $this->db->query($sql);
            if($getPostalCodeByLocateAndProvinceAndCountry && $getPostalCodeByLocateAndProvinceAndCountry->num_rows > 0){
                  $result = $getPostalCodeByLocateAndProvinceAndCountry;
            }else {
                  $result = false;
            }

            return $result;
      }
}

?>