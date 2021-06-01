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

      //BUSCADORES DIRECTOS DE COBERTURA PARA TABLAS
      public function  getAllCoverage(){

            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){
                  $fromRow = '0';
              }

            $sql = "SELECT c.id,c.postal_code,c.locate,c.home_address,p.province AS 'provinceInt',c.province,co.country as 'name_country',
            c.type,c.id_user,u.name AS 'name_assigned',c.customer_service_hours, c.lat ,c.lng , c.created_at
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
            c.customer_service_hours,c.lat ,c.lng , c.created_at
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
                  WHERE c.status='active' AND c.postal_code IN($stringPostalCode) AND c.created_at = '$created_at'
                  GROUP BY c.id order BY c.postal_code ASC";

               $getRecentCodes = $this->db->query($sql);
               if($getRecentCodes && $getRecentCodes->num_rows>0){
                  $result = $getRecentCodes;
               }else {
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
            $timeSchedule = !empty($this->getCustomer_service_hours()) ? $this->getCustomer_service_hours(): false ;  
            
            $sql = "INSERT INTO coverage (postal_code,locate,home_address,province,id_country,type,id_user,user_managent_id,customer_service_hours,lat,lng,created_at,status,action) values ($postal_code,'$locate','$home_address','$province','$id_country','$type','$id_user',$user_managent_id,'$timeSchedule','$lat','$lng','$created_at','ACTIVE','CREATED')";

           
            $save = $this->db->query($sql);
      
            if($save){
                  $result = true;
            }else {
                  $result = false;
            }
            return $result;
      }

      public function removeToHistory(){
            $id = !empty($this->getId()) ? $this->getId() : false ;
            $user_managent_id= !empty($this->getUser_managent_id()) ? $this->getUser_managent_id() : false ;
            $created_at= !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;
      
            $sql = "INSERT INTO history_coverage (id,postal_code,locate,home_address,province,id_country,type,
            id_user,user_managent_id,status,action,customer_service_hours,lat,lng,motive,created_at,id_coverage) 
            SELECT null,postal_code,locate,home_address,province,id_country,type,id_user,'$user_managent_id',
            STATUS,'REMOVETOHISTORY',customer_service_hours,lat,lng,motive,'$created_at','$id'
            FROM coverage where id = '$id' ";

           
            $removeToHistory = $this->db->query($sql);
            if($removeToHistory){
                  $result =  true;
            }else {
                  $result = false;
            }
            return $result;
            
      }

      public function delete(){
            $id = !empty($this->getId()) ? $this->getId() : false ;
            $sql = "DELETE from coverage where id = '$id'";
            $delete = $this->db->query($sql);
            if($delete){
                  $result = true;
            }else {
                  $result = false;
            }

            return $result;
      }

      public function update (){

            $id = !empty($this->getId()) ? $this->getId() : false ;
            $home_address = !empty($this->getHome_address()) ? $this->getHome_address() : false ; 
            $type= !empty($this->getType()) ? $this->getType() : false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ; 
            $user_managent_id= !empty($this->getUser_managent_id()) ? $this->getUser_managent_id() : false ; 
            $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at(): false ;
            $timeSchedule = !empty($this->getCustomer_service_hours()) ? $this->getCustomer_service_hours(): false ; 
            $lat  = !empty($this->getLat()) ? $this->getLat(): false ; 
            $lng  = !empty($this->getLng()) ? $this->getLng(): false ; 

            
            $sql = "UPDATE coverage set home_address = '$home_address',type = '$type', id_user = '$id_user', user_managent_id = '$user_managent_id', action = 'UPDATED', customer_service_hours = '$timeSchedule', lat = '$lat', lng = '$lng', 
            created_at = '$created_at' where id= '$id'";

      
            $update = $this->db->query($sql);
            if($update){
                  $result = true;
            }else {
                  $result = false;
            }

            return $result;
      }

      public function verifyExist(){

            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
            $postal_code = !empty($this->getPostal_code()) ? $this->getPostal_code() : false ; 

            $sql = "SELECT id,postal_code,id_user FROM coverage WHERE id_user = '$id_user' and postal_code = '$postal_code'";
            $verifyExist = $this->db->query($sql);
            if($verifyExist && $verifyExist->num_rows > 0){
                  $result = true;
            }else{
                  $result = false;
            }

            return $result;
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

      public function verifyNotExistUser(){

            $postal_code = !empty($this->getPostal_code()) ? $this->getPostal_code() : false ;
            $country = !empty($this->getId_country()) ? $this->getId_country() : false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;

            if(is_array($postal_code)){
                  $postal_code =  implode(',',$postal_code);
                 }
            
            $sql = "SELECT c.postal_code,u.name,u.name_alternative FROM coverage c
            LEFT JOIN users u ON u.id = c.id_user
            WHERE c.id_user = '$id_user' AND c.postal_code IN($postal_code) AND c.id_country = '$country' GROUP BY c.id";

            $verifyNotExistUser = $this->db->query($sql);
            if($verifyNotExistUser && $verifyNotExistUser->num_rows > 0){
                  $result = $verifyNotExistUser;
            }else {
                  $result = false;
            }

            return $result;
      }

      public function getAllPointInZone(){
            // aca traigo los datos
            $country = !empty($this->getId_country()) ? $this->getId_country() : false ;
            $cp_start  = !empty($this->getPostal_code()) ? $this->getPostal_code() : false ;
            $cp_end  = !empty($this->getPostal_code_range()) ? $this->getPostal_code_range() : false ;

            $sql = "SELECT c.id,c.postal_code,l.locate,pro.province,co.country,c.type,c.id_user,u.name,u.name_alternative 
            FROM coverage c
            LEFT JOIN users u ON u.id = c.id_user
            LEFT JOIN postal_code po ON po.postal_code = c.postal_code
            LEFT JOIN localities l ON l.id = c.locate
            LEFT JOIN province pro ON pro.id = po.id_province
            LEFT JOIN country co ON co.id = pro.id_country
            WHERE co.id = '$country' AND c.postal_code >= $cp_start AND c.postal_code <= $cp_end
            AND c.type not IN('mail','station')
            GROUP BY c.id order by c.postal_code";

            $getAllPointInZone = $this->db->query($sql);
            if($getAllPointInZone && $getAllPointInZone->num_rows>0){
                  $result = $getAllPointInZone;
            }else {
                  $result = false;
            }

            return $result;

      }
}

?>