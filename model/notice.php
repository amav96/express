<?php 


class Notice{

    private $aviso;
    private $contacto;
    private $country;
    private $created_at;
    private $order;
    private $id_user;
    private $identificacion;
    private $lat;
    private $lng;
    private $medio;
    private $postal_code;
    private $dateStart;
    private $dateEnd;
    private $email;
    private $password;
    private $countSend;
    private $fromRow;
    private $limit;
    private $word;
    private $id_recolector;
    private $filter;
    private $db;

    public function __construct(){
        $this->db=Database::connect();
    }
    public function getAviso(){
        return $this->aviso;
    }
    public function getContacto(){
        return $this->contacto;
    }
    public function getCountry(){
        return $this->country;
    }
    public function getCreated_at(){
        return $this->created_at;
    }
    public function getOrder(){
        return $this->order;
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function getIdentificacion(){
        return $this->identificacion;
    }
    public function getLat(){
        return $this->lat;
    }
    public function getLng(){
        return $this->lng;
    }
    public function getMedio(){
        return $this->medio;
    }
    public function getPostalCode(){
        return $this->postal_code;
    }
    public function getDateStart(){
        return $this->dateStart;
    }
    public function getDateEnd(){
        return $this->dateEnd;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getCountSend(){
        return $this->countSend;
    }

    public function getFromRow()
    {
        return (string)$this->fromRow;
    }

    public function getLimit(){
        return $this->limit;
    }
    public function getWord(){
        return $this->word;
    }
    public function getFilter(){
        return $this->filter;
    }

    public function getId_recolector(){
        return $this->id_recolector;
    }



    public function setAviso($aviso){
        $this->aviso = $aviso;
    }
    public function setContacto($contacto){
        $this->contacto = $contacto;
    }
    public function setCountry($country){
        $this->country = $country;
    }
    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    public function setOrder($order){
        $this->order = $order;
    }
    public function setId_user($id_user){
        $this->id_user = $id_user;
    }
    public function setIdentificacion($identificacion){
        $this->identificacion = $identificacion;
    }
    public function setLat($lat){
        $this->lat= $lat;
    }
    public function setLng($lng){
        $this->lng=$lng;
    }
    public function setMedio($medio){
        $this->medio=$medio;
    }
    public function setPostalCode($postal_code){
        $this->postal_code=$postal_code;
    }
    public function setDateStart($dateStart){
        $this->dateStart=$dateStart;
    }
    public function setDateEnd($dateEnd){
        $this->dateEnd=$dateEnd;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setCountSend($countSend){
        $this->countSend = $countSend;
    }

    public function setFromRow($fromRow){
        $this->fromRow = $fromRow;
    }

    public function setLimit($limit){
        $this->limit = $limit;
    }

    public function setWord($word){
        $this->word = $word;
    }

    public function setFilter($filter){
        $this->filter = $filter;
    }

    public function setId_recolector($id_recolector){
        $this->id_recolector = $id_recolector;
    }


     public function setNotice(){

        $aviso = !empty($this->getAviso()) ? $this->getAviso() : false ;
        $contacto = !empty($this->getContacto()) ? $this->getContacto() : false ;
        $country = !empty($this->getCountry()) ? $this->getCountry() : false ;
        $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;
        $order = !empty($this->getOrder()) ? $this->getOrder() : false ;
        $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
        $identificacion = !empty($this->getIdentificacion()) ? $this->getIdentificacion() : false ;
        $lat = !empty($this->getLat()) ? $this->getLat() : false ;
        $lng = !empty($this->getLng()) ? $this->getLng() : false ;
        $medio = !empty($this->getMedio()) ? $this->getMedio() : false ;
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $momemto = date('d-m-Y H:i:s');


        $sql = "INSERT INTO notice  (contacto,id_user,identificacion,lat,lng,country,id_orden,means,aviso,delay_send,created_at) 
        values ('$contacto',$id_user,'$identificacion','$lat','$lng','$country','$order','$medio','$aviso','$momemto','$created_at') ";


         $setNotice = $this->db->query($sql);

         if($setNotice){

             $result = true;
         }else{
             $result = false;
         }

         return $result;
    } 

    public function setNoticeManagement(){
        
        $aviso = !empty($this->getAviso()) ? $this->getAviso() : false ;
        $contacto = !empty($this->getContacto()) ? $this->getContacto() : false ;
        $country = !empty($this->getCountry()) ? $this->getCountry() : false ;
        $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;
        $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
        $identificacion = !empty($this->getIdentificacion()) ? $this->getIdentificacion() : false ;
        $lat = !empty($this->getLat()) ? $this->getLat() : false ;
        $lng = !empty($this->getLng()) ? $this->getLng() : false ;
        $medio = !empty($this->getMedio()) ? $this->getMedio() : false ;

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $momemto = date('d-m-Y H:i:s');

        $sql = "INSERT INTO notice_management  (aviso,contacto,country,id_user,identificacion,lat,lng,means,delay_send,created_at) 
        values ('$aviso','$contacto','$country',$id_user,'$identificacion','$lat','$lng','$medio','$momemto','$created_at') ";

      

        $setNoticeManagement = $this->db->query($sql);

        if($setNoticeManagement){

            $result = true;
        }else{
            $result = false;
        }

        return $result;
    } 

    public function searchNewSection(){
        $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;

        $sql = "SELECT new_section FROM users WHERE id = $id_user AND new_section = 'new'";
        $searchNewSection = $this->db->query($sql);

        if($searchNewSection && $searchNewSection->num_rows >0) {
            $result = true;
        }else {
            $result = false;
        }

        return $result;
    }

    public function removeNewSection(){
        $id = !empty($this->getId_user()) ? $this->getId_user() : false ;
        $sql = "UPDATE users set new_section = 'check' where id = $id ";

        $removeNewSection = $this->db->query($sql);
        if($removeNewSection){
          $result = true;
        }else{
          $result = false;
        }
        return $result;
    }

    public function emptyContact(){
        $postal_code = !empty($this->getPostalCode()) ? $this-> getPostalCode(): false ;

        $sql = "SELECT n.id_user, n.telefono FROM provinces_assigned_and_formatted p
        INNER JOIN operator_by_zone o ON o.province = p.province
        INNER JOIN numeros_operators n ON n.id_user = o.id_user
        WHERE p.postal_code = '$postal_code'";

        $emptyContact = $this->db->query($sql);

        if($emptyContact && $emptyContact->num_rows>0){

            $result = $emptyContact;

        }else{
            $result = false;
        }

        return $result;
    }

     //COUNT NOTICES

    public function countNoticeByWord(){

        $word = !empty($this->getWord()) ? $this-> getWord(): false ;
        $filterArray = explode(' ',$word);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(DISTINCT(n.id)) as 'count' FROM  notice_management n 
        INNER join equipos e on e.identificacion = n.identificacion 
        INNER join users u ON u.id = n.id_user
        WHERE   ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) )";

        $countNoticeByWord = $this->db->query($sql);
        if($countNoticeByWord && $countNoticeByWord->fetch_object()->count > 0){
            $result = $countNoticeByWord;
        }else {
            $result = false;
        }

        return $result;
    }

    public function countNoticeRangeDate(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;

        $sql = "SELECT COUNT(DISTINCT(n.id)) as 'count' FROM notice_management n
        inner JOIN users u ON u.id = n.id_user 
        inner JOIN equipos e ON n.identificacion = e.identificacion
        WHERE  n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";

        $countNoticeRangeDate = $this->db->query($sql);
        if($countNoticeRangeDate && $countNoticeRangeDate->fetch_object()->count > 0){
            $result = $countNoticeRangeDate;
        }else {
            $result = false;
        }

        return $result;

    }

    public function countNoticeRangeDateAndWord(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;
        $word = !empty($this->getId_recolector()) ? $this->getId_recolector() : false ;

        $sql = "SELECT COUNT(DISTINCT(n.id)) as 'count' FROM notice_management n
        inner JOIN users u ON u.id = n.id_user 
        inner JOIN equipos e ON n.identificacion = e.identificacion
        WHERE n.id_user = $word and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";

        $countNoticeRangeDateAndWord = $this->db->query($sql);
        if($countNoticeRangeDateAndWord && $countNoticeRangeDateAndWord->fetch_object()->count > 0){
            $result = $countNoticeRangeDateAndWord;
        }else {
            $result = false;
        }

        return $result;

    }

    // FILTER count
    public function  countFilterToNoticeByDateAndFilter(){

        $dateStart = !empty($this->getDateStart()) ? $this-> getDateStart(): false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this-> getDateEnd(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(DISTINCT(n.id)) as 'count' FROM  notice_management n 
        INNER join equipos e on e.identificacion = n.identificacion 
        INNER join users u ON u.id = n.id_user
        WHERE   ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) )
        and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";


        $countFilterToGestionByDateAndFilter =  $this->db->query($sql);
        if($countFilterToGestionByDateAndFilter->num_rows>0){
            $result = $countFilterToGestionByDateAndFilter;
        }else {
            $result = false;
        }
        return $result;
    }

    public function countFilterToNoticeByWordAndDateAndFilter(){

        $dateStart = !empty($this->getDateStart()) ? $this-> getDateStart(): false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this-> getDateEnd(): false ;
        $word = !empty($this->getWord()) ? $this-> getWord(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
       
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(DISTINCT(n.id)) as 'count' FROM  notice_management n 
        INNER join equipos e on e.identificacion = n.identificacion 
        INNER join users u ON u.id = n.id_user
        WHERE  n.id_user = $word and ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) )
        and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59') ";

        $countFilterToNoticeByWordAndDateAndFilter = $this->db->query($sql);
        if($countFilterToNoticeByWordAndDateAndFilter && $countFilterToNoticeByWordAndDateAndFilter->num_rows>0){
            $result = $countFilterToNoticeByWordAndDateAndFilter;

        }else {
            $result = false;
        }

        return $result;

    }

    //DATA NOTICES

    public function noticeByWord(){

        $word = !empty($this->getWord()) ? $this-> getWord(): false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
        $filterArray = explode(' ',$word);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT n.id,e.nombre_cliente,e.direccion,e.localidad,e.provincia,n.id,u.name,
        n.aviso,n.contacto,n.country,n.id_user,n.identificacion,
        n.lat AS 'latAviso',n.lng AS 'lngAviso',n.means,n.created_at FROM  notice_management n 
        INNER join equipos e on e.identificacion = n.identificacion 
        INNER join users u ON u.id = n.id_user
        WHERE   ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) ) GROUP BY n.id 
        ORDER BY n.created_at DESC LIMIT $fromRow, $limit";

        $noticeByWord = $this->db->query($sql);
        if($noticeByWord && $noticeByWord->num_rows>0){
            $result = $noticeByWord;

        }else {
            $result = false;
        }
        return $result;
    }

    public function noticeRangeDate(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }

        $sql = "SELECT n.id,e.nombre_cliente,e.direccion,e.localidad,e.provincia,n.id,u.name,
        n.aviso,n.contacto,n.country,n.id_user,n.identificacion,
        n.lat AS 'latAviso',n.lng AS 'lngAviso',n.means,n.created_at FROM notice_management n
        INNER JOIN users u ON u.id = n.id_user 
        INNER JOIN equipos e ON n.identificacion = e.identificacion
        WHERE  n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')
        GROUP BY n.id ORDER BY n.created_at DESC LIMIT $fromRow, $limit";

        $getNoticesByDateRange = $this->db->query($sql);
        if($getNoticesByDateRange && $getNoticesByDateRange->num_rows>0){
            $result = $getNoticesByDateRange;

        }else {
            $result = false;
        }

        return $result;
    }

    public function noticeRangeDateAndWord(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;
        $word = !empty($this->getWord()) ? $this->getWord() : false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }

        $sql = "SELECT n.id,e.nombre_cliente,e.direccion,e.localidad,e.provincia,n.id,u.name,
        n.aviso,n.contacto,n.country,n.id_user,n.identificacion,
        n.lat AS 'latAviso',n.lng AS 'lngAviso',n.means,n.created_at FROM notice_management n
        INNER JOIN users u ON u.id = n.id_user 
        INNER JOIN equipos e ON n.identificacion = e.identificacion
        WHERE n.id_user =$word  and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')
        GROUP BY n.id ORDER BY n.created_at DESC LIMIT $fromRow, $limit";

        $noticeRangeDateAndWord = $this->db->query($sql);
        if($noticeRangeDateAndWord && $noticeRangeDateAndWord->num_rows>0){
            $result = $noticeRangeDateAndWord;

        }else {
            $result = false;
        }

        return $result;
    }

   
    //FILTER data
    public function getDataFilterToNoticeByDateAndFilter(){

        $dateStart = !empty($this->getDateStart()) ? $this-> getDateStart(): false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this-> getDateEnd(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT n.id,e.nombre_cliente,e.direccion,e.localidad,e.provincia,n.id,u.name,
        n.aviso,n.contacto,n.country,n.id_user,n.identificacion,
        n.lat AS 'latAviso',n.lng AS 'lngAviso',n.means,n.created_at FROM  notice_management n 
        INNER join equipos e on e.identificacion = n.identificacion 
        INNER join users u ON u.id = n.id_user
        WHERE   ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) )
        and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59') GROUP BY n.id 
        ORDER BY n.created_at DESC LIMIT $fromRow, $limit";

        $getDataFilterToNoticeByDateAndFilter = $this->db->query($sql);
        if($getDataFilterToNoticeByDateAndFilter && $getDataFilterToNoticeByDateAndFilter->num_rows>0){
            $result = $getDataFilterToNoticeByDateAndFilter;

        }else {
            $result = false;
        }

        return $result;

    }

    public function getDataFilterToNoticeByDateAndWordAndFilter(){

        $dateStart = !empty($this->getDateStart()) ? $this-> getDateStart(): false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this-> getDateEnd(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $word = !empty($this->getId_recolector()) ? $this-> getId_recolector(): false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT n.id,e.nombre_cliente,e.direccion,e.localidad,e.provincia,n.id,u.name,
        n.aviso,n.contacto,n.country,n.id_user,n.identificacion,
        n.lat AS 'latAviso',n.lng AS 'lngAviso',n.means,n.created_at FROM  notice_management n 
        INNER join equipos e on e.identificacion = n.identificacion 
        INNER join users u ON u.id = n.id_user
        WHERE n.id_user = $word and ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) )
        and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59') GROUP BY n.id 
        ORDER BY n.created_at DESC LIMIT $fromRow, $limit";


        $getDataFilterToNoticeByDateAndFilter = $this->db->query($sql);
        if($getDataFilterToNoticeByDateAndFilter && $getDataFilterToNoticeByDateAndFilter->num_rows>0){
            $result = $getDataFilterToNoticeByDateAndFilter;

        }else {
            $result = false;
        }

        return $result;
    }

    
    //EXPORT EXCEL 

    public function getDataManagementExportByWord(){

        $word = !empty($this->getWord()) ? $this->getWord(): false ;

        $filterArray = explode(' ',$word);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.= "SELECT n.id,n.country,n.identificacion,e.nombre_cliente,
        e.direccion, e.provincia, e.localidad,e.codigo_postal ,u.name,
        n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.id_user,n.contacto,n.created_at as 'fecha_aviso_visita' 
        from notice_management n
        INNER join equipos e on e.identificacion = n.identificacion 
        inner join users u ON u.id = n.id_user
        WHERE ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) ) GROUP BY n.id ORDER BY n.created_at";
        
        $getDataManagementExportByWord = $this->db->query($sql);
        if($getDataManagementExportByWord->num_rows>0){
            $result = $getDataManagementExportByWord;
        }else {
            $result = false;
        }

        return $result;

    }

    public function getDataNoticeExportByDateRange(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;

        $sql ="";
        $sql.= "SELECT n.id,n.country,n.identificacion,e.nombre_cliente,
        e.direccion, e.provincia, e.localidad,e.codigo_postal ,u.name,
        n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.id_user,n.contacto,n.created_at as 'fecha_aviso_visita' 
        from notice_management n
        INNER join equipos e on e.identificacion = n.identificacion 
        inner join users u ON u.id = n.id_user
        WHERE n.created_at 
        BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY n.id ORDER BY n.created_at";

        $getDataNoticeExportByDateRange = $this->db->query($sql);
        if($getDataNoticeExportByDateRange->num_rows>0){
            $result = $getDataNoticeExportByDateRange;
        }else {
            $result = false;
        }

        return $result;

    }

    public function getDataNoticeExportByDateRangeAndFilter(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }


        $sql ="";
        $sql.= "SELECT n.id,n.country,n.identificacion,e.nombre_cliente,
        e.direccion, e.provincia, e.localidad,e.codigo_postal ,u.name,
        n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.id_user,n.contacto,n.created_at as 'fecha_aviso_visita' 
        from notice_management n
        INNER join equipos e on e.identificacion = n.identificacion 
        inner join users u ON u.id = n.id_user
        WHERE ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) )
        and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59') GROUP BY n.id ORDER BY n.created_at";

        $getDataNoticeExportByDateRangeAndFilter = $this->db->query($sql);
        if($getDataNoticeExportByDateRangeAndFilter->num_rows>0){
            $result = $getDataNoticeExportByDateRangeAndFilter;
        }else {
            $result = false;
        }

        return $result;

    }

    public function getDataManagementExportByDateRangeAndWord(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;
        $word = !empty($this->getId_recolector()) ? $this->getId_recolector(): false ;

        $sql ="";
        $sql.= "SELECT n.id,n.country,n.identificacion,e.nombre_cliente,
        e.direccion, e.provincia, e.localidad,e.codigo_postal ,u.name,
        n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.id_user,n.contacto,n.created_at as 'fecha_aviso_visita' 
        from notice_management n
        INNER join equipos e on e.identificacion = n.identificacion 
        inner join users u ON u.id = n.id_user
        WHERE n.id_user= $word and n.created_at 
        BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY n.id ORDER BY n.created_at";

        $getDataManagementExportByDateRangeAndWord = $this->db->query($sql);
        if($getDataManagementExportByDateRangeAndWord->num_rows>0){
            $result = $getDataManagementExportByDateRangeAndWord;
        }else {
            $result = false;
        }

        return $result;

    }

    public function getDataManagementExportByDateRangeAndWordAndFilter(){

        $dateStart = !empty($this->getDateStart()) ? $this->getDateStart() : false ;
        $dateEnd = !empty($this->getDateEnd()) ? $this->getDateEnd() : false ;
        $word = !empty($this->getId_recolector()) ? $this->getId_recolector(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.= "SELECT n.id,n.country,n.identificacion,e.nombre_cliente,
        e.direccion, e.provincia, e.localidad,e.codigo_postal ,u.name,
        n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.id_user,n.contacto,n.created_at as 'fecha_aviso_visita' 
        from notice_management n
        INNER join equipos e on e.identificacion = n.identificacion 
        inner join users u ON u.id = n.id_user
        WHERE n.id_user = $word and ( MATCH (n.aviso,n.contacto,n.country,n.identificacion,n.lat,n.lng,n.means)
        AGAINST ('$filterClean' IN BOOLEAN MODE) )
        and n.created_at BETWEEN('$dateStart') AND ('$dateEnd 23:59:59') GROUP BY n.id ORDER BY n.created_at";

        $getDataManagementExportByDateRangeAndWordAndFilter = $this->db->query($sql);
        if($getDataManagementExportByDateRangeAndWordAndFilter->num_rows>0){
            $result = $getDataManagementExportByDateRangeAndWordAndFilter;
        }else {
            $result = false;
        }

        return $result;

    }


    public function addCount($email){
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $momemto = date('d-m-Y H:i:s');
        $sql = "UPDATE email_management SET countSend = countSend+1, created_at = '$momemto'  WHERE 
        email = '$email'";
        $addCount = $this->db->query($sql);
        if($addCount){
            $result = true;
        }else {
            $result = false;
        }
        return $result;
    }
    public function resetCount(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $momemto = date('d-m-Y H:i:s');
        $sql = "UPDATE email_management SET countSend = 0, created_at = '$momemto' ";
        $resetCount = $this->db->query($sql);
        if($resetCount){
            $result = true;
        }else {
            $result = false;
        }
        return $result;
    }
    public function getAllEmail(){
        $sql = "SELECT email,password from email_management where countSend < 500 limit 1";
        $getAllEmail = $this->db->query($sql);
        if($getAllEmail && $getAllEmail->num_rows>0){
            $result = $getAllEmail->fetch_object();
        }else{
            $result = false;
        }
        return $result;
    }
}